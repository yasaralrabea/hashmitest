<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>عرض الواجب -  </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:"Cairo",sans-serif;background:#eef2f7;color:#333}

/* زر القائمة */
.menu-btn{
 position:fixed;top:20px;right:20px;
       background: #253b5cff;
;color:#fff;
 border:none;border-radius:12px;
 padding:10px 14px;cursor:pointer;z-index:1100;
 box-shadow:0 4px 12px rgba(0,0,0,.15)
}
.menu-btn svg{width:24px;height:24px}

    /* الهيدر */
    header {
      background: linear-gradient(90deg, #253b5cff, #253b5cff);
      color: #fff;
      display: flex;
      justify-content: center; /* وسط */
      align-items: center;
      padding: 20px 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
      position: sticky;
      top: 0;
      z-index: 900;
      text-align: center;
    }
    header h1 {
      font-size: 26px;
      font-weight: 700;
    }
    header .actions {
      position: absolute;
      left: 30px;
      display: flex;
      gap: 15px;
      align-items: center;
    }
    header .actions a, header .actions button {
      background: rgba(255,255,255,0.15);
      border: none;
      color: #fff;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 8px 10px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    header .actions a:hover, header .actions button:hover {
      background: rgba(255,255,255,0.3);
    }
    header .actions svg {
      width: 22px;
      height: 22px;
    }
/* القائمة الجانبية */
.sidebar{
 position:fixed;top:0;right:-260px;width:260px;height:100%;
       background: #253b5cff;
;color:#fff;
 padding:25px 20px;box-shadow:-4px 0 20px rgba(0,0,0,.3);
 transition:right .4s;z-index:1000;border-radius:10px 0 0 10px
}
.sidebar.open{right:0}
.sidebar-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:25px}
.sidebar h2{font-size:20px;font-weight:700}
.sidebar .close-btn{background:none;border:none;color:#fff;font-size:26px;cursor:pointer}
.sidebar a{
 display:flex;align-items:center;gap:12px;
 background:#2d3748;border-radius:14px;
 padding:14px;margin-bottom:12px;
 text-decoration:none;color:#fff;transition:.25s
}
.sidebar a:hover{      background: #253b5cff;
;transform:translateX(-4px)}

/* المحتوى */
.container{max-width:950px;margin:40px auto;display:flex;flex-direction:column;gap:25px;padding:0 20px}
.card{
 background:#fff;border-radius:16px;padding:25px 28px;
 box-shadow:0 6px 16px rgba(0,0,0,.1)
}
.card h2{color:#253b5cff;margin-bottom:18px;font-size:20px}
.card form label{display:block;margin-bottom:6px;font-weight:600;color:#374151}
.card form input,.card form select{
 width:100%;padding:12px;margin-bottom:14px;
 border:1px solid #ccc;border-radius:10px;font-size:15px;background:#f9fafb
}
.card form input:focus,.card form select:focus{outline:none;border-color:#253b5cff;background:#fff}

/* أزرار */
.btn{
 padding:10px 16px;border-radius:10px;border:none;
 cursor:pointer;color:#fff;font-size:14px;font-weight:600;
 transition:.3s;display:inline-flex;align-items:center;gap:6px;
 box-shadow:0 3px 8px rgba(0,0,0,.15);text-decoration:none
}
.btn svg{width:16px;height:16px}
.btn-blue{      background: #253b5cff;
}.btn-blue:hover{background:#2563EB}
.btn-green{background:#10B981}.btn-green:hover{background:#059669}
.btn-red{background:#EF4444}.btn-red:hover{background:#DC2626}

/* الحالة */
.status{font-weight:600;margin-bottom:12px}

/* الجدول */
.table-wrapper{
 background:#fff;border-radius:16px;padding:20px;
 box-shadow:0 6px 16px rgba(0,0,0,.1);overflow-x:auto
}
.table-wrapper table{
 width:100%;border-collapse:separate;border-spacing:0 10px
}
.table-wrapper th,.table-wrapper td{padding:14px 12px;text-align:center}
.table-wrapper th{
 background:#f3f4f6;font-weight:700;font-size:15px;color:#253b5cff;border-radius:10px
}
.table-wrapper tr{
 background:#fff;box-shadow:0 2px 6px rgba(0,0,0,.08);border-radius:12px
}
.table-wrapper td{font-size:15px}
</style>
</head>
<body>

<button class="menu-btn" onclick="toggleSidebar()">
 <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
 viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
 d="M4 6h16M4 12h16M4 18h16"/></svg>
</button>

  <!-- الهيدر -->
  <header>
    <h1> </h1>
    <div class="actions">
      <a href="{{ route('my.profile') }}" title="حسابي">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
      </a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" title="تسجيل خروج">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2v-1m0-10V5a2 2 0 012-2h4a2 2 0 012 2v1"/>
          </svg>
        </button>
      </form>
    </div>
  </header>

<!-- القائمة الجانبية -->
<div class="sidebar" id="sidebar">
 <div class="sidebar-header">
   <h2>القائمة</h2>
   <button class="close-btn" onclick="toggleSidebar()">×</button>
 </div>
 <a href="{{ route('tasks.index') }}">الواجبات</a>
 <a href="{{ route('plans.index') }}">الخطط</a>
 <a href="{{ route('students.index') }}">الطلاب</a>
 <a href="{{ route('teachers.index') }}">المعلمين</a>
 <a href="{{ route('absences.index') }}">الغيابات</a>
 <a href="{{ route('calendars.index') }}">التقويم</a>
     <a href="{{ route('control_page') }}">الرئيسية</a>

</div>

<div class="container">

 <div class="card">
   <div class="status">الحالة: 
     <strong>{{ $task->condition == 'open' ? ' مفتوح' : ' مغلق' }}</strong>
   </div>
   @if($task->condition == 'open')
   <a href="{{ route('tasks.close', $task->id) }}" class="btn btn-red">إغلاق الواجب</a>
   @else
   <a href="{{ route('tasks.open', $task->id) }}" class="btn btn-green">فتح الواجب</a>
   @endif
   <a href="{{ route('tasks.index') }}" class="btn btn-blue"> العودة للواجبات</a>
<form action="{{ route('task.destroy', $task->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-red" onclick="return confirm('هل أنت متأكد من الحذف؟')">
        حذف الواجب
    </button>
</form>

 </div>

 <div class="card">
   <h2> تعديل الواجب</h2>
 <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>المادة</label>
    <input type="text" name="subject" value="{{ old('subject', $task->subject) }}" required>

    <label>الرابط</label>
    <input type="url" name="url" value="{{ old('url', $task->url) }}" placeholder="اختياري">

    <label>مفتوح للطلاب حتى</label>
    <input type="date" name="open_to" value="{{ old('open_to', $task->open_to) }}" required>

    <label>ملف الواجب</label>
    <input type="file" name="file">

    @if($task->file_path)
        <p>الملف الحالي: 
            <a href="{{ asset('storage/' . $task->file_path) }}" target="_blank">تحميل الملف</a>
        </p>
    @endif

    <button type="submit" class="btn btn-blue">💾 تحديث الواجب</button>
</form>

 </div>

 <div class="card">
   <h2>📂 التسليمات</h2>
   @if($task->submissions && $task->submissions->count())
   <div class="table-wrapper">
     <table>
       <thead>
         <tr>
           <th>اسم الطالب</th>
           <th>الإجراء</th>
         </tr>
       </thead>
       <tbody>
         @foreach($task->submissions as $submission)
         <tr>
           <td>{{ $submission->user->name ?? 'غير معروف' }}</td>
           <td>
             <a href="{{ route('submission.show',$submission->id) }}" class="btn btn-blue">🔗 زيارة التسليم</a>
           </td>
         </tr>
         @endforeach
       </tbody>
     </table>
   </div>
   @else
   <p>لا توجد تسليمات حتى الآن.</p>
   @endif
 </div>

</div>
<script>
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const menuBtn = document.querySelector(".menu-btn");

  sidebar.classList.toggle("open");

  // إخفاء زر القائمة عند فتح الـ sidebar وإظهاره عند الإغلاق
  if (sidebar.classList.contains("open")) {
    menuBtn.style.display = "none";
  } else {
    menuBtn.style.display = "block";
  }
}
</script>

</body>
</html>
