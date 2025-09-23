<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>الخطط -  </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* --- Reset & Base --- */
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:"Cairo",sans-serif; background:#eef2f7; color:#333; }

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
.sidebar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
}
.sidebar h2 { font-size: 18px; font-weight: 700; }
.sidebar .close-btn {
  background: none;
  border: none;
  color: #fff;
  font-size: 24px;
  cursor: pointer;
}
.sidebar .close-btn:hover { color: #253b5cff; }

/* عناصر القائمة */
.sidebar a {
  display: flex;
  align-items: center;
  gap: 12px;
  background: #2d3748;
  border-radius: 14px;
  padding: 14px;
  margin-bottom: 12px;
  text-decoration: none;
  color: #fff;
  transition: all 0.25s ease;
}
.sidebar a:hover {
  background: #ffec1dff;
}
.sidebar a svg {
  width: 22px;
  height: 22px;
}
/* --- الهيدر --- */
header {
  background: linear-gradient(90deg, #253b5cff, #253b5cff);
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px 30px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.15);
  position: sticky;
  top: 0;
  z-index: 900;
  text-align: center;
}
header h1 { font-size: 26px; font-weight: 700; }
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
header .actions a:hover, header .actions button:hover { background: rgba(255,255,255,0.3); }
header .actions svg { width: 22px; height: 22px; }

/* --- محتوى الصفحة --- */
main { padding:35px; max-width:1200px; margin:auto; }
.table-wrapper { background:#fff; border-radius:16px; padding:20px; box-shadow:0 8px 24px rgba(0,0,0,.12); overflow-x:auto; }
.table-wrapper table { width:100%; border-collapse:collapse; table-layout: fixed; }
.table-wrapper th, .table-wrapper td { padding:16px 12px; text-align:center; vertical-align:middle; border-bottom:1px solid #e5e7eb; word-wrap: break-word; }
.table-wrapper th {       background: #253b5cff;
; color:#fff; font-weight:700; font-size:15px; }
.table-wrapper td { font-size:15px; background:#fff; }

/* --- أزرار --- */
.btn { padding:6px 12px; border-radius:10px; border:none; cursor:pointer; color:#fff; font-size:14px; transition:.3s; }
.btn-view { background:#10B981; }
.btn-view:hover { background:#059669; }

/* --- مودال --- */
.modal { display:none; position:fixed; inset:0; background:rgba(0,0,0,.55); justify-content:center; align-items:flex-start; padding-top:60px; z-index:1200; }
.modal-content { background:#fff; padding:28px; border-radius:16px; width:90%; max-width:800px; max-height:90vh; overflow-y:auto; animation:fadeIn .3s; }
.modal-content h2 { margin-bottom:22px; color:#253b5cff; font-size:20px; }
.close-btn-modal { background:#e5e7eb; color:#111; padding:8px 12px; border-radius:10px; cursor:pointer; border:none; font-size:14px; margin-bottom:14px; }
.close-btn-modal:hover { background:#d1d5db; }

@keyframes fadeIn { from{opacity:0; transform:translateY(-15px);} to{opacity:1; transform:translateY(0);} }

/* --- فلاتر --- */
.filters {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  margin-bottom: 18px;
  align-items: center;
}
.filters select, .filters input[type="date"] {
  padding: 8px 12px;
  border-radius: 8px;
  border: 1px solid #d1d5db;
  background: #f9fafb;
  font-size: 14px;
  transition: .3s;
}
.filters select:focus, .filters input[type="date"]:focus {
  outline: none;
  border-color: #253b5cff;
  background: #fff;
}
.filters .btn-apply {       background: #253b5cff;
; }
.filters .btn-apply:hover {       background: #253b5cff;
; }
.filters .btn-reset { background:#6b7280; }
.filters .btn-reset:hover { background:#4b5563; }
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
  <h1>   الخطط القرآنية</h1>
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
  
  <a href="{{ route('plans.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M9 17v-6h13v6M9 5v6h13V5M3 7h2v10H3z"/>
    </svg> الخطط
  </a>
  
  <a href="{{ route('tasks.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M12 20h9M12 4h9M4 9h16M4 15h16"/>
    </svg> الواجبات
  </a>
  
  <a href="{{ route('teachers.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg> المعلمين
  </a>
  
  <a href="{{ route('students.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg> الطلاب
  </a>
  
  <a href="{{ route('absences.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M9 17v-6h13v6M9 5v6h13V5M3 7h2v10H3z"/>
    </svg> الغيابات
  </a>
  
  <a href="{{ route('calendars.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
    </svg> التقويم
  </a>

  <!-- العناصر الجديدة -->
  <a href="{{ route('files.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m0-4h4m-4 4h4"/>
    </svg> الملفات
  </a>

  <a href="{{ route('fins.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.333 0-4 1.333-4 4s2.667 4 4 4 4-1.333 4-4-2.667-4-4-4zM12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
    </svg> الإدارة المالية
  </a>

  <a href="{{ route('recitations.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4h9M4 9h16M4 15h16"/>
    </svg> التسميع
  </a>

  <a href="{{ route('control_page') }}">الرئيسية</a>
</div>

<!-- المحتوى الرئيسي -->
<main>
  <h2>الخطط</h2>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>اسم الطالب</th>
          <th>المسار</th>
          <th>كمية الحفظ</th>
          <th>الهدف</th>
          <th>الأجزاء</th>
          <th>عرض التسميع</th>
        </tr>
      </thead>
      <tbody>
        @forelse($plans as $plan)
        <tr>
          <td>{{ $plan->name ?? 'غير معروف' }}</td>
          <td>{{ $plan->track }}</td>
          <td>{{ $plan->memorization }}</td>
          <td>{{ $plan->goal }}</td>
          <td>{{ $plan->juz }}</td>
          <td>
            <button class="btn btn-view" onclick="openStudentModal({{ $plan->id }}, '{{ addslashes($plan->name) }}')">عرض التسميع</button>
          </td>
        </tr>
        @empty
        <tr><td colspan="6">لا توجد خطط حتى الآن.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</main>

<!-- مودال التسميع -->
<div class="modal" id="studentModal">
  <div class="modal-content">
    <button class="close-btn-modal" onclick="closeStudentModal()">إغلاق</button>
    <h2 id="studentModalTitle">تسميع</h2>

    <!-- ✅ الفلاتر -->
    <div class="filters">
      <select id="filterRange">
        <option value="all">إظهار الكل</option>
        <option value="week">هذا الأسبوع</option>
        <option value="month">هذا الشهر</option>
        <option value="quarter">آخر 3 أشهر</option>
      </select>
      <input type="date" id="fromDate">
      <input type="date" id="toDate">
      <button class="btn btn-apply" onclick="applyFilters()">تطبيق</button>
      <button class="btn btn-reset" onclick="resetFilters()">إعادة تعيين</button>
    </div>

    <div class="table-wrapper">
      <table id="studentTable">
        <thead>
          <tr>
            <th>التاريخ</th>
            <th>التسميع</th>
            <th>التقييم</th>
            <th>الحالة</th>
          </tr>
        </thead>
        <tbody>
          <!-- سيتم ملؤها ديناميكياً -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
/* --- وظائف القائمة --- */
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const menuBtn = document.querySelector(".menu-btn");
  sidebar.classList.toggle("open");
  menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "block";
}

/* --- وظائف مودال الطالب --- */
let currentStudentId = null;
let allRecitations = [];

function openStudentModal(studentId, studentName){
  currentStudentId = studentId;
  document.getElementById('studentModal').style.display = 'flex';
  document.getElementById('studentModalTitle').innerText = 'تسميع : ' + studentName;
  loadStudentRecitations();
}

function closeStudentModal(){
  document.getElementById('studentModal').style.display = 'none';
  currentStudentId = null;
  allRecitations = [];
  document.querySelector('#studentTable tbody').innerHTML = '';
}

function loadStudentRecitations(){
  if(!currentStudentId) return;
  fetch(`/student-recitations/${currentStudentId}`)
    .then(res => res.json())
    .then(data => {
      allRecitations = data;
      applyFilters();
    });
}

/* --- فلترة التسميع --- */
function applyFilters(){
  let filtered = [...allRecitations];
  const range = document.getElementById('filterRange').value;
  const fromDate = document.getElementById('fromDate').value;
  const toDate = document.getElementById('toDate').value;

  const today = new Date();
  let startDate = null;

  if(range === 'week'){
    const day = today.getDay();
    startDate = new Date(today);
    startDate.setDate(today.getDate() - day);
  } else if(range === 'month'){
    startDate = new Date(today.getFullYear(), today.getMonth(), 1);
  } else if(range === 'quarter'){
    startDate = new Date(today);
    startDate.setMonth(today.getMonth() - 3);
  }

  if(startDate){
    filtered = filtered.filter(r => new Date(r.date) >= startDate);
  }
  if(fromDate){
    filtered = filtered.filter(r => new Date(r.date) >= new Date(fromDate));
  }
  if(toDate){
    filtered = filtered.filter(r => new Date(r.date) <= new Date(toDate));
  }

  renderTable(filtered);
}

function resetFilters(){
  document.getElementById('filterRange').value = 'all';
  document.getElementById('fromDate').value = '';
  document.getElementById('toDate').value = '';
  renderTable(allRecitations);
}

function renderTable(data){
  const tbody = document.querySelector('#studentTable tbody');
  tbody.innerHTML = '';
  if(data.length === 0){
    tbody.innerHTML = `<tr><td colspan="4">لا توجد تسميع ضمن هذه الفلترة</td></tr>`;
    return;
  }
  data.forEach(recitation => {
    tbody.innerHTML += `
      <tr>
        <td>${recitation.date}</td>
        <td>${recitation.notes ?? ''}</td>
        <td>${recitation.subject ?? ''}</td>
        <td>
          ${recitation.condition === 'no' ? 'لم يسمع' : (recitation.condition === 'done' ? 'تم' : '')}
        </td>
      </tr>
    `;
  });
}
</script>
</body>
</html>
