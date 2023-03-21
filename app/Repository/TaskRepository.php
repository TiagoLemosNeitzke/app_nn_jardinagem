<?php

namespace App\Repository;

use App\Models\Task;

class TaskRepository
{
    public function __construct(public UserRepository $user_id)
    {
        //   
    }
    
    public function getTaskFiltered($filter)
    {
        $user_id = $this->user_id->getAuthUserId();

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
        $user_id = $this->user_id->getAuthUserId();

        $task = Task::where([['user_id', '=', $user_id], ['did_day', '=', null]])->orderBy('scheduled_for_day', 'asc')->paginate(9);

        return $task;
    }

    public function getTaskCustomerId($id)
    {
        $user_id = $this->user_id->getAuthUserId();
        
        $task = Task::where([['user_id', '=', $user_id],['customer_id', '=', $id]])->where('did_day', null)->first();

        return $task;
    }

    public function getTask($id)
    {
        $user_id = $this->user_id->getAuthUserId();

        $task = Task::where([['user_id', '=', $user_id],['id', '=', $id]])->with('customer')->first();

        return $task;
    }
}
