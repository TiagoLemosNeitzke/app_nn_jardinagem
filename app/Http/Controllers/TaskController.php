<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\ToReceive;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct(Task $task, Customer $customer)
    {
        $this->task = $task;
        $this->customer = $customer;
    }
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index(Request $request)
     {
         if ($request->filter === 'all') {
             $tasks = $this->task->orderBy('scheduled_for_day', 'asc')->paginate(9);
             return view('app.task', ['tasks' => $tasks, 'filter' => 'all']);
         } elseif ($request->filter === 'open') {
             $tasks = $this->task->where('did_day', null)->orderBy('scheduled_for_day', 'asc')->paginate(9);
             return view('app.task', ['tasks' => $tasks, 'filter' => 'open']);
         } elseif ($request->filter === 'done') {
             $tasks = $this->task->where('did_day', '<>', null)->orderBy('scheduled_for_day', 'asc')->paginate(9);
             return view('app.task', ['tasks' => $tasks, 'filter' => 'done']);
         } else {
             $tasks = $this->task->where('did_day', null)->orderBy('scheduled_for_day', 'asc')->paginate(9);
             return view('app.task', ['tasks' => $tasks, 'filter' => 'all']);
         }
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create(Request $request)
     {
         $customer = $this->customer->where('id', $request->id)->first();
         return view('app.createTask', ['customer' => $customer]);
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(TaskRequest $request)
     {
         $customer = Customer::where('name', $request->name)->orWhere('id', $request->id)->first();
         if ($customer === null) {
             return view('app.createTask', ['error' => 'Cliente não encontrado em nossa base de dados. Consulte sua lista de cliente. [005]']);
         } else {
             $task = Task::where('customer_id', $customer->id)->where('did_day', null)->first();
             if ($task === null) {
                 $task = Task::create($request->validated());
                 return view('app.createTask', ['message' => 'Agendamento realizado com sucesso!']);
             } else {
                 return view('app.createTask', ['error' => 'Cliente já possui agendamento. Consulte seus agendamentos. [006]']);
             }
         }
     }

     /**
      * Display the specified resource.
      *
      * @param  \App\Models\Task  $task
      * @return \Illuminate\Http\Response
      */
     public function show(Task $task)
     {
        //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Models\Task  $task
      * @return \Illuminate\Http\Response
      */
     public function edit(Task $task)
     {
         $task = $task->where('id', $task->id)->with('customer')->first();
         return view('app.createTask', ['task' => $task]);
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
         $task = $task->update($request->validated());
         if ($task) {
             return view('app.createTask', ['message' => 'Agendamento editado com sucesso!']);
         } else {
             return view('app.createTask', ['error' => 'Ocorreu um erro ao tentar editar a tarefa. Tente novamente mais tarde [010]']);
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
                     return response()->view('app.task', ['message' => 'Registro apagado da nossa base de dados com sucesso.']);
                 } else {
                     return view('app.task', ['error' => 'Erro ao tentar apagar registro. [009]']);
                 }
             }
         } else {
             return view('app.task', ['error' => 'Erro ao tentar apagar registro. [009]']);
         }
     }
}
