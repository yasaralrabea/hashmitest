<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;

class TasksController extends Controller
{
    public function get_calendar()
    {
    $calendars=Calendar::all();

    return view('calendar', compact('calendars'));
    }

    public function store(Request $request)
    {
        Calendar::create([

            'date'=>$request->date,
            'goal'=>$request->goal,
             'condition'=>$request->condition,
             'students'=>$request->students,
        ]);
         return redirect()->route('calendars.index')->with('success', 'تمت إضافة الهدف بنجاح ');

    }

    public function update(Request $request,$id)
    {
        $calendar=Calendar::find($id);
        $calendar->update($request->only(['date', 'goal', 'condition']));
        return redirect()->route('calendars.index')->with('success', 'تم تعديل الهدف بنجاح ');


    }

    
    public function destroy($id)
    {
        $calendar=Calendar::find($id);
         $calendar->condition='ملغي';
        $calendar->save();
        $calendar->delete();
        return redirect()->route('calendars.index')->with('success', 'تم حذف الهدف بنجاح ');

    }

     public function done($id)
    {
        $calendar=Calendar::find($id);
        $calendar->condition='تم';
        $calendar->save();
        return redirect()->route('calendars.index')->with('success', 'تم انجاز الهدف بنجاح ');

    }

    public function my_calendar()
    {
        $calendar=Calendar::where('students','yes')->get();
        return view('my_calendar',compact('calendar'));
    }
    

}
