<?php

namespace App\Repository;

use App\Models\Task;

class TaskRepository
{
    public function getTaskFiltered($filter)
    {
        $user_id = auth()->user()->id;

        if ($filter === 'all') {
            $tasks = Task::where('user_id', $user_id)->orderBy('scheduled_for_day', 'asc')->paginate(9);

            return  [ $tasks, $filter];
        } elseif ($filter === 'open') {
            $tasks = $this->getTaskNull();

            return  [ $tasks, $filter];
        } elseif ($filter === 'done') {
            $tasks = Task::where([['user_id', $user_id], ['did_day', '<>', null]])->orderBy('scheduled_for_day', 'asc')->paginate(9);

            return  [ $tasks, $filter];
        } else {
            $tasks = $this->getTaskNull();

            return  [ $tasks, $filter];
        }
    }

    public function getTaskNull()
    {
        $user_id = auth()->user()->id;

        $task = Task::where([['user_id', '=', $user_id], ['did_day', '=', null]])->orderBy('scheduled_for_day', 'asc')->paginate(9);

        return $task;
    }

    public function getTaskCustomerId($id)
    {
         $task = Task::where('customer_id', $id)->where('did_day', null)->first();

         return $task;

    }
}
