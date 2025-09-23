<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>إدارة المعلمين -  </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin:0; padding:0; }
body {
  font-family: "Cairo", "Tahoma", sans-serif;
  background: #f5f7fa;
  color: #333;
}
    /* الهيدر */
    header {
      background: linear-gradient(90deg, #253b5cff, #253b5cff);
      color: #fff;
      display: flex;
      justify-content: center; /* وسط */
      align-items: center;
      padding: 20px 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
      position: sticky;
      top: 0;
      z-index: 900;
      text-align: center;
    }
    header h1 {
      font-size: 26px;
      font-weight: 700;
    }
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
    header .actions a:hover, header .actions button:hover {
      background: rgba(255,255,255,0.3);
    }
    header .actions svg {
      width: 22px;
      height: 22px;
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

/* محتوى الصفحة */
main {
  padding: 30px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 25px;
}

/* بطاقة إضافة معلم جديد */
.add-card {
  background: #253b5cff;
  color: #fff;
  border-radius: 20px;
  padding: 30px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  text-align: center;
  transition: transform 0.3s, box-shadow 0.3s;
}
.add-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.2);
}
.add-card svg { width: 50px; height: 50px; margin-bottom: 12px; }

/* بطاقات المعلمين */
.teacher-card {
  background: #fff;
  border-radius: 20px;
  padding: 25px;
  text-align: center;
  box-shadow: 0 8px 25px rgba(0,0,0,0.12);
  cursor: pointer;
  transition: transform 0.35s, box-shadow 0.35s;
  display: block;
  text-decoration: none;
  color: inherit;
}
.teacher-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.18);
}
.teacher-card svg {
  width: 50px;
  height: 50px;
  color: #253b5cff;
  margin-bottom: 15px;
}
.teacher-card span {
  display: block;
  font-size: 17px;
  font-weight: 600;
  color: #253b5cff;
  margin-bottom: 6px;
}
.teacher-card small {
  display: block;
  font-size: 14px;
  color: #555;
  margin-bottom: 6px;
}

/* المودال */
.modal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.5);
  justify-content: center;
  align-items: flex-start;
  overflow-y: auto;
  padding-top: 40px;
  z-index: 1200;
}
.modal-content {
  background: #fff;
  padding: 28px;
  border-radius: 14px;
  width: 420px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 6px 20px rgba(0,0,0,0.25);
  animation: fadeIn 0.3s ease;
}
.modal-content h2 { margin-bottom: 20px; color: #253b5cff; }
.modal-content label { display: block; margin-bottom: 6px; font-weight: 600; color: #374151; }
.modal-content input {
  width: 100%;
  padding: 10px;
  margin-bottom: 14px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
}
.close-btn-modal {
  background: #e5e7eb;
  color: #111;
  margin-top: 8px;
}
.close-btn-modal:hover { background: #d1d5db; }
/* CSS */
.btn {
    width: 100%;
    padding: 12px 0;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-top: 10px;
}

.btn-primary {
    background: linear-gradient(90deg, #253b5cff, #253b5cff);
    color: #fff;
}

.btn-primary:hover {
    background: linear-gradient(90deg, #2563eb, #1e40af);
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.2);
}

.btn-secondary {
    background: #e5e7eb;
    color: #111;
}

.btn-secondary:hover {
    background: #d1d5db;
    transform: translateY(-2px);
}


@keyframes fadeIn { from {opacity:0; transform:translateY(-15px);} to {opacity:1; transform:translateY(0);} }
</style>
</head>
<body>
<script>
  @if(session('success'))
    alert("{{ session('success') }}");
  @endif

  @if(session('error'))
    alert("{{ session('error') }}");
  @endif
</script>

<!-- زر القائمة -->
  <button class="menu-btn" id="menuBtn" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
  </button>


<header>
    <h1>   المعلمين</h1>
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

<!-- محتوى الصفحة -->
<main>
  <!-- بطاقة إضافة معلم -->
  <div class="add-card" onclick="openModal()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
    </svg>
    <span>إضافة معلم جديد</span>
  </div>

  <!-- بطاقات المعلمين -->
  @foreach($teachers as $teacher)
    <a href="{{ route('teachers.show', $teacher->id) }}" class="teacher-card">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
           viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
           d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      <span>{{ $teacher->name }}</span>
      <small>{{ $teacher->position }}</small>
      <small>{{ $teacher->phone }}</small>
    </a>
  @endforeach
</main>

<!-- مودال الإضافة -->
<div class="modal" id="teacherModal">
  <div class="modal-content">
    <h2>إضافة معلم</h2>
    <form action="{{ route('teachers.store') }}" method="POST">
      @csrf
      <label>الاسم</label>
      <input type="text" name="name" required>
      <label>البريد الإلكتروني</label>
      <input type="email" name="email" required>
      <label>كلمة المرور</label>
      <input type="password" name="password" required>
      <label>تأكيد كلمة المرور</label>
      <input type="password" name="password_confirmation" required>
      <label>رقم الهاتف</label>
      <input type="text" name="phone" required>
      <label>الوظيفة</label>
      <input type="text" name="position" required>
      <label>المؤهل</label>
      <input type="text" name="qualification" required>
      <label>الراتب</label>
      <input type="text" name="salary" required>
      <button type="submit" class="btn btn-primary">إضافة</button>
<button type="button" class="btn btn-secondary" onclick="closeModal()">إلغاء</button>>
    </form>
  </div>
</div>
<script>
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const menuBtn = document.querySelector(".menu-btn");

  sidebar.classList.toggle("open");

  // إخفاء زر القائمة عند فتح الـ sidebar وإظهاره عند الإغلاق
  if (sidebar.classList.contains("open")) {
    menuBtn.style.display = "none";
  } else {
    menuBtn.style.display = "block";
  }
}

function openModal() { document.getElementById("teacherModal").style.display = "flex"; }
function closeModal() { document.getElementById("teacherModal").style.display = "none"; }
</script>


</body>
</html>
