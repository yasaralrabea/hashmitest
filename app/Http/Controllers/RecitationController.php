<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recitation;
use App\Models\Student;

class RecitationController extends Controller
{
    public function index(Request $request)
{
    $students = Student::all();

    $query = Recitation::query()->with('student');

    // فلتر حسب الطالب
    if ($request->filled('student_id')) {
        $query->where('student_id', $request->student_id);
    }

    // فلتر حسب التاريخ
    if ($request->filled('date')) {
        $query->where('date', $request->date);
    }

    // فلتر حسب اسم الطالب
    if ($request->filled('student_name')) {
        $query->whereHas('student', function($q) use ($request) {
            $q->where('name', 'like', '%' . $request->student_name . '%');
        });
    }

    // فلتر حسب الخطة (plan_filter)
    if ($request->filled('plan_filter') && $request->plan_filter != 'all') {
        $today = now();

        if ($request->plan_filter == 'weekly') {
            $start = $today->startOfWeek()->format('Y-m-d');
            $end = $today->endOfWeek()->format('Y-m-d');
        } elseif ($request->plan_filter == 'monthly') {
            $start = $today->startOfMonth()->format('Y-m-d');
            $end = $today->endOfMonth()->format('Y-m-d');
        } elseif ($request->plan_filter == 'quarterly') {
            $start = $today->copy()->subMonths(2)->startOfMonth()->format('Y-m-d'); // آخر 3 أشهر
            $end = $today->endOfMonth()->format('Y-m-d');
        }

        $query->whereBetween('date', [$start, $end]);
    }

    $recitations = $query->orderBy('date', 'desc')->get();

    return view('recitations', compact('students', 'recitations'));
}


     public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'subject' => 'nullable|string',
            'notes' => 'nullable|string',
            'condition' => 'nullable|string',

        ]);

    
        Recitation::create($request->all());

        return redirect()->route('recitations.index')->with('success', 'تم إضافة التسميع بنجاح');
    }
    public function done($id)
    {
        $recitation=Recitation::find($id);
        $recitation->condition='done';
        $recitation->save();
        return redirect()->route('recitations.index')->with('success', 'تم  التسميع بنجاح');

    }
     public function update(Request $request, Recitation $recitation)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'subject' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $recitation->update($request->only(['student_id', 'date', 'notes', 'subject']));

        return redirect()->route('recitations.index')->with('success', 'تم تعديل التسميع بنجاح');
    }

  public function destroy($id)

    {
        $recitation=Recitation::find($id);
        $recitation->delete();

        return redirect()->route('recitations.index')->with('success', 'تم حذف التسميع بنجاح');
    }
 
    public function studentRecitations(Student $student)
{
    $recitations = $student->recitations()->orderBy('date','desc')->get(['date','notes','subject']);
    return response()->json($recitations);
}

}




