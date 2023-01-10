<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateUpdateExpenseFormRequest;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Expense $expenses)
    {
        $expenses = $expenses->paginate(9);
        return view('app.expense', ['expenses' => $expenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.createExpense');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\CreateUpdateExpenseFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUpdateExpenseFormRequest $request, Expense $expense)
    {
        $expense->create($request->validated());

        $expenses = $expense->all();

        return view('app.expense', ['expenses' => $expenses ,'message' => 'Despesa cadastrada com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('app.createExpense', ['expense' => $expense]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CreateUpdateExpenseFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUpdateExpenseFormRequest $request, $id)
    {
        $expense = Expense::where('id', $id)->first();
        $expense = $expense->update($request->validated());
        if($expense){
            return view('app.createExpense', ['message' => 'Despesa atualizada com sucesso!']);
        }else{

            return view('app.createExpense', ['error' => 'Erro ao tentar atualizar os dados da despesa. Tente novamente mais tarde. [007]']);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->destroy($expense->id);
        return redirect()->route('expense.index');
    }
}
