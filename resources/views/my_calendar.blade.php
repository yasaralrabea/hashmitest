<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>التقويم -  </title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.css" rel="stylesheet" />

  <style>
    *{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:"Cairo",sans-serif;background:#eef2f7;color:#333;line-height:1.6;}

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
    .sidebar a:hover {background: #253b5cff; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.35);}
    .close-btn {position: absolute; top: 20px; left: 20px; background: transparent; border: none; color: #fff; font-size: 26px; cursor: pointer;}

    /* المحتوى */
    main {max-width:1200px;margin:30px auto;padding:20px;}
    .table-wrapper{background:#fff;border-radius:16px;padding:25px; box-shadow:0 10px 30px rgba(11,35,71,0.06);}
    table{width:100%;border-collapse:collapse;font-size:18px;}
    thead th{background:#f3f6fb;color:#253b5cff;font-weight:700;padding:14px;text-align:center;font-size:19px;}
    tbody td{padding:14px;text-align:center;border-top:1px solid #f1f5f9;}
    .empty{padding:20px;text-align:center;color:#6b7280;}

    @media (max-width:720px){
      table, thead, tbody, th, td, tr {display:block; width:100%;font-size:16px;}
      thead{display:none;}
      tbody tr{background:#fff; margin-bottom:15px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.08); padding:12px;}
      tbody td{display:flex;justify-content:space-between;text-align:right; padding:8px 10px; border:none;}
      tbody td::before{content:attr(data-label); font-weight:700; color:#253b5cff;}
    }

    /* زر عرض التقويم */
    #showCalendarBtn{
            background: #253b5cff;
;color:#fff;padding:16px 22px;border-radius:12px;font-weight:600;border:none;cursor:pointer;margin:10px 0;transition:0.3s;font-size:18px;
    }
    #showCalendarBtn:hover{background:#2563eb;}

    /* تقويم منبثق */
    #calendarModal{
      display:none;position:fixed;top:0; left:0; width:100%; height:100%;
      background:rgba(0,0,0,0.6);justify-content:center;align-items:center;z-index:1200;
    }
    #calendarModal .modal-content{
      background:#fff; border-radius:16px; padding:20px; width:95%; max-width:900px; max-height:90%; overflow:auto;
      display:flex; flex-direction:column; align-items:center;
    }
    #fullCalendar {width:100%;}
    #calendarModal .close-modal{
      margin-top:15px;
      background:#ef4444; color:#fff; border:none; border-radius:8px;
      padding:8px 20px; cursor:pointer; font-size:16px; font-weight:600;
    }

    /* إظهار النص كامل في الأحداث */
    .fc-event-title {
      white-space: normal !important;
      overflow: visible !important;
      text-overflow: unset !important;
      line-height: 1.4;
      font-size: 14px;
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
    <h1>   التقويم</h1>
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
  <button id="showCalendarBtn">عرض التقويم</button>

  <div class="table-wrapper">
    <table aria-label="تقويم الطلاب">
      <thead>
        <tr>
          <th>التاريخ</th>
          <th>الهدف</th>
        </tr>
      </thead>
      <tbody>
        @forelse($calendar as $item)
          <tr>
            <td data-label="التاريخ">{{ $item->date }}</td>
            <td data-label="الهدف">{{ $item->goal ?? '-' }}</td>
          </tr>
        @empty
          <tr><td colspan="2" class="empty">لا توجد أهداف في التقويم حالياً.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</main>

<div id="calendarModal">
  <div class="modal-content">
    <div id="fullCalendar"></div>
    <button class="close-modal" onclick="closeCalendar()">إغلاق</button>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
<script>
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const menuBtn = document.getElementById("menuBtn");
    sidebar.classList.toggle("open");
    menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "flex";
  }

  const modal = document.getElementById("calendarModal");
  document.getElementById("showCalendarBtn").addEventListener("click", () => {
    modal.style.display = "flex";
    const calendarEl = document.getElementById('fullCalendar');
    if (!window.calendar) {
      window.calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'ar',
        height: 'auto',
        events: [
          @foreach($calendar as $item)
            { title: "{{ $item->goal ?? '-' }}", start: "{{ $item->date }}" },
          @endforeach
        ],
        eventContent: function(arg) {
          return { html: '<div style="white-space:normal;">' + arg.event.title + '</div>' }
        }
      });
    }
    window.calendar.render();
    window.calendar.updateSize();
  });

  function closeCalendar(){ modal.style.display = "none"; }
</script>
</body>
</html>
