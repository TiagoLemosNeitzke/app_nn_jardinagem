<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Customer;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index(Request $request)
     {
         if ($request->filter === 'all') {
             $plans = $this->plan->orderBy('created_at', 'asc')->with('customer')->paginate(4);
             return view('app.plan', ['plans' => $plans, 'filter' => 'all']);
         } elseif ($request->filter === 'open') {
             $plans = $this->plan->where('status', 1)->orderBy('created_at', 'asc')->with('customer')->paginate(4);
             return view('app.plan', ['plans' => $plans, 'filter' => 'open']);
         } elseif ($request->filter === 'done') {
             $plans = $this->plan->where('status', 0)->orderBy('created_at', 'asc')->with('customer')->paginate(4);
             return view('app.plan', ['plans' => $plans, 'filter' => 'done']);
         } else {
             $plans = $this->plan->orderBy('created_at', 'desc')->with('customer')->paginate(4);
             return view('app.plan', ['plans' => $plans, 'filter' => 'all']);
         }
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create(Request $request)
     {
         return view('app.createPlan', ['id' => $request->id, 'name' => $request->name]);
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         $customer = Customer::where('name', $request->name)->orWhere('id', $request->id)->first();
         if ($customer === null) {
             return view('app.createPlan', ['error' => 'Cliente não encontrado em nossa base de dados. Consulte sua lista de cliente.']);
         }
         if ($customer->exists) {
             $plan = Plan::where('customer_id', $customer->id)->first();
             if ($plan) {
                 return view('app.createPlan', ['error' => 'Cliente já possui agendamento. Consulte seus agendamentos.']);
             } else {
                 $plan = $this->plan->create([
                    'customer_id' => $customer->id
                ]);
                 return view('app.createPlan', ['message' => 'Agendamento realizado com sucesso!']);
             }
         }
     }

     /**
      * Display the specified resource.
      *
      * @param  \App\Models\Plan  $plan
      * @return \Illuminate\Http\Response
      */
     public function show(Plan $plan)
     {
        //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Models\Plan  $plan
      * @return \Illuminate\Http\Response
      */
     public function edit(Plan $plan)
     {
         dd('edit');
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Models\Plan  $plan
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Plan $plan)
     {
         $value = $request->get('value');
         $plan = $plan->where('id', $plan->id)->with('customer')->first();
         
         $plan->status = 0;
         $plan->update();
         
         if ($plan) {
             return redirect()->route('toReceive.create', ['customer' => $plan->customer, 'value' => $value]);
         } else {
             return view('app.plan', ['error' => 'Erro: Não foi possível marcar o serviço como realizado. Tente novamente mais tarde.']);
         }
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\Plan  $plan
      * @return \Illuminate\Http\Response
      */
     public function destroy(Plan $plan)
     {
         if ($plan->exists()) {
             $plan->delete();
             return response()->view('app.plan', ['message' => 'Registro apagado da nossa base de dados com sucesso.']);
         } else {
             return view('app.plan', ['error' => 'Erro ao tentar apagar registro. (Registro não encontrado)']);
         }
     }
}
