<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recitation;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PlansController extends Controller
{
     public function index()
    {
        $query = Recitation::query()->with('student');

        $recitations = $query->orderBy('date', 'desc')->get();

        $plans=Student::all();
        return view('plans',compact('plans','recitations'));
    }

    public function getByStudent(Student $student)
{
    $recitations = $student->recitations()->orderBy('date', 'desc')->get();

    return response()->json($recitations);
}


public function my_plan(Request $request)
{
    $userId = auth()->id();
    $student = Student::where('user_id', $userId)->first();

    // بداية query
    $recitationQuery = Recitation::where('student_id', $student->id);

    // فلتر نوع الخطة
    $planType = $request->get('plan_type'); // weekly, monthly, quarterly

    if ($planType == 'weekly') {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $recitationQuery->whereBetween('date', [$startOfWeek, $endOfWeek]);
    } elseif ($planType == 'monthly') {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $recitationQuery->whereBetween('date', [$startOfMonth, $endOfMonth]);
    } elseif ($planType == 'quarterly') {
        $startQuarter = Carbon::now()->subMonths(3)->startOfMonth();
        $endNow = Carbon::now()->endOfMonth();
        $recitationQuery->whereBetween('date', [$startQuarter, $endNow]);
    }

    // فلتر من - إلى (إذا تم تحديده)
    $fromDate = $request->get('fromDate');
    $toDate = $request->get('toDate');

    if ($fromDate) {
        $recitationQuery->whereDate('date', '>=', $fromDate);
    }
    if ($toDate) {
        $recitationQuery->whereDate('date', '<=', $toDate);
    }

    $recitation = $recitationQuery->orderBy('date', 'desc')->get();

    return view('my_plan', compact('student', 'recitation'));
}

}
