<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Absence;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
   public function absences(Request $request)
{
    $query = Absence::with(['student' => fn($q) => $q->withCount('absences')]);

    if ($request->filled('from_date') && $request->filled('to_date')) {
        $from = $request->input('from_date');
        $to = $request->input('to_date');
        $query->whereBetween('date', [$from, $to]);
    } elseif ($request->filled('from_date')) {
        $query->whereDate('date', '>=', $request->input('from_date'));
    } elseif ($request->filled('to_date')) {
        $query->whereDate('date', '<=', $request->input('to_date'));
    }

    $absences = $query->get();
    $students = Student::withCount('absences')->get();

    return view('absences', compact('absences','students'));
}


public function store(Request $request)
{
    $absent=$request->input('absent',[]);
    $reasons=$request->input('reason',[]);
    $date=now()->toDateString();

    foreach($absent as $studentId=>$value)
    {

    Absence::create([
        'student_id'=>$studentId,
        'date'=>$date,
        'reason'=>$reasons[$studentId]?? null,
    ]);

    }
    return redirect()->route('absences.index')
                     ->with('success', 'تم تسجيل الغياب بنجاح 🗑');
}

    public function destroy($id)
{
    $absence = Absence::findOrFail($id);
    $absence->delete();

    return redirect()->route('absences.index')
                     ->with('success', 'تم حذف الغياب بنجاح 🗑');
}

  public function update(Request $request, $id)
    {
        $absence = Absence::findOrFail($id);

        $request->validate([
            'date' => 'required|date',
            'reason' => 'nullable|string|max:255',
        ]);

        $absence->update([
            'date' => $request->date,
            'reason' => $request->reason,
        ]);

        return redirect()->route('absences.index')->with('success', 'تم تحديث الغياب بنجاح');
    }

     public function my_absences(Request $request)
{
    $userId = auth()->id();
    $student = Student::where('user_id', $userId)->first();

    $absencesQuery = Absence::where('student_id', $student->id);

    $fromDate = $request->get('fromDate');
    $toDate = $request->get('toDate');

    if ($fromDate) {
        $absencesQuery->whereDate('date', '>=', $fromDate);
    }
    if ($toDate) {
        $absencesQuery->whereDate('date', '<=', $toDate);
    }

    $absences = $absencesQuery->orderBy('date', 'desc')->get();

    return view('my_absences', compact('absences'));
}
}



