<?php

namespace App\Enums;

enum StockAction: string
{
    case In = 'in';
    case Out = 'out';
}