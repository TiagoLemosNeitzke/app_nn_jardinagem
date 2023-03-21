<?php

namespace App\Http\Controllers;

use App\Models\ToReceive;
use App\Models\Customer;
use Illuminate\Http\Request;

class ToReceiveController extends Controller
{
     public function index(Request $request)
     {
        $toReceives = ToReceive::where('user_id', auth()->user()->id)->with(['user','customer' => function($query){
            $query->withTrashed();
        }])->paginate(4);
       
        return view('app.toReceive', ['toReceives' => $toReceives, 'message' => $request->message, 'error' => $request->error]);
     }

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
