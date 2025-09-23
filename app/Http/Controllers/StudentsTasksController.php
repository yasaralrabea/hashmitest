<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\StudentsTask;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class StudentsTasksController extends Controller
{
    public function index()
    {
        $tasks=StudentsTask::all();

        return view('studentsTasks',compact('tasks'));
    }

  public function store(Request $request)
{
    $request->validate([
        'subject' => 'required|string|max:255',
        'url' => 'nullable|url',
        'open_to' => 'required|date',
        'file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:10240', 
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        
        $filePath = $file->store('tasks_files', 'public');
    }

    StudentsTask::create([
        'subject' => $request->subject,
        'url' => $request->url,
        'open_to' => $request->open_to,
        'file_path' => $filePath, //
    ]);

    return redirect()->route('tasks.index')->with('success', 'تم اضافة الواجب بنجاح');
}


     public function task($id)
    {
        $task=StudentsTask::find($id);

        $submissions=Submission::where('id',$id)->get();


        return view('visittask',compact('task','submissions'));
    }

     public function submission_show($id)
    {
        $submission=Submission::find($id);

        return view('submission',compact('submission'));
    }

     public function rate(Request $request,$id)
    {
        
        $submission=Submission::find($id);
        
        $submission->rate = $request->rate;
        $submission->save();
        return redirect()->route('submission.show',$submission->id)->with('success', 'تم التقييم  بنجاح ');
    }

    public function close($id)
    {
        $task=StudentsTask::find($id);

        $task->condition='close';
        $task->save();
              return redirect()->route('visit.task', $task->id)->with('success', 'تم تعديل الواجب بنجاح ');

    }
    public function open($id)
    {
        $task=StudentsTask::find($id);

        $task->condition='open';
        $task->save();
              return redirect()->route('visit.task', $task->id)->with('success', 'تم تعديل الواجب بنجاح ');

    }
    
   public function update(Request $request, $id)
{
    $task = StudentsTask::findOrFail($id);

    // تحقق من صحة البيانات
    $request->validate([
        'subject' => 'required|string|max:255',
        'url' => 'nullable|url',
        'open_to' => 'required|date',
        'file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:10240', 
    ]);

    if ($request->hasFile('file')) {
        if ($task->file_path && \Storage::disk('public')->exists($task->file_path)) {
           Storage::disk('public')->delete($task->file_path);
        }

        $task->file_path = $request->file('file')->store('tasks_files', 'public');
    }

    $task->update([
        'subject' => $request->subject,
        'url' => $request->url,
        'open_to' => $request->open_to,
        'file_path' => $task->file_path, 
    ]);

    return redirect()->route('visit.task', $task->id)->with('success', 'تم تعديل الواجب بنجاح');
}


     public function destroy($id)
    {
        $task=StudentsTask::find($id);

        $task->delete();
              return redirect()->route('tasks.index')->with('success', 'تم حذف الواجب بنجاح ');

    }
    public function s_index()
    {
        $tasks=StudentsTask::where('condition','open')->get();

        return view('my_tasks',compact('tasks'));
    }

     public function my_task($id)
    {
        $userId = auth()->id();

        $task=StudentsTask::find($id);

        $rate=Submission::where('user_id',$userId) ->where('task_id', $id)->first();

        return view('my_task',compact('task','rate'));
    }
    public function task_store(Request $request)
    {
         $filePath = null;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filePath = $file->store('submissions', 'public'); // يخزن الملف في storage/app/public/submissions
    }

    Submission::create([
        'submission' => $request->submission,
        'url' => $request->url,
        'file' => $filePath, 
        'task_id' => $request->task_id,
        'user_id' => auth()->id(),
    ]);
                return redirect()->route('my_task', $request->task_id)
                     ->with('success', 'تم تسليم الواجب بنجاح');
    }

}
