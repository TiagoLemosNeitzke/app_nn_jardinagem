<?php

namespace App\Repository;

class UserRepository
{
    public function getAuthUserId()
    {
        $user = auth()->user()->id;

        return $user;
    }
}