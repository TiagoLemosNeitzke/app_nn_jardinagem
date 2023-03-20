<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\ToReceive;
use App\Repository\CustomerRepository;
use App\Repository\TaskRepository;

class TaskController extends Controller
{
    public function __construct(public Task $task, public Customer $customer)
    {
        $this->task = $task;
        $this->customer = $customer;
    }
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index(Request $request, TaskRepository $tasks)
     {
         $tasks = $tasks->getTaskFiltered($request->get('filter'));

         if ($tasks[1] === 'all') {
             return view('app.task', ['tasks' => $tasks[0], 'filter' => 'all']);
         } elseif ($tasks[1] === 'open') {
             return view('app.task', ['tasks' => $tasks[0], 'filter' => 'open']);
         } elseif ($tasks[1] === 'done') {
             return view('app.task', ['tasks' => $tasks[0], 'filter' => 'done']);
         } else {
             return view('app.task', ['tasks' => $tasks[0], 'filter' => 'all']);
         }
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create(Request $request, CustomerRepository $customer)
     {
         $url = url()->previous();
         $customer = $customer->getCustomerId($request->get('customer'));
        
         return view('app.createTask', ['customer' => $customer, 'url' => $url]);
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(TaskRequest $request, CustomerRepository $customer, TaskRepository $task)
     {
         $url = url()->previous();

        $customer = $customer->getCustomerId($request->validated('customer_id'));

         if ($customer === null) {
             return view('app.createTask', ['error' => 'Cliente não encontrado em nossa base de dados. Consulte sua lista de cliente. [005]', 'url' => $url]);
         } else {
             $task = $task->getTaskCustomerId($customer->id);
             if ($task === null) {
                 $task = Task::create($request->validated());
                 
                 return view('app.createTask', ['message' => 'Agendamento realizado com sucesso!', 'url' => $url]);
             } else {
                 return view('app.createTask', ['error' => 'Cliente já possui agendamento. Consulte seus agendamentos. [006]', 'url' => $url]);
             }
         }
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Models\Task  $task
      * @return \Illuminate\Http\Response
      */
     public function edit(Task $task)
     {
         $url = url()->previous();
         $task = $task->load('customer');
    
         return view('app.createTask', ['task' => $task, 'url' => $url]);
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Models\Task  $task
      * @return \Illuminate\Http\Response
      */
     public function update(TaskRequest $request, Task $task)
     {
         $url = route('task.index');
         $task = $task->update($request->validated());
         if ($task) {
             return view('app.createTask', ['message' => 'Agendamento editado com sucesso!', 'url' => $url]);
         } else {
             return view('app.createTask', ['error' => 'Ocorreu um erro ao tentar editar a tarefa. Tente novamente mais tarde [010]', 'url' => $url]);
         }
     }

     public function done(Request $request)
     {
         $task = $this->task->where('id', $request->id)->first();
         $task->did_day =  date('y-m-d');
         $task = $task->save();
         
         if ($task) {
             $task = $this->task->where('id', $request->id)->first();
            
             ToReceive::updateOrCreate([
                 'task_id' => $task->id,
                 'user_id' => $task->user_id,
                 'customer_id' => $task->customer_id,
                 'service_value' => $task->service_value,
                
             ]);
             return redirect()->route('task.index');
         } else {
             return view('app.task', ['error' => 'Erro: Não foi possível marcar o serviço como realizado. Tente novamente mais tarde.']);
         }
     }
     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\Task  $task
      * @return \Illuminate\Http\Response
      */
     public function destroy(Task $task, ToReceive $toReceive)
     {
         if ($task->exists()) {
             $toReceive = ToReceive::where('task_id', $task->id)->first();
             if ($toReceive !== null) {
                 $toReceive = $toReceive->delete($toReceive->id);
             } else {
                 $task = $task->delete($task->id);
                 if ($task) {
                     return response()->view('app.task', ['message' => 'Sucesso! Registro apagado']);
                 } else {
                     return view('app.task', ['error' => 'Erro ao tentar apagar registro. [009]']);
                 }
             }
         } else {
             return view('app.task', ['error' => 'Erro ao tentar apagar registro. [009]']);
         }
     }
}
