<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>التسميع -  </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<style>
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

/* الهيدر */
header {
  background: linear-gradient(90deg, #253b5cff, #253b5cff);
  color:#fff; display:flex; justify-content:center; align-items:center;
  padding:20px 30px; box-shadow:0 4px 20px rgba(0,0,0,.15);
  position:sticky; top:0; z-index:900; text-align:center;
}
header h1 { font-size:26px; font-weight:700; }
header .actions {
  position:absolute; left:30px; display:flex; gap:15px; align-items:center;
}
header .actions a, header .actions button {
  background: rgba(255,255,255,0.15); border:none; color:#fff; cursor:pointer;
  display:flex; align-items:center; justify-content:center;
  padding:8px 10px; border-radius:8px; transition:all 0.3s ease;
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
/* المحتوى */
main { padding:35px; max-width:1200px; margin:auto; }

/* فورم الفلترة */
.filter-form {
  display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; align-items:center;
}
.filter-form label { font-weight:600; color:#374151; }
.filter-form input, .filter-form select { padding:10px; border-radius:8px; border:1px solid #ccc; font-size:14px; }

/* أزرار */
.btn { padding:8px 14px; border-radius:10px; border:none; cursor:pointer; color:#fff; font-size:14px; transition:.3s; }
.btn-add {       background: #253b5cff;
; margin-bottom:18px; }
.btn-add:hover { background:#2563EB; }
.btn-edit { background:#10B981; }
.btn-edit:hover { background:#059669; }
.btn-del { background:#EF4444; }
.btn-del:hover { background:#DC2626; }
.btn-save {       background: #253b5cff;
; }
.btn-save:hover { background:#2563EB; }

/* الجدول */
.table-wrapper table {
  width:100%;
  border-collapse: collapse;
  table-layout: fixed;
}
.table-wrapper th, .table-wrapper td {
  padding:18px 12px; text-align:center; font-size:16px; vertical-align: middle; word-wrap: break-word;
}
.table-wrapper th {       background: #253b5cff;
; color:#fff; font-weight:700; }
.table-wrapper td { background:#fff; border:none; }

/* مودال */
.modal {
  display:none; position:fixed; inset:0; background:rgba(0,0,0,.55);
  justify-content:center; align-items:flex-start; padding-top:60px; z-index:1200;
}
.modal-content {
  background:#fff; padding:28px; border-radius:16px; width:480px;
  max-height:90vh; overflow-y:auto; animation:fadeIn .3s;
  box-shadow:0 10px 28px rgba(0,0,0,.2);
}
.modal-content h2 { margin-bottom:22px; color:#253b5cff; font-size:20px; }
.modal-content label { display:block; margin-bottom:6px; font-weight:600; color:#374151; }
.modal-content input, .modal-content select, .modal-content textarea { margin-bottom:14px; width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; }
.close-btn-modal { background:#e5e7eb; color:#111; padding:10px 14px; border-radius:10px; cursor:pointer; border:none; font-size:14px; }
.close-btn-modal:hover { background:#d1d5db; }

@keyframes fadeIn { from{opacity:0; transform:translateY(-15px);} to{opacity:1; transform:translateY(0);} }
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
  <h1> جدول الحفظ</h1>
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

<main>
  <button class="btn btn-add" onclick="openModal()">إضافة تسميع جديد</button>

  <!-- فورم الفلترة مع فلتر الخطة -->
  <form method="GET" class="filter-form">
    <label>اسم الطالب:</label>
    <input type="text" name="student_name" value="{{ request('student_name') }}" placeholder="بحث باسم الطالب">

    <label>الخطة:</label>
    <select name="plan_filter">
      <option value="all" {{ request('plan_filter') == 'all' ? 'selected' : '' }}>إظهار الكل</option>
      <option value="weekly" {{ request('plan_filter') == 'weekly' ? 'selected' : '' }}>أسبوعية</option>
      <option value="monthly" {{ request('plan_filter') == 'monthly' ? 'selected' : '' }}>شهرية</option>
      <option value="quarterly" {{ request('plan_filter') == 'quarterly' ? 'selected' : '' }}>فصلية</option>
    </select>

    <button type="submit" class="btn btn-save">فلترة</button>
  </form>

  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>اسم الطالب</th>
          <th>التاريخ</th>
          <th>التسميع</th>
          <th>الحالة</th>
          <th>التقييم</th>
          <th>إجراءات</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recitations as $recitation)
        <tr>
          <td>{{ $recitation->student->name ?? 'غير معروف' }}</td>
          <td>{{ $recitation->date }}</td>
          <td>{{ $recitation->notes }}</td>
          <td>
            {{ $recitation->condition == 'no' ? 'لم يسمع' : ($recitation->condition == 'done' ? 'تم' : $recitation->condition) }}
          </td>
          <td>{{ $recitation->subject }}</td>
          <td style="display:flex; gap:6px; justify-content:center;">
            <form action="{{ route('recitations.done', $recitation->id) }}" method="POST" onsubmit="return confirm('هل تريد تأكيد إتمام التسميع؟')">
              @csrf
              <button type="submit" class="btn btn-save">تم</button>
            </form>

            <button class="btn btn-edit" onclick="openEditModal({{ $recitation->id }}, '{{ $recitation->student_id }}', '{{ $recitation->date }}', '{{ addslashes($recitation->notes) }}', '{{ addslashes($recitation->subject) }}')">تعديل</button>

            <form action="{{ route('recitations.destroy', $recitation->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-del">حذف</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6">لا يوجد تسميع حتى الآن.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</main>

<div class="modal" id="recitationModal">
  <div class="modal-content">
    <h2 id="modalTitle">إضافة تسميع إلى الخطة</h2>
    <form id="recitationForm" action="{{ route('recitations.store') }}" method="POST">
  @csrf
  <label>اسم الطالب</label>
  <select name="student_id" required>
    @foreach($students as $student)
      <option value="{{ $student->id }}">{{ $student->name }}</option>
    @endforeach
  </select>

  <label>التاريخ</label>
  <input type="date" name="date" required>

  <label>التسميع</label>
  <textarea name="notes" required></textarea>

  <label>التقييم</label>
  <input type="text" name="subject">

  <label>حالة التسميع</label>
  <select name="condition" required>
    <option value="no">لم يسمع</option>
    <option value="done">تم</option>
  </select>

  <button type="submit" class="btn btn-add" style="width:100%; margin-top:12px;">حفظ</button>
  <button type="button" class="close-btn-modal" onclick="closeModal()">إلغاء</button>
</form>

  </div>
</div>

<script>
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const menuBtn = document.querySelector(".menu-btn");
  sidebar.classList.toggle("open");
  menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "block";
}

// مودال
function openModal(){
  const modal = document.getElementById("recitationModal");
  const form = document.getElementById("recitationForm");
  modal.style.display="flex";
  document.getElementById("modalTitle").innerText="إضافة تسميع جديد";
  form.action="{{ route('recitations.store') }}";
  form.reset();
  const existingMethod = form.querySelector('input[name="_method"]');
  if(existingMethod) existingMethod.remove();
}

function openEditModal(id, student_id, date, notes, subject){
  const modal = document.getElementById("recitationModal");
  const form = document.getElementById("recitationForm");
  modal.style.display = "flex";
  document.getElementById("modalTitle").innerText = "تعديل التسميع";
  form.action = `/recitations/${id}`;
  const existingMethod = form.querySelector('input[name="_method"]');
  if(existingMethod) existingMethod.remove();
  const methodInput = document.createElement('input');
  methodInput.type = 'hidden';
  methodInput.name = '_method';
  methodInput.value = 'PUT';
  form.appendChild(methodInput);
  form.querySelector('select[name="student_id"]').value = student_id;
  form.querySelector('input[name="date"]').value = date;
  form.querySelector('textarea[name="notes"]').value = notes;
  form.querySelector('input[name="subject"]').value = subject;
}

function closeModal(){ document.getElementById("recitationModal").style.display="none"; }
</script>

</body>
</html>
