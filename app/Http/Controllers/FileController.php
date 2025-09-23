<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
     public function index()
    {
        $files = File::orderBy('created_at','desc')->get();
        return view('files', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|max:10240',
        ]);

        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('uploads', 'public');

        File::create([
            'name' => $request->name,
            'type' => $uploadedFile->getClientOriginalExtension(),
            'path' => $path,
        ]);

        return redirect()->route('files.index')->with('success', 'تم رفع الملف بنجاح.');
    }

    public function update(Request $request, File $file)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240',
        ]);


        if ($request->hasFile('file')) {

            Storage::disk('public')->delete($file->path);

            $uploadedFile = $request->file('file');
            $path = $uploadedFile->store('uploads', 'public');
            $file->path = $path;
            $file->type = $uploadedFile->getClientOriginalExtension();
        }

        $file->name = $request->name;
        $file->save();

        return redirect()->route('files.index')->with('success', 'تم تعديل الملف بنجاح.');
    }

    public function destroy(File $file)
    {
        Storage::disk('public')->delete($file->path);
        $file->delete();

        return redirect()->route('files.index')->with('success', 'تم حذف الملف بنجاح.');
    }
}
