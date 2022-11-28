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
        dd('edit');
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
        dd('update');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\ToReceive  $toReceive
      * @return \Illuminate\Http\Response
      */
     public function destroy(ToReceive $toReceive)
     {
        dd('destroy', $toReceive);
     }
}
