<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index(Request $request)
     { 
        if ($request->filter === 'all') {
             $tasks = $this->task->orderBy('created_at', 'asc')->with('customer')->paginate(9);
             return view('app.task', ['tasks' => $tasks, 'filter' => 'all']);
         } elseif ($request->filter === 'open') {
             $tasks = $this->task->where('status', 1)->orderBy('created_at', 'asc')->with('customer')->paginate(9);
             return view('app.task', ['tasks' => $tasks, 'filter' => 'open']);
         } elseif ($request->filter === 'done') {
             $tasks = $this->task->where('status', 0)->orderBy('created_at', 'asc')->with('customer')->paginate(9);
             return view('app.task', ['tasks' => $tasks, 'filter' => 'done']);
         } else {
             $tasks = $this->task->orderBy('scheduled_for_day', 'asc')->with('user')->paginate(9);
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
        return view('app.createTask', ['id' => $request->id, 'name' => $request->name]);
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
             return view('app.createTask', ['error' => 'Cliente não encontrado em nossa base de dados. Consulte sua lista de cliente.']);
         }
         if ($customer->exists) {
             $task = Task::where('customer_id', $customer->id)->first();
             if ($task) {
                 return view('app.createTask', ['error' => 'Cliente já possui agendamento. Consulte seus agendamentos.']);
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
        dd($request->all());
        /* $value = $request->get('value');
         $task = $task->where('id', $task->id)->with('customer')->first();
         
         $task->status = 0;
         $task->update();
         
         if ($task) {
             return redirect()->route('toReceive.create', ['customer' => $task->customer, 'value' => $value]);
         } else {
             return view('app.task', ['error' => 'Erro: Não foi possível marcar o serviço como realizado. Tente novamente mais tarde.']);
         } */
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
