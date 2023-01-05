<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Customer $customers, Task $tasks, Expense $expenses)
    {
        $today = date('Y-m-d');
        
        $howManyCustomers = $customers->count();
        $tasksForToday = $tasks->where('scheduled_for_day', $today)->get();
        return view('home', [
            'howManyCustomers' => $howManyCustomers,
            'tasksForToday' => $tasksForToday
        ]);
    }
}
