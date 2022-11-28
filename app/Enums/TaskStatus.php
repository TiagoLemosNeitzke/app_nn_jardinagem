<?php

namespace App\Enums;

enum TaskStatus : int
{
    case PENDING = 1;
    case DONE = 0;
}