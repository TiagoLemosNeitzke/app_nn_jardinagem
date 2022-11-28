<?php

namespace App\Http\Controllers;

use App\Models\ToReceive;
use App\Models\Customer;
use Illuminate\Http\Request;

class ToReceiveController extends Controller
{
    public function __construct(ToReceive $toReceive)
    {
        $this->toReceive = $toReceive;
    }
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()
     {
         $toReceives = $this->toReceive->with('user', 'customer')->orderBy('created_at', 'asc')->paginate(4);
         return view('app.toReceive', ['toReceives' => $toReceives]);
     }

    

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         $this->toReceive->create([
             'client_id' => $request->client_id,
             'value' => $request->value,
             'paid_out' => false
         ]);
   
         return redirect()->route('toReceive.index');
     }

     /**
      * Display the specified resource.
      *
      * @param  \App\Models\ToReceive  $toReceive
      * @return \Illuminate\Http\Response
      */
     public function show(ToReceive $toReceive)
     {
        //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Models\ToReceive  $toReceive
      * @return \Illuminate\Http\Response
      */
     public function edit(ToReceive $toReceive)
     {
        //
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Models\ToReceive  $toReceive
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, ToReceive $toReceive)
     {
        //
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\ToReceive  $toReceive
      * @return \Illuminate\Http\Response
      */
     public function destroy(ToReceive $toReceive)
     {
        //
     }
}
