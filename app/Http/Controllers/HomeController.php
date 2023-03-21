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
        $tasksForToday = $tasks->where([['user_id', '=', auth()->user()->id],['scheduled_for_day', '=' ,$today]])->paginate(2);
        $toReceives = $toReceives->where([['user_id', '=', auth()->user()->id],['status', '=', false]])->with(['customer' => function($query){
            $query->withTrashed();
        }])->orderBy('created_at', 'asc')->paginate(2);
        
        return view('home', [
            'howManyCustomers' => $howManyCustomers,
            'tasksForToday' => $tasksForToday,
            'toReceives' => $toReceives
        ]);
    }
}
