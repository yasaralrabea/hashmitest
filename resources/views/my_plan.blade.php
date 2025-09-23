<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>خطة الطالب</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">

<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:"Cairo",sans-serif;background:#f3f6fb;color:#333;line-height:1.6;}

/* الهيدر */
header {
    background: linear-gradient(90deg, #253b5cff, #253b5cff);
    color:#fff;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 25px;
    box-shadow:0 4px 20px rgba(0,0,0,0.15);
    position:sticky;
    top:0;
    z-index:900;
    min-height:70px;
}
header h1{ font-size:26px;font-weight:700; flex:1; text-align:center; }
header .actions{ display:flex; gap:12px; align-items:center; }
header .actions a, header .actions button{
    background: rgba(255,255,255,0.15); border:none; color:#fff; cursor:pointer;
    display:flex; align-items:center; justify-content:center; padding:10px 12px; border-radius:8px; transition:.3s;
}
header .actions a:hover, header .actions button:hover{ background: rgba(255,255,255,0.3); }
header .actions svg{ width:24px; height:24px; }

    /* زر القائمة */
    .menu-btn {
      flex-shrink: 0;
      position: fixed;
      top: 20px;
      right: 20px;
      background: #253b5cff;
      color: #fff;
      border: none;
      border-radius: 12px;
      padding: 10px 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.25);
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
      z-index: 1100;
    }
    .menu-btn svg { width: 26px; height: 26px; }
    .menu-btn:hover { background: #2563eb; transform: translateY(-1px); }

/* القائمة الجانبية */
.sidebar{
    position:fixed; top:0; right:-280px; width:280px; height:100%;       background: #253b5cff;
; color:#fff; padding:25px 20px;
    box-shadow:-4px 0 20px rgba(0,0,0,0.3); transition:right .4s; z-index:1000; border-radius:8px 0 0 8px; overflow-y:auto;
}
.sidebar.open{ right:0; }
.sidebar-header{ display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; }
.sidebar h2{ font-size:18px; font-weight:700; text-align:center; }
.sidebar .close-btn{ background:none; border:none; color:#fff; font-size:24px; cursor:pointer; }
.sidebar a{
    display:flex; align-items:center; gap:12px; color:#fff; text-decoration:none; margin-bottom:16px; font-size:16px; font-weight:600; padding:14px 18px;
    border-radius:12px; background:#2d3748; box-shadow:0 4px 12px rgba(0,0,0,0.25); transition:.3s;
}
.sidebar a:hover{       background: #253b5cff;
; transform:translateY(-2px); box-shadow:0 6px 16px rgba(0,0,0,0.35); }

/* المحتوى */
main{padding:40px; max-width:1200px; margin:auto;}
h2{margin-bottom:20px; color:#253b5cff;}

.card-plan{
    background:#fff; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,.08);
    padding:25px; margin-bottom:30px; display:flex; flex-direction:column; gap:10px;
}
.card-plan span{ font-weight:600; color:#374151; }
.card-plan p{ font-size:16px; color:#253b5cff; }

/* أزرار الفلتر */
.filter-buttons{ display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap; }
.btn-plan, .btn-calendar{
    padding:8px 16px;
    border-radius:10px;
    border:none;
    cursor:pointer;
    font-weight:600;
    color:#fff;
          background: #253b5cff;
;
    transition:.3s;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    justify-content:center;
}
.btn-plan:hover, .btn-calendar:hover{ background:#2563EB; }
.btn-plan.active{ background:#1E40AF; }
.btn-calendar{ margin-left:auto; }

/* جدول */
.table-wrapper{
    background:#fff; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,.08);
    overflow-x:auto; padding:20px;
}
table{ width:100%; border-collapse:separate; border-spacing:0 10px; }
th{ background:#f1f5f9; color:#253b5cff; font-weight:700; padding:14px; font-size:15px; }
td{ background:#fff; padding:14px; text-align:center; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,.05); font-size:15px; }
tbody tr:hover td{ background:#f9fafc; }
.calendar-input{ cursor:pointer; text-align:center; background:#eef2f7; border:1px solid #ccc; border-radius:8px; padding:8px; width:120px; }
</style>
</head>
<body>

<button class="menu-btn" onclick="toggleSidebar()">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
</svg>
</button>

<header>
<h1>خطتي</h1>
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

<div class="sidebar" id="sidebar">
<div class="sidebar-header">
<h2>القائمة</h2>
<button class="close-btn" onclick="toggleSidebar()">×</button>
</div>
<a href="{{ route('home') }}">الرئيسية</a>
<a href="{{ route('my.absences') }}">غياباتي</a>
<a href="{{ route('my.profile') }}">ملفي الشخصي</a>
<a href="{{ route('my.calendar') }}">التقويم</a>
<a href="{{ route('my.plan') }}">خطتي</a>
<a href="{{ route('s_index') }}">مهامي</a>
</div>

<main>
<div class="card-plan">
<p><span>الاسم:</span> {{ $student->name }}</p>
<p><span>المسار:</span> {{ $student->track }}</p>
<p><span>الحفظ:</span> {{ $student->memorization }}</p>
<p><span>الهدف:</span> {{ $student->goal }}</p>
<p><span>الأجزاء:</span> {{ $student->juz }}</p>
</div>
<!-- أزرار الفلتر والخطة مع فلتر التاريخ -->
<div class="filter-buttons">
    <!-- زر أسبوعية -->
    <a href="{{ route('my.plan', ['plan_type'=>'weekly']) }}" 
       class="btn-plan {{ request('plan_type')=='weekly' ? 'active' : '' }}">أسبوعية</a>

    <!-- زر شهرية -->
    <a href="{{ route('my.plan', ['plan_type'=>'monthly']) }}" 
       class="btn-plan {{ request('plan_type')=='monthly' ? 'active' : '' }}">شهرية</a>

    <!-- فلتر التاريخ من - إلى -->
    <form method="GET" action="{{ route('my.plan') }}" class="btn-plan" style="display:flex; gap:5px; align-items:center;">
        <input type="date" name="fromDate" class="calendar-input" placeholder="من" value="{{ request('fromDate') }}" style="height:36px;">
        <input type="date" name="toDate" class="calendar-input" placeholder="إلى" value="{{ request('toDate') }}" style="height:36px;">
        <button type="submit" class="btn-plan">تصفية</button>
    </form>
</div>


<h2>التسميع</h2>
<div class="table-wrapper">
<table>
<thead>
<tr>
<th>المادة</th>
<th>الحالة</th>
<th>ملاحظات</th>
<th>التاريخ</th>
</tr>
</thead>
<tbody>
@forelse($recitation as $rec)
<tr>
<td>{{ $rec->notes }}</td>
<td>{{ $rec->condition == 'no' ? 'لم تسمع' : ($rec->condition == 'done' ? 'تم' : $rec->condition) }}</td>
<td>{{ $rec->subject }}</td>
<td><input type="text" class="calendar-input" value="{{ \Carbon\Carbon::parse($rec->date)->format('Y-m-d') }}" readonly></td>
</tr>
@empty
<tr><td colspan="4">لا توجد سجلات تسميع</td></tr>
@endforelse
</tbody>
</table>
</div>
</main>

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const menuBtn = document.querySelector(".menu-btn");
    sidebar.classList.toggle("open");
    menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "block";
}

// Flatpickr لكل التواريخ
document.addEventListener("DOMContentLoaded", function(){
    flatpickr(".calendar-input", {
        dateFormat: "Y-m-d",
        allowInput: true,
        clickOpens: true,
        locale: "ar"
    });
});

// دالة زر عرض التقويم (يمكن تعديلها لتفتح مودال أو نافذة جديدة)
function openCalendar() {
    alert("هنا يمكنك ربط التقويم التفاعلي أو مودال التقويم");
}
</script>

</body>
</html>
