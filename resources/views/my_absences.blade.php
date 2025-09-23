<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>غياباتي -  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
  
  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">

  <style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family:"Cairo", sans-serif; background:#f3f6fb; color:#333; line-height:1.6; }

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
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .menu-btn svg { width: 26px; height: 26px; }
    .menu-btn:hover { background: #2563eb; transform: translateY(-1px); }

    /* الهيدر */
    header {
      background: linear-gradient(90deg, #253b5cff, #253b5cff);
      color:#fff;
      display:flex;
      justify-content:center;
      align-items:center;
      padding:20px 30px;
      box-shadow:0 4px 20px rgba(0,0,0,0.15);
      position:sticky;
      top:0;
      z-index:900;
      text-align:center;
    }
    header h1 { font-size:26px; font-weight:700; }
    header .actions {
      position:absolute;
      left:30px;
      display:flex;
      gap:15px;
      align-items:center;
    }
    header .actions a, header .actions button {
      background: rgba(255,255,255,0.15);
      border:none;
      color:#fff;
      cursor:pointer;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:8px 10px;
      border-radius:8px;
      transition:all 0.3s ease;
    }
    header .actions a:hover, header .actions button:hover { background: rgba(255,255,255,0.3); }
    header .actions svg { width:22px; height:22px; }

    /* القائمة الجانبية */
    .sidebar {
      position: fixed;
      top: 0;
      right: -280px;
      width: 280px;
      height: 100%;
      background: #253b5cff;
      color: #fff;
      padding: 25px 20px;
      box-shadow: -4px 0 20px rgba(0,0,0,0.3);
      transition: right 0.4s ease;
      z-index: 1000;
      border-radius: 8px 0 0 8px;
      overflow-y: auto;
    }
    .sidebar.open { right: 0; }
    .sidebar h2 {
      margin-bottom: 25px;
      font-size: 18px;
      font-weight: 700;
      border-bottom: 1px solid rgba(255,255,255,0.2);
      padding-bottom: 10px;
      text-align: center;
    }
    .sidebar a {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #fff;
      text-decoration: none;
      margin-bottom: 16px;
      font-size: 16px;
      font-weight: 600;
      padding: 14px 18px;
      border-radius: 12px;
      background: #2d3748;
      box-shadow: 0 4px 12px rgba(0,0,0,0.25);
      transition: all 0.3s ease;
    }
    .sidebar a:hover {
      background: #253b5cff;
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.35);
    }
    .close-btn {
      position: absolute;
      top: 20px;
      left: 20px;
      background: transparent;
      border: none;
      color: #fff;
      font-size: 26px;
      cursor: pointer;
    }

    /* المحتوى */
    main { padding:40px; max-width:1200px; margin:auto; }
    h2 { margin-bottom:20px; color:#253b5cff; }

    /* فلتر التاريخ */
    .filter-form { display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap; }
    .filter-form input { padding:8px 12px; border-radius:8px; border:1px solid #ccc; }
    .filter-form button { padding:8px 16px; border:none; border-radius:10px; background:#2563eb; color:#fff; font-weight:600; cursor:pointer; transition:.3s; }
    .filter-form button:hover { background:#1E40AF; }

    /* جدول */
    .table-wrapper { background:#fff; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,.08); overflow-x:auto; padding:20px; }
    table { width:100%; border-collapse:separate; border-spacing:0 10px; font-size:16px; }
    th { background:#f1f5f9; color:#253b5cff; font-weight:700; padding:18px; border-radius:10px 10px 0 0; }
    td { background:#fff; padding:16px; text-align:center; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,.05); }
    tbody tr { transition:.3s; }
    tbody tr:hover td { background:#f9fafc; }

    @media (max-width:768px) {
      table, thead, tbody, tr, th, td { display:block; }
      thead { display:none; }
      tr { background:#fff; margin-bottom:15px; border-radius:12px; padding:15px; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
      td { border:none; display:flex; justify-content:space-between; padding:10px 5px; }
      td::before { content: attr(data-label); font-weight:700; color:#253b5cff; }
    }
  </style>
</head>
<body>

  <!-- زر القائمة -->
  <button class="menu-btn" id="menuBtn" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
  </button>

  <!-- الهيدر -->
  <header>
    <h1>غياباتي</h1>
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
    <a href="{{ route('home') }}">الرئيسية</a>
    <a href="{{ route('my.absences') }}">غياباتي</a>
    <a href="{{ route('my.profile') }}">ملفي الشخصي</a>
    <a href="{{ route('my.calendar') }}">التقويم</a>
    <a href="{{ route('my.plan') }}">خطتي</a>
    <a href="{{ route('s_index') }}">مهامي</a>
  </div>

  <main>
    <form class="filter-form" method="GET" action="{{ route('my.absences') }}">
      <input type="text" name="fromDate" id="fromDate" placeholder="من تاريخ" class="calendar-input" value="{{ request('fromDate') }}">
      <input type="text" name="toDate" id="toDate" placeholder="إلى تاريخ" class="calendar-input" value="{{ request('toDate') }}">
      <button type="submit">تصفية</button>
      <a href="{{ route('my.absences') }}" class="btn-reset" style="padding:8px 16px; border-radius:10px; background:#6b7280; color:#fff; text-decoration:none; display:inline-flex; align-items:center;">إعادة تعيين</a>
    </form>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>التاريخ</th>
            <th>السبب</th>
          </tr>
        </thead>
        <tbody>
          @forelse($absences as $absence)
            <tr>
              <td data-label="التاريخ">{{ $absence->date }}</td>
              <td data-label="السبب">{{ $absence->reason ?? '—' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="2">لا توجد غيابات</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const menuBtn = document.getElementById("menuBtn");
      sidebar.classList.toggle("open");
      menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "flex";
    }

    // Flatpickr لكل input من – إلى
    document.addEventListener("DOMContentLoaded", function(){
      flatpickr(".calendar-input", {
        dateFormat: "Y-m-d",
        allowInput: true,
        clickOpens: true,
        locale: "ar"
      });
    });
  </script>

</body>
</html>
