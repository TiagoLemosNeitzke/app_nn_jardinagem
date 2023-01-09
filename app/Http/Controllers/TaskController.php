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
             $tasks = $this->task->orderBy('scheduled_for_day', 'asc')->paginate(9);
           
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
        $customers = $this->customer->orderBy('name', 'asc')->paginate(10);
        return view('app.createTask', ['id' => $request->id, 'name' => $request->name, 'openTask' => true, 'customers' => $customers]);
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
         }else {
             $task = Task::where('customer_id', $customer->id)->first();
             if ($task) {
                 return view('app.createTask', ['error' => 'Cliente já possui agendamento. Consulte seus agendamentos. [006]']);
             } else {
               
                 $task = Task::create($request->validated());
                 return view('app.createTask', ['message' => 'Agendamento realizado com sucesso!']);
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
         dd('edit');
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Models\Task  $task
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request)
     {
         $task = $this->task->where('id', $request->id)->first();
         $task->did_day =  date('y-m-d');
         $task = $task->save();
       
         if ($task) {
            $task = $this->task->where('id', $request->id)->first();
            //dd($task->service_value);
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
     public function destroy(Task $task)
     {
         if ($task->exists()) {
             $task->delete();
             return response()->view('app.task', ['message' => 'Registro apagado da nossa base de dados com sucesso.']);
         } else {
             return view('app.task', ['error' => 'Erro ao tentar apagar registro. (Registro não encontrado)']);
         }
     }
}
