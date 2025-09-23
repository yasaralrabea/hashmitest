<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>إدارة الطلاب -  </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* =================== RESET & BODY =================== */
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:"Cairo",sans-serif;background:#f3f6fb;color:#333;line-height:1.6;}

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
/* =================== الهيدر =================== */
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
header .actions{
  position: absolute; left:30px; display:flex; gap:15px; align-items:center;
}
header .actions a, header .actions button{
  background: rgba(255,255,255,0.15);
  border:none;color:#fff;cursor:pointer;
  display:flex; align-items:center; justify-content:center;
  padding:8px 10px; border-radius:8px; transition:all 0.3s ease;
}
header .actions a:hover, header .actions button:hover { background: rgba(255,255,255,0.3); }
header .actions svg{width:22px;height:22px;}

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
/* =================== المحتوى =================== */
main{padding:40px;max-width:1200px;margin:auto;}
h2{margin-bottom:20px;color:#253b5cff;}

/* =================== أزرار =================== */
.btn{
  background:#2563eb;color:#fff;border:none;padding:12px 22px;
  font-size:15px;font-weight:600;border-radius:10px;cursor:pointer;
  transition: background 0.25s, transform 0.2s;
}
.btn:hover{ background:#1E40AF; transform:translateY(-2px);}
.btn-secondary{background:#e74c3c;}
.btn-secondary:hover{background:#c0392b;}

/* =================== الجدول =================== */
.table-wrapper{
  background:#fff;
  border-radius:16px;
  box-shadow:0 6px 18px rgba(0,0,0,.08);
  overflow:hidden;
  padding:20px;
}
table{
  width:100%;border-collapse:separate;border-spacing:0 10px;
}
th{
  background:#f1f5f9;
  color:#253b5cff;
  font-weight:700;
  padding:14px;
  font-size:15px;
}
td{
  background:#fff;
  padding:14px;
  text-align:center;
  border-radius:10px;
  box-shadow:0 2px 6px rgba(0,0,0,.05);
  font-size:15px;
}
tbody tr{transition:.3s;}
tbody tr:hover td{background:#f9fafc;}

/* =================== المودال =================== */
.modal{
  display:none;position:fixed;inset:0;
  background:rgba(0,0,0,.5);
  justify-content:center;align-items:center;z-index:1200;
}
.modal-content{
  background:#fff;padding:28px;border-radius:16px;width:600px;
  max-height:85vh;overflow:auto;
  box-shadow:0 8px 22px rgba(0,0,0,.25);
  animation:fadeIn .3s;
}
.modal-content h3{color:#253b5cff;margin-bottom:20px;text-align:center;}
.form-group { margin-bottom:15px; }
.form-group label {
  display:block; font-weight:600; margin-bottom:5px; color:#253b5cff;
}
.form-group input {
  width:100%; padding:10px 12px; border:1px solid #d1d5db;
  border-radius:8px; font-size:14px;
}
.form-group input:focus {
  border-color:#2563eb; outline:none; box-shadow:0 0 0 2px rgba(37,99,235,0.2);
}
.modal-content .btn { width:100%; margin-top:10px; }

/* حركة دخول */
@keyframes fadeIn{from{opacity:0;transform:translateY(-15px);}to{opacity:1;transform:translateY(0);}}
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
  <h1>   إدارة الطلاب</h1>
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
<h2>إدارة الطلاب</h2>

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>الاسم</th>
            <th>العمر</th>
            <th>المسار</th>
            <th>كمية الحفظ</th>
            <th>الإجراء</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->age }}</td>
            <td>{{ $student->track }}</td>
            <td>{{ $student->memorization }}</td>
            <td>
                <a href="{{ route('students.show', $student->id) }}" class="btn">زيارة الملف الشخصي</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<div style="text-align:center; margin:40px 0;">
    <button class="btn" onclick="openModal()">إضافة طالب جديد</button>
</div>

<!-- مودال إضافة طالب -->
<div class="modal" id="studentModal">
  <div class="modal-content">
    <h3>إضافة طالب</h3>
    <form id="studentForm" action="{{ route('students.store') }}" method="POST" onsubmit="return validateForm(event)">
      @csrf

      <div class="form-group">
        <label>الاسم</label>
        <input type="text" name="name" required>
      </div>

      <div class="form-group">
        <label>البريد الإلكتروني</label>
        <input type="email" name="email" id="email" required>
        <small id="emailError" style="color:red; display:none;">البريد الإلكتروني مستخدم مسبقاً</small>
      </div>

      <div class="form-group">
        <label>كلمة المرور (8 أحرف على الأقل)</label>
        <input type="password" name="password" id="password" required>
      </div>

      <div class="form-group">
        <label>تأكيد كلمة المرور</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
      </div>

      <div class="form-group">
        <label>العمر</label>
        <input type="number" name="age" required>
      </div>

      <div class="form-group">
        <label>كمية الحفظ</label>
        <input type="number" name="memorization" value="0" required>
      </div>

      <div class="form-group">
        <label>الأجزاء</label>
        <input type="text" name="juz" value="0" required>
      </div>

      <div class="form-group">
        <label>المستوى</label>
        <input type="text" name="level" required>
      </div>

      <div class="form-group">
        <label>المسار</label>
        <input type="text" name="track" required>
      </div>

      <div class="form-group">
        <label>الهدف</label>
        <input type="text" name="goal" required>
      </div>

      <div class="form-group">
        <label>رقم الهاتف</label>
        <input type="text" name="phone" required>
      </div>

      <button type="submit" class="btn">إضافة</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal()">إلغاء</button>
    </form>
  </div>
</div>

</main>

<script>
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const menuBtn = document.querySelector(".menu-btn");
  sidebar.classList.toggle("open");
  menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "block";
}
function openModal(){ document.getElementById("studentModal").style.display="flex"; }
function closeModal(){ document.getElementById("studentModal").style.display="none"; }

function validateForm(e) {
  e.preventDefault();
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const passwordConfirmation = document.getElementById('password_confirmation').value;
  const emailError = document.getElementById('emailError');

  if(password.length < 8){
    alert("كلمة المرور يجب أن تكون 8 أحرف على الأقل");
    return false;
  }

  if(password !== passwordConfirmation){
    alert("كلمة المرور وتأكيدها غير متطابقين");
    return false;
  }

  // مثال للتحقق من البريد الإلكتروني (استبدل بالتحقق الحقيقي من قاعدة البيانات)
  const existingEmails = ["test@example.com","student@example.com"];
  if(existingEmails.includes(email)){
    emailError.style.display = "block";
    return false;
  } else {
    emailError.style.display = "none";
  }

  e.target.submit();
}
</script>

</body>
</html>
