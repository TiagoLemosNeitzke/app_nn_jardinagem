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
             $plans = $this->plan->orderBy('created_at', 'asc')->with('customer')->paginate(4);
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
     public function store(Request $request, Customer $customer)
     {
         $id = $request->customer_id;
         $customer = Customer::where('id', $id)->first();
         if ($customer === null) {
             return view('app.createPlan', ['error' => 'Id não cadastrado em nossa base de dados. agendamento não realizado. Tente novamente.']);
         } else {
             $plan = $this->plan->where('customer_id', $id)->first();

             if ($plan === null) {
                 $plan = $this->plan->create($request->all());
                 return redirect()->route('plan.index');
             }
    
             return view('app.createPlan', ['error' => 'Cliente já possui agendamento. Consulte seus agendamentos.']);
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
         // dd($plan) ;
         $plans = $plan->where('id', $plan->id)->with('customer')->get();
         foreach ($plans as $plan) {
             $plan->status = 0;
             $plan->save();
             if ($plan) {
                 return redirect()->route('toReceive.store', ['customer' => $plan->customer]);
             } else {
                 return view('app.plan', ['error' => 'Erro: Não foi possível marcar o serviço como realizado. Tente novamente mais tarde.']);
             }

             
             //dd($plan->customer) ;
         }
        
         //$plan->status = 0;
         //$plan = $plan->update();
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\Plan  $plan
      * @return \Illuminate\Http\Response
      */
     public function destroy(Plan $plan)
     {
         dd('destrouy');
     }
}
