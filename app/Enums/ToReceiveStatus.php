<?php

namespace App\Enums;

enum ToReceiveStatus: int
{
    case PAID_OUT = 0;
    case DEBT = 1;
}
