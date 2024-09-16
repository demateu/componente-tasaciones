<?php

namespace App\Enums;

enum EventStatus: string
{
    case Draft = 'Solicitado';
    case Active = 'En proceso';
    case Cancelled = 'Rechazado';
    case Completed = 'Completado';
}