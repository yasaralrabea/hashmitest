<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>ملف الطالب</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    *{margin:0;padding:0;box-sizing:border-box;}
    body{font-family:"Cairo",sans-serif;background:#f3f6fb;color:#333;line-height:1.6;}

    /* زر القائمة */
    .menu-btn{
      position:fixed;
      top:50%;
      right:0;
      transform:translateY(-50%);
      width:44px;
      height:44px;
      background:#2563eb;
      color:#fff;
      border:none;
      border-radius:50%;
      display:flex;
      align-items:center;
      justify-content:center;
      cursor:pointer;
      z-index:1100;
      box-shadow:0 4px 12px rgba(0,0,0,.25);
    }
    .menu-btn svg{width:24px;height:24px;transform:rotate(180deg);} /* يخلي السهم راسه لليسار */

    /* الهيدر */
    header {
      background: linear-gradient(90deg, #253b5cff, #253b5cff);
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
      position: sticky;
      top: 0;
      z-index: 900;
      min-height: 70px;
      flex-wrap: nowrap;
    }
    header h1 {
      font-size: 26px;
      font-weight: 700;
      text-align: center;
      flex: 1 1 auto;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    header .actions {
      display: flex;
      gap: 12px;
      align-items: center;
      flex-shrink: 0;
      z-index: 1001;
    }
    header .actions a,
    header .actions button {
      background: rgba(255,255,255,0.15);
      border: none;
      color: #fff;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 10px 12px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    header .actions a:hover,
    header .actions button:hover {
      background: rgba(255,255,255,0.3);
    }
    header .actions svg {
      width: 24px;
      height: 24px;
    }

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
    main { padding:40px; max-width:1200px; margin:auto; }
    h2 { margin-bottom:20px; color:#253b5cff; }
    .table-wrapper {
      background:#fff; border-radius:16px;
      box-shadow:0 6px 18px rgba(0,0,0,.08);
      overflow:hidden; padding:20px;
    }
    table { width:100%; border-collapse:collapse; }
    th {
      background:#f1f5f9; color:#253b5cff;
      font-weight:700; padding:14px; font-size:15px;
      text-align:center;
    }
    td {
      background:#fff; padding:14px; text-align:center;
      font-size:15px; border-bottom:1px solid #eee;
    }
    tbody tr:last-child td{border-bottom:none;}

    /* كروت للجوال */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr { display:block; }
      thead { display:none; }
      tr { margin-bottom:15px; background:#fff; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,.05); padding:12px; }
      td {
        border:none !important;
        display:flex;
        justify-content:space-between;
        padding:10px 6px;
        font-size:14px;
      }
      td::before {
        content: attr(data-label);
        font-weight:600;
        color:#253b5cff;
      }
    }
  </style>
</head>
<body>

<button class="menu-btn" onclick="toggleSidebar()">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
       viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
       d="M15 19l-7-7 7-7" /></svg>
</button>

<header>
  <h1> ملفي</h1>
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
  <h2>معلومات الطالب</h2>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>الاسم</th>
          <th>العمر</th>
          <th>المسار</th>
          <th>الحفظ</th>
          <th>المستوى</th>
          <th>الهدف</th>
          <th>الهاتف</th>
          <th>رقم المستخدم</th>
          <th>الجزء</th>
          <th>البريد الإلكتروني</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $student->age }}</td>
          <td>{{ $student->track }}</td>
          <td>{{ $student->memorization }}</td>
          <td>{{ $student->level }}</td>
          <td>{{ $student->goal }}</td>
          <td>{{ $student->phone }}</td>
          <td>{{ $student->user_id }}</td>
          <td>{{ $student->juz }}</td>
          <td>{{ $user->email }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</main>

<style>
.table-wrapper {
  background:#fff;
  border-radius:16px;
  box-shadow:0 6px 18px rgba(0,0,0,.08);
  overflow:hidden;
  padding:20px;
  margin-top:20px;
}
table {
  width:100%;
  border-collapse:collapse;
  font-size:15px;
}
th {
  background:#f1f5f9;
  color:#253b5cff;
  font-weight:700;
  padding:14px;
  text-align:center;
}
td {
  background:#fff;
  padding:14px;
  text-align:center;
  font-size:15px;
  border-bottom:1px solid #eee;
}
tbody tr:last-child td{border-bottom:none;}

/* عرض كروت على الجوال */
@media (max-width:768px){
  table, thead, tbody, th, td, tr { display:block; }
  thead { display:none; }
  tr { margin-bottom:15px; background:#fff; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,.05); padding:12px; }
  td {
    border:none !important;
    display:flex;
    justify-content:space-between;
    padding:10px 6px;
    font-size:14px;
  }
  td::before {
    content: attr(data-label);
    font-weight:600;
    color:#253b5cff;
  }
}
</style>

<script>
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const menuBtn = document.querySelector(".menu-btn");
  sidebar.classList.toggle("open");
  menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "flex";
}
</script>

</body>
</html>
