<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Task;
use App\Models\ToReceive;

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
    public function index(Customer $customers, Task $tasks, ToReceive $toReceives)
    {
        $today = date('Y-m-d');
        $howManyCustomers = $customers->count();
        $tasksForToday = $tasks->where('scheduled_for_day', $today)->get();
        $toReceives = $toReceives->where('status', false)->with('customer')->get();
        return view('home', [
            'howManyCustomers' => $howManyCustomers,
            'tasksForToday' => $tasksForToday,
            'toReceives' => $toReceives
        ]);
    }
}
