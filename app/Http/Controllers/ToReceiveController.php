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
     public function index(Request $request)
     {
         $toReceives = $this->toReceive->with('user', 'customer')->orderBy('created_at', 'asc')->paginate(4);
         return view('app.toReceive', ['toReceives' => $toReceives, 'message' => $request->message, 'error' => $request->error]);
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
      *
      * @param  \App\Models\ToReceive  $toReceive
      * @return \Illuminate\Http\Response
      */
     public function update(ToReceive $toReceive)
     {
       
        $toReceive = $toReceive->update([
                  'status' => 1
                ]);
          
         if ($toReceive) {
             return redirect()->route('toReceive.index', ['message' => 'Sucesso! Você marcou como recebido.']);
         } else {
             return redirect()->route('toReceive.index', ['error' => 'Ocorreu um erro ao tentar marcar como recebido. Tente novamente mais tarde. [003]']);
         };
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\ToReceive  $toReceive
      * @return \Illuminate\Http\Response
      */
     public function destroy(ToReceive $toReceive)
     {
         $toReceive = $toReceive->delete();
         if ($toReceive) {
             return redirect()->route('toReceive.index', ['message' => 'Sucesso! Registro apagado.']);
         } else {
             return redirect()->route('toReceive.index', ['error' => 'Ocorreu um erro ao tentar apagar o registro. Tente novamente mais tarde. [004]']);
         };
     }
}
