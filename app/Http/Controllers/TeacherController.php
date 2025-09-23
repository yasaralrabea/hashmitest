<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers=Teacher::all();
        return view('teachers',compact('teachers'));
    }

    public function store(Request $request)
    {
$request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'required|numeric',
            'position'      => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'salary'        => 'required|string|max:255',
            
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'      => ['required', 'confirmed', Password::defaults()],
        ]);
         
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

         Teacher::create([
        'salary' => $request->salary,
        'qualification' => $request->qualification,
        'phone' => $request->phone,
        'name' => $request->name,
        'position' => $request->position,
        'user_id' => $user->id,
    ]);
        return redirect()->route('teachers.index')->with('success', 'تمت إضافة المعلم بنجاح ✅');
    }

   public function show($id)
{
    $teacher = Teacher::with('user')->findOrFail($id);
    return view('teacher', compact('teacher'));
}

    public function update(Request $request, $id)
{
    $teacher = Teacher::findOrFail($id);

    $request->validate([
        'name'          => 'required|string|max:255',
        'phone'         => 'required|numeric',
        'position'      => 'required|string|max:255',
        'qualification' => 'required|string|max:255',
        'salary'        => 'required|string|max:255',
    ]);

    $teacher->update($request->all());

    return redirect()->route('teachers.show', $teacher->id)
                     ->with('success', 'تم تحديث بيانات المعلم بنجاح ✅');
}

public function destroy($id)
{
    $teacher = Teacher::findOrFail($id);
    $user=User::where('id',$teacher->user_id)->first();
    if($user->role=='admin')
    {
     return redirect()->route('teachers.index')
                     ->with('error', '  لا يمكنك حذف الآدمن, أزل الآدمن أولا');   
    }
    else{
    $teacher->delete();

    return redirect()->route('teachers.index')
                     ->with('success', 'تم حذف المعلم بنجاح 🗑');
    }
}

public function promote($id)
{
    $teacher =Teacher::find($id);
    $user=User::where('id',$teacher->user_id)->first();
    $user->role = 'admin';
    $user->save();

    return redirect()->route('teachers.show', $teacher->id)
                     ->with('success', 'تمت ترقية المعلم لمشرف ');
}



public function demote($id)
{
    $teacher = Teacher::find($id);
    $user=User::where('id',$teacher->user_id)->first();
    $user->role = 'user';
    $user->save();

    return redirect()->route('teachers.show', $teacher->id)
                     ->with('success', 'تمت إزالة المعلم لمشرف ');
}

}
