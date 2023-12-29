<?php

namespace App\Values;

enum StatusValue: string
{
    case ACTIVE = 'A';
    case INACTIVE = 'I';
    case REMOVED = 'trash';
}