<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\Student;

class StudentsController extends Controller
{
    public function index()
    {
        $students=Student::all();
        return view('students',compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'track'         => 'required|string|max:255',
            'phone'         => 'required|numeric',
            'memorization'      => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'age'        => 'required|string|max:255',
            'goal'        => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'      => ['required', 'confirmed', Password::defaults()],
            'juz'=>'required|string|max:255',

        ]);

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Student::create([
        'name' => $request->name,
        'track' => $request->track,
        'phone' => $request->phone,
        'memorization' => $request->memorization,
        'level' => $request->level,
        'age' => $request->age,
        'goal' => $request->goal,
        'juz' => $request->goal,
        'user_id' => $user->id,
    ]);
        



        return redirect()->route('students.index')->with('success', 'تمت إضافة الطالب بنجاح ✅');
    }

    public function show($id)
    {
        $student=Student::find($id);
        return view('student',compact('student'));
        
    }
    public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    $request->validate([
         'name'          => 'required|string|max:255',
            'track'         => 'required|string|max:255',
            'phone'         => 'required|numeric',
            'memorization'      => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'age'        => 'required|string|max:255',
            'goal'        => 'required|string|max:255',
            'juz'=>'required|string|max:255',
    ]);

    $student->update($request->all());

    return redirect()->route('students.show', $student->id)
                     ->with('success', 'تم تحديث بيانات الطالب بنجاح ✅');
}

public function destroy($id)
{
    $student = Student::findOrFail($id);
    $student->delete();

    return redirect()->route('students.index')
                     ->with('success', 'تم حذف الطالب بنجاح 🗑');
}



}
