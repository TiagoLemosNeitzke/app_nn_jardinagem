<?php

namespace App\Http\Controllers;

use App\Models\ExpenseToPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateUpdateExpenseToPayRequest;

class ExpenseToPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expensesToPay = ExpenseToPay::paginate(4);

        return view('app.expenseToPay', ['expenses' => $expensesToPay]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.createExpenseToPay');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateUpdateExpenseToPayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUpdateExpenseToPayRequest $request)
    {
        ExpenseToPay::create($request->validated());

        return view('app.createExpenseToPay', ['message' => 'Cadastro realizado com sucesso!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expenseToPay = ExpenseToPay::where('id', $id)->first();
        return view('app.createExpenseToPay', ['expenseToPay' => $expenseToPay]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->method() === 'PATCH') {
            $expenseToPay = ExpenseToPay::where('id', $id)->first();
           
            $expenseToPay = $expenseToPay->update(['paid' => true]);
            if ($expenseToPay) {
                return view('app.expenseToPay', ['message' => 'Despesa atualizada com sucesso!']);
            } else {
                return view('app.expenseToPay', ['error' => 'Ocorreu um erro ao tentar marcar a despesa como paga, tente novamente mais tarde. [014]']);
            }
        };

        if ($request->method() === 'PUT') {
            $validator = Validator::make($request->all(), [
               'user_id' => 'required',
                'expense_amount' => 'required|string',
                'description'  => 'required|string',
                'due_date' => 'required'
            ]);
 
            if ($validator->fails()) {
                return redirect('expenseToPay/'.$id.'/edit')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $expenseToPay = ExpenseToPay::where('id', $id)->first();

                $expenseToPay = $expenseToPay->update($validator->validated());
                if ($expenseToPay) {
                    return view('app.createExpenseToPay', ['message' => 'Despesa atualizada com sucesso!']);
                } else {
                    return view('app.createExpenseToPay', ['error' => 'Erro ao tentar atualizar os dados da despesa. Tente novamente mais tarde. [007]']);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenseToPay = ExpenseToPay::destroy($id);
        $expensesToPay = ExpenseToPay::paginate(4);

        if ($expenseToPay) {
            return view('app.expenseToPay', ['expenses' => $expensesToPay,'message' => 'Despesa removida do banco de dados com sucesso!']);
        } else {
            return view('app.expenseToPay', ['expenses' => $expensesToPay,'error' => 'Ocorreu um erro ao tentar excluir a despesa. Tente novamente mais tarde. [013]']);
        }
    }
}
