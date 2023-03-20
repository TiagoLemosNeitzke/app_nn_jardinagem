<?php

namespace App\Repository;

use App\Models\Task;

class TaskRepository
{
    public function getTaskFiltered($filter)
    {
        $user_id = auth()->user()->id;

       // dd($filter);

        if ($filter === 'all') {

            $tasks = Task::where('user_id', $user_id)->orderBy('scheduled_for_day', 'asc')->paginate(9);

            return  [ $tasks, $filter];

        } elseif ($filter === 'open') {

            $tasks = Task::where([['user_id', '=', $user_id], ['did_day', '=', null]])->orderBy('scheduled_for_day', 'asc')->paginate(9);

             return  [ $tasks, $filter];

        } elseif ($filter === 'done') {
            $tasks = Task::where([['user_id', $user_id], ['did_day', '<>', null]])->orderBy('scheduled_for_day', 'asc')->paginate(9);

            return  [ $tasks, $filter];

        } else {
            $tasks = Task::where([['user_id', $user_id], ['did_day', null]])->orderBy('scheduled_for_day', 'asc')->paginate(9);

             return  [ $tasks, $filter];
        }
    }
}
