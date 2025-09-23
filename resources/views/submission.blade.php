<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تفاصيل التسليم -  </title>
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
    header{
      background:linear-gradient(90deg,#253b5cff,#253b5cff);
      color:#fff;display:flex;justify-content:center;align-items:center;
      padding:18px 30px;box-shadow:0 4px 20px rgba(0,0,0,.15);
      position:sticky;top:0;z-index:900;text-align:center
    }
    header h1{font-size:22px;font-weight:700}
    header .actions{
      position:absolute;left:30px;
      display:flex;gap:14px;align-items:center
    }
    header .actions a,header .actions button{
      background:rgba(255,255,255,0.15);border:none;
      color:#fff;cursor:pointer;display:flex;
      align-items:center;justify-content:center;
      padding:8px 10px;border-radius:8px;
      transition:.3s;text-decoration:none
    }
    header .actions a:hover,header .actions button:hover{background:rgba(255,255,255,0.3)}
    header .actions svg{width:22px;height:22px}

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
    .container{max-width:850px;margin:40px auto;display:flex;flex-direction:column;gap:25px;padding:0 20px}
    .card{
      background:#fff;border-radius:16px;padding:25px 28px;
      box-shadow:0 6px 16px rgba(0,0,0,.1)
    }
    .card h2{color:#253b5cff;margin-bottom:18px;font-size:20px}

    /* أزرار */
    .btn{
      padding:10px 16px;border-radius:10px;border:none;
      cursor:pointer;color:#fff;font-size:14px;font-weight:600;
      transition:.3s;display:inline-flex;align-items:center;gap:6px;
      box-shadow:0 3px 8px rgba(0,0,0,.15);text-decoration:none
    }
    .btn-blue{      background: #253b5cff;
}.btn-blue:hover{background:#2563EB}
    .btn-green{background:#10B981}.btn-green:hover{background:#059669}
    .btn-red{background:#EF4444}.btn-red:hover{background:#DC2626}

    /* فورم */
    form label{display:block;margin-bottom:6px;font-weight:600;color:#374151}
    form input,form textarea{
      width:100%;padding:12px;margin-bottom:14px;
      border:1px solid #ccc;border-radius:10px;font-size:15px;background:#f9fafb
    }
    form input:focus,form textarea:focus{outline:none;border-color:#253b5cff;background:#fff}

    /* معلومات */
    .info p{margin:10px 0;font-size:15px}
    .info .note{
      background:#f3f4f6;padding:12px;border-radius:10px;margin-top:6px
    }
  </style>
</head>
<body>

<button class="menu-btn" onclick="toggleSidebar()">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
       viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
       d="M4 6h16M4 12h16M4 18h16"/></svg>
</button>

<header>
  <div class="actions">
    <a href="{{ route('profile.edit') }}" title="حسابي">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
           viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
           d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
    </a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" title="تسجيل خروج">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
             d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2v-1m0-10V5a2 2 0 012-2h4a2 2 0 012 2v1"/></svg>
      </button>
    </form>
  </div>
  <h1>تفاصيل التسليم</h1>
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

  <a href="{{ route('visit.task', $submission->task_id) }}" class="btn btn-blue">⬅️ العودة للواجب</a>

  <div class="card info">
    <p><strong>👤 اسم الطالب:</strong> {{ $submission->user->name ?? 'غير معروف' }}</p>
    <p><strong> وقت التسليم:</strong> {{ $submission->created_at->format('Y-m-d H:i') }}</p>

    @if($submission->submission)
      <p><strong> ملاحظات الطالب:</strong></p>
      <div class="note">{{ $submission->submission }}</div>
    @endif

    @if($submission->url)
      <p><strong>🔗 رابط الواجب:</strong> 
        <a href="{{ $submission->url }}" target="_blank">{{ $submission->url }}</a>
      </p>
    @endif

    @if($submission->file)
      <p><strong>📂 ملف مرفق:</strong> 
        <a href="{{ asset('storage/' . $submission->file) }}" target="_blank">تحميل الملف</a>
      </p>
    @endif
  </div>

  <div class="card">
    <h2> تسجيل التقييم</h2>
    <form action="{{ route('submissions.rate', $submission->id) }}" method="POST">
    @csrf
    @method('PUT')          <label>التقييم</label>
    <input type="text" name="rate" value="{{ old('rate', $submission->rate) }}" required>
    <button type="submit" class="btn btn-green">💾 حفظ التقييم</button>
</form>

  </div>

</div>

<script>
function toggleSidebar(){
  document.getElementById("sidebar").classList.toggle("open");
}
</script>

</body>
</html>
