<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // عرض صفحة المحادثة مع تمرير الرسائل الأولية
    public function index()
    {
        // نحصل على آخر 50 رسالة مع المستخدم المرتبط (الجديد أولاً)
        $messages = Message::with('user')->latest()->take(50)->get();

        return view('messages', compact('messages'));
    }

    // جلب الرسائل (لـ AJAX) — يعيد partial يحمل المتغير $messages
    public function fetch()
    {
        $messages = Message::with('user')->latest()->take(50)->get();
        return view('partials.messages', compact('messages'));
    }

    // إرسال رسالة جديدة
    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string|max:255']);

        $message = Message::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return response()->json(['success' => true, 'message' => $message]);
    }

    // تعديل رسالة (AJAX)
    public function update(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:255']);
        $message = Message::findOrFail($id);

        // صاحب الرسالة أو الأدمن فقط
        if ($message->user_id !== auth()->id() && ! (auth()->user() && auth()->user()->is_admin) ) {
            return response()->json(['error' => 'غير مصرح'], 403);
        }

        $message->update(['message' => $request->message]);

        return response()->json(['success' => true, 'message' => $message]);
    }

    // حذف رسالة (AJAX)
    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        // صاحب الرسالة أو الأدمن فقط
        if ($message->user_id !== auth()->id() && ! (auth()->user() && auth()->user()->is_admin) ) {
            return response()->json(['error' => 'غير مصرح'], 403);
        }

        $message->delete();

        return response()->json(['success' => true]);
    }
}
