<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>ملف المعلم</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* نفس الـ CSS اللي أرسلته سابقاً */
    *{margin:0;padding:0;box-sizing:border-box;}
    body{font-family:"Cairo",sans-serif;background:#f3f6fb;color:#333;line-height:1.6;}
    .menu-btn{position:fixed;top:20px;right:20px;background:#2563eb;color:#fff;border:none;border-radius:12px;padding:12px 16px;cursor:pointer;z-index:1100;box-shadow:0 4px 12px rgba(0,0,0,.2);}
    .menu-btn svg{width:24px;height:24px;}
   
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
    .sidebar {position: fixed;top: 0;right: -280px;width: 280px;height: 100%;background: #253b5cff;color: #fff;padding: 25px 20px;box-shadow: -4px 0 20px rgba(0,0,0,0.3);transition: right 0.4s ease;z-index: 1000;border-radius: 8px 0 0 8px;overflow-y: auto;}
    .sidebar.open { right: 0; }
    .sidebar-header {display: flex;justify-content: space-between;align-items: center;margin-bottom: 25px;}
    .sidebar h2 { font-size: 18px; font-weight: 700; }
    .sidebar .close-btn {background: none;border: none;color: #fff;font-size: 24px;cursor: pointer;}
    .sidebar .close-btn:hover { color: #253b5cff; }
    .sidebar a {display: flex;align-items: center;gap: 12px;background: #2d3748;border-radius: 14px;padding: 14px;margin-bottom: 12px;text-decoration: none;color: #fff;transition: all 0.25s ease;}
    .sidebar a:hover { background: #253b5cff; }
    main{padding:40px;max-width:1200px;margin:auto;}
    h2{margin-bottom:20px;color:#253b5cff;}
    .table-wrapper{background:#fff;border-radius:16px;box-shadow:0 6px 18px rgba(0,0,0,.08);overflow:hidden;padding:20px;}
    table{width:100%;border-collapse:separate;border-spacing:0 10px;}
    th{background:#f1f5f9;color:#253b5cff;font-weight:700;padding:14px;font-size:15px;}
    td{background:#fff;padding:14px;text-align:center;border-radius:10px;box-shadow:0 2px 6px rgba(0,0,0,.05);font-size:15px;}
    tbody tr{transition:.3s;}
    tbody tr:hover td{background:#f9fafc;}
  </style>
</head>
<body>
<button class="menu-btn" onclick="toggleSidebar()">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
       viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
       d="M4 6h16M4 12h16M4 18h16"/></svg>
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
  <a href="{{ route('plans.index') }}">الخطط</a>
  <a href="{{ route('tasks.index') }}">الواجبات</a>
  <a href="{{ route('teachers.index') }}">المعلمين</a>
  <a href="{{ route('students.index') }}">الطلاب</a>
  <a href="{{ route('absences.index') }}">الغيابات</a>
  <a href="{{ route('calendars.index') }}">التقويم</a>
</div>

<main>
  <h2>معلومات المعلم</h2>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>الاسم</th>
          <th>الهاتف</th>
          <th>الوظيفة</th>
          <th>المؤهل</th>
          <th>الراتب</th>
          <th>البريد الإلكتروني</th>
        </tr>
      </thead>
      <tbody>
        <tr>
       <td>{{ optional($user)->name ?? '-' }}</td>
<td>{{ optional($teacher)->phone ?? '-' }}</td>
<td>{{ optional($teacher)->position ?? '-' }}</td>
<td>{{ optional($teacher)->qualification ?? '-' }}</td>
<td>{{ optional($teacher)->salary ?? '-' }}</td>
<td>{{ optional($user)->email ?? '-' }}</td>

        </tr>
      </tbody>
    </table>
  </div>
</main>

<script>
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const menuBtn = document.querySelector(".menu-btn");
  sidebar.classList.toggle("open");
  menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "block";
}
</script>
</body>
</html>
