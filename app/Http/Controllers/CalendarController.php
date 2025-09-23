<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    
    public function student_celender()
    {
    $calendars=Calendar::all();

    return view('calendar', compact('calendars'));
    }
}
