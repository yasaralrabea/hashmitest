<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>التقويم -  </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.css" rel="stylesheet">

<style>
* {margin:0;padding:0;box-sizing:border-box;}
body {font-family:"Cairo",sans-serif;background:#f4f6fa;color:#333;line-height:1.6;}

/* زر القائمة */
.menu-btn {
  flex-shrink: 0;
  position: fixed;
  top: 16px;
  right: 16px;
  background:#253b5c;
  color:#fff;
  border:none;
  border-radius:14px;
  padding:10px 12px;
  box-shadow:0 4px 14px rgba(0,0,0,.25);
  cursor:pointer;
  transition:.3s;
  z-index:1100;
}
.menu-btn svg{width:26px;height:26px;}
.menu-btn:hover{background:#2563eb;transform:translateY(-1px);}

/* الهيدر */
header {
  background:linear-gradient(90deg,#253b5c,#253b5c);
  color:#fff;
  display:flex;
  justify-content:center;
  align-items:center;
  padding:18px 22px;
  box-shadow:0 4px 18px rgba(0,0,0,.12);
  position:sticky;
  top:0;
  z-index:900;
  text-align:center;
}
header h1{font-size:22px;font-weight:700;}
header .actions {
  position:absolute;
  left:20px;
  display:flex;
  gap:12px;
  align-items:center;
}
header .actions a,header .actions button{
  background:rgba(255,255,255,.15);
  border:none;
  color:#fff;
  cursor:pointer;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:8px;
  border-radius:10px;
  transition:.3s;
}
header .actions a:hover,header .actions button:hover{background:rgba(255,255,255,.3);}
header .actions svg{width:22px;height:22px;}

/* القائمة الجانبية */
.sidebar {
  position:fixed;
  top:0;
  right:-280px;
  width:260px;
  height:100%;
  background:#253b5c;
  color:#fff;
  padding:25px 20px;
  box-shadow:-4px 0 20px rgba(0,0,0,.25);
  transition:right .4s ease;
  z-index:1000;
  border-radius:8px 0 0 8px;
  overflow-y:auto;
}
.sidebar.open{right:0;}
.sidebar-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
.sidebar h2{font-size:18px;font-weight:700;}
.sidebar .close-btn{background:none;border:none;color:#fff;font-size:26px;cursor:pointer;}
.sidebar .close-btn:hover{color:#ffec1d;}
.sidebar a{
  display:flex;align-items:center;gap:10px;
  background:#2d3748;
  border-radius:12px;
  padding:14px;
  margin-bottom:10px;
  text-decoration:none;
  color:#fff;
  transition:.3s;
}
.sidebar a:hover{background:#ffec1d;color:#111;}

/* المحتوى */
main{padding:24px;max-width:1100px;margin:auto;}

/* أزرار */
.btn-blue{
  background:#253b5c;
  color:#fff;
  border:none;
  border-radius:12px;
  cursor:pointer;
  transition:.3s;
  font-size:15px;
  font-weight:600;
  height:46px;
  padding:0 16px;
}
.btn-blue:hover{background:#2563eb;}
.btn-uniform{min-width:150px;}

/* الجدول */
.table-wrapper{overflow-x:auto;background:#fff;border-radius:12px;box-shadow:0 4px 14px rgba(0,0,0,.08);}
.table-wrapper table{width:100%;border-collapse:collapse;}
.table-wrapper th,.table-wrapper td{
  padding:18px 14px;
  text-align:center;
  font-size:15px;
  border-bottom:1px solid #e5e7eb;
}
.table-wrapper th{background:#253b5c;color:#fff;}
.table-wrapper td{background:#fff;}
.table-wrapper tr:last-child td{border-bottom:none;}

/* مودال */
.modal{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);justify-content:center;align-items:flex-start;padding-top:60px;z-index:1200;}
.modal-content{
  background:#fff;padding:26px;border-radius:16px;
  width:90%;max-width:700px;max-height:90vh;overflow-y:auto;
  animation:fadeIn .3s;box-shadow:0 10px 28px rgba(0,0,0,.2);
}
.modal-content h2{margin-bottom:20px;color:#253b5c;font-size:19px;text-align:center;}
.close-btn-modal{
  background:#f3f4f6;color:#111;padding:8px 14px;
  border-radius:10px;cursor:pointer;border:none;font-size:14px;
}
.close-btn-modal:hover{background:#e5e7eb;}

.btn{padding:9px 16px;border-radius:10px;border:none;cursor:pointer;color:#fff;font-size:14px;font-weight:600;transition:.3s;box-shadow:0 3px 8px rgba(0,0,0,.15);}
.btn-save{background:#253b5c;}.btn-save:hover{background:#2563EB;}
.btn-done{background:#10B981;}.btn-done:hover{background:#059669;}
.btn-del{background:#EF4444;}.btn-del:hover{background:#DC2626;}
.btn-add{background:#10B981;padding:12px 18px;font-size:15px;margin-top:6px;}.btn-add:hover{background:#059669;}

/* فورم */
.form-stack{display:flex;flex-direction:column;gap:14px;}
.form-group label{font-weight:600;margin-bottom:5px;display:block;color:#253b5c;}
.form-group input,.form-group textarea,.form-group select{
  width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:10px;
  font-size:14px;background:#fafafa;
}
.form-group textarea{min-height:80px;resize:vertical;}

/* FullCalendar */
.fc-event{white-space:normal;word-wrap:break-word;line-height:1.3;padding:3px;font-size:13px;border-radius:6px;}

@keyframes fadeIn{from{opacity:0;transform:translateY(-15px);}to{opacity:1;transform:translateY(0);}}

/* Responsive */
@media(max-width:768px){
  header h1{font-size:18px;}
  .btn-uniform{min-width:auto;width:100%;}
  main{padding:16px;}
  .table-wrapper table{font-size:13px;}
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
  <a href="{{ route('plans.index') }}">الخطط</a>
  <a href="{{ route('tasks.index') }}">الواجبات</a>
  <a href="{{ route('teachers.index') }}">المعلمين</a>
  <a href="{{ route('students.index') }}">الطلاب</a>
  <a href="{{ route('absences.index') }}">الغيابات</a>
  <a href="{{ route('calendars.index') }}">التقويم</a>
  <a href="{{ route('control_page') }}">الرئيسية</a>
  <a href="#">الرسائل</a>
</div>

<main>
 <!-- أزرار -->
<div style="display:flex;flex-wrap:wrap;gap:10px;justify-content:flex-end;margin-bottom:18px;">
  <button class="btn-blue btn-uniform" onclick="openModal()">➕ إضافة هدف</button>
  <button class="btn-blue btn-uniform" onclick="openCalendarModal()">📅 عرض التقويم</button>
</div>

<!-- الجدول -->
<div class="table-wrapper">
  <table>
    <thead>
      <tr>
        <th>التاريخ</th>
        <th>الهدف</th>
        <th>الحالة</th>
        <th>إجراءات</th>
      </tr>
    </thead>
    <tbody>
      @forelse($calendars as $calendar)
      <tr>
        <form action="{{ route('calendar.update',$calendar->id) }}" method="POST" class="contents">
          @csrf @method('PUT')
          <td><input type="date" name="date" value="{{ $calendar->date }}" class="table-input"></td>
          <td><textarea name="goal" class="table-textarea">{{ $calendar->goal }}</textarea></td>
          <td>
            <select name="condition" class="table-select">
              <option value="قيد التنفيذ" {{ $calendar->condition=='قيد التنفيذ'?'selected':'' }}>قيد التنفيذ</option>
              <option value="تم" {{ $calendar->condition=='تم'?'selected':'' }}>تم</option>
              <option value="ملغى" {{ $calendar->condition=='ملغى'?'selected':'' }}>ملغى</option>
            </select>
          </td>
          <td style="display:flex;gap:6px;justify-content:center;flex-wrap:wrap;">
            <button type="submit" class="btn btn-save">حفظ</button>
        </form>
        <form action="{{ route('calendar.done',$calendar->id) }}" method="POST">
          @csrf @method('PUT')
          <button type="submit" class="btn btn-done">تم</button>
        </form>
        <form action="{{ route('calendar.destroy',$calendar->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-del">🗑 حذف</button>
        </form>
          </td>
      </tr>
      @empty
      <tr><td colspan="4">لا يوجد أهداف مضافة بعد.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
</main>

<!-- مودال إضافة هدف -->
<div class="modal" id="calendarModal">
  <div class="modal-content">
    <h2>➕ إضافة هدف جديد</h2>
    <form action="{{ route('calendar.store') }}" method="POST" class="form-stack">
      @csrf
      <div class="form-group">
        <label>التاريخ</label>
        <input type="date" name="date" required>
      </div>
      <div class="form-group">
        <label>الهدف</label>
        <textarea name="goal" required></textarea>
      </div>
      <div class="form-group">
        <label>الحالة</label>
        <select name="condition" required>
          <option value="قيد التنفيذ">قيد التنفيذ</option>
          <option value="تم">تم</option>
          <option value="ملغى">ملغى</option>
        </select>
      </div>
      <div class="form-group">
        <label>متاح للطلاب</label>
        <select name="students" required>
          <option value="yes">نعم</option>
          <option value="no">لا</option>
        </select>
      </div>
      <button type="submit" class="btn btn-add">إضافة الهدف</button>
      <button type="button" class="close-btn-modal" onclick="closeModal()">إلغاء</button>
    </form>
  </div>
</div>

<!-- مودال التقويم -->
<div class="modal" id="calendarFullModal">
  <div class="modal-content">
    <h2>📅 التقويم</h2>
    <div id="calendarFull"></div>
    <button type="button" class="close-btn-modal" onclick="closeCalendarModal()">إغلاق</button>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>
<script>
function toggleSidebar(){
  const sidebar=document.getElementById("sidebar");
  const menuBtn=document.querySelector(".menu-btn");
  sidebar.classList.toggle("open");
  menuBtn.style.display=sidebar.classList.contains("open")?"none":"block";
}
function openModal(){document.getElementById("calendarModal").style.display="flex";}
function closeModal(){document.getElementById("calendarModal").style.display="none";}
function openCalendarModal(){
  document.getElementById('calendarFullModal').style.display='flex';
  var calendarEl=document.getElementById('calendarFull');
  calendarEl.innerHTML='';
  var events=[
    @foreach($calendars as $c)
    {
      title:"{{ $c->goal }} ({{ $c->condition }})",
      start:"{{ $c->date }}",
      color:"{{ $c->condition=='تم'?'#10B981':($c->condition=='ملغى'?'#EF4444':'#253b5c') }}"
    },
    @endforeach
  ];
  var calendar=new FullCalendar.Calendar(calendarEl,{
    initialView:'dayGridMonth',
    locale:'ar',
    height:'auto',
    eventDisplay:'block',
    headerToolbar:{left:'prev,next today',center:'title',right:'dayGridMonth,dayGridWeek,dayGridDay'},
    events:events
  });
  calendar.render();
}
function closeCalendarModal(){document.getElementById('calendarFullModal').style.display='none';}
</script>
</body>
</html>
