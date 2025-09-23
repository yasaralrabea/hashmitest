<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إدارة الحركات المالية</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    *{margin:0;padding:0;box-sizing:border-box;}
    body{font-family:"Cairo",sans-serif;background:#f3f6fb;color:#333;line-height:1.6;}

    /* زر القائمة */
    .menu-btn {
      flex-shrink: 0; position: fixed; top: 20px; right: 20px;
      background: #253b5c; color: #fff; border: none; border-radius: 12px;
      padding: 10px 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.25);
      cursor: pointer; transition: background 0.3s, transform 0.2s; z-index: 1100;
    }
    .menu-btn svg { width: 26px; height: 26px; }
    .menu-btn:hover { background: #2563eb; transform: translateY(-1px); }

    /* الهيدر */
    
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
    header .actions button:hover { background: rgba(255,255,255,0.3); }
    header .actions svg { width: 24px; height: 24px; }

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
    main{padding:40px;max-width:1200px;margin:auto;}
    h2{margin-bottom:20px;color:#253b5c;}
    .filter-form{display:flex;gap:12px;align-items:center;margin-bottom:30px;flex-wrap:wrap;}
    .filter-form label{font-weight:600;color:#374151;}
    .form-control{padding:10px;border-radius:8px;border:1px solid #ccc;font-size:15px;}

    .btn{background:#2563eb;color:#fff;border:none;padding:10px 20px;border-radius:10px;font-weight:600;font-size:15px;cursor:pointer;transition:.3s;}
    .btn:hover{background:#1E40AF;}
    .btn-secondary{background:#6b7280;}
    .btn-secondary:hover{background:#4b5563;}

    .table-wrapper{background:#fff;border-radius:16px;box-shadow:0 6px 18px rgba(0,0,0,.08);overflow:hidden;padding:20px;}
    table{width:100%;border-collapse:separate;border-spacing:0 10px;}
    th{background:#f1f5f9;color:#253b5c;font-weight:700;padding:14px;font-size:15px;}
    td{background:#fff;padding:14px;text-align:center;border-radius:10px;box-shadow:0 2px 6px rgba(0,0,0,.05);font-size:15px;}
    tbody tr{transition:.3s;}
    tbody tr:hover td{background:#f9fafc;}

    /* مودال */
    .modal {
      display:none; position:fixed; inset:0; background:rgba(0,0,0,.5);
      justify-content:center; align-items:center; z-index:1200;
    }
    .modal-content {
      background:#fff; padding:28px; border-radius:16px; width:400px; max-height:90vh;
      overflow:auto; box-shadow:0 8px 22px rgba(0,0,0,.25); animation:fadeIn .3s;
      display:flex; flex-direction:column; gap:15px;
    }
    .modal-content h3{color:#253b5c;margin-bottom:10px;text-align:center;}
    .modal-content label{font-weight:600; display:block; margin-bottom:5px;}
    .modal-content input, .modal-content select { width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; font-size:15px; }
    .modal-content button { padding:10px 15px; border-radius:10px; border:none; font-weight:600; cursor:pointer; font-size:15px; transition:.3s; }
    .modal-content .btn { background-color:#2563eb; color:#fff; }
    .modal-content .btn:hover { background-color:#1E40AF; }
    .modal-content .close-btn { background-color:#e5e7eb; color:#111; }
    .modal-content .close-btn:hover { background-color:#d1d5db; }
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
 <header>
    <h1>   الإدارة المالية</h1>
    <div class="actions">
        <a href="{{ route('lighting.index') }}" title="إضاءات">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 18h6m-3-16a7 7 0 00-7 7c0 3.866 3.134 7 7 7s7-3.134 7-7a7 7 0 00-7-7z"/>
  </svg>
</a>
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
  <!-- عرض الميزانية -->
 <div style="background:#fff; padding:20px; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,.08); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; margin-bottom:30px;">
  <div style="font-size:18px; font-weight:600; color:#253b5c; display:flex; flex-direction:column; gap:8px;">
    <div>الميزانية الحالية: {{ number_format($budget->budget, 2) }}</div>
    <div>إجمالي الإيرادات: {{ number_format($income, 2) }}</div>
    <div>إجمالي المصروفات: {{ number_format($expense, 2) }}</div>
  </div>
  <button class="btn" onclick="openBudgetModal()" style="height:45px;">تعديل الميزانية</button>
</div>


  <!-- فلتر الحركات -->
  <form method="GET" action="{{ route('fins.index') }}" class="filter-form">
    <label>نوع الحركة:</label>
    <select name="type" class="form-control">
      <option value="">الكل</option>
      <option value="income" {{ request('type')=='income'?'selected':'' }}>وارد</option>
      <option value="expense" {{ request('type')=='expense'?'selected':'' }}>صادر</option>
    </select>
    <label>من تاريخ:</label>
    <input type="date" name="from" class="form-control" value="{{ request('from') }}">
    <label>إلى تاريخ:</label>
    <input type="date" name="to" class="form-control" value="{{ request('to') }}">
    <button type="submit" class="btn">فلتر</button>
    <a href="{{ route('fins.index') }}" class="btn btn-secondary">إظهار الكل</a>
  </form>

  <!-- جدول الحركات المالية -->
  <h2>الحركات المالية</h2>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>نوع الحركة</th>
          <th>السبب</th>
          <th>الجهة</th>
          <th>المبلغ</th>
          <th>التاريخ</th>
          <th>الإجراء</th>
        </tr>
      </thead>
      <tbody>
        @forelse($fins as $transaction)
        <tr>
          <td>{{ $transaction->type=='income'?'وارد':'صادر' }}</td>
          <td>{{ $transaction->reason }}</td>
          <td>{{ $transaction->party }}</td>
          <td>{{ number_format($transaction->amount,2) }}</td>
          <td>{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}</td>
          <td style="display:flex;gap:5px;justify-content:center;">
            <form method="POST" action="{{ route('financial.destroy', $transaction->id) }}">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-secondary">حذف</button>
            </form>
            <button class="btn" onclick="openEditModal({{ $transaction->id }})">تعديل</button>

            <!-- مودال تعديل الحركة -->
            <div class="modal" id="editTransactionModal{{ $transaction->id }}">
              <div class="modal-content">
                <form method="POST" action="{{ route('financial.update', $transaction->id) }}">
                  @csrf @method('PUT')
                  <h3>تعديل الحركة</h3>
                  <label>نوع الحركة:</label>
                  <select name="type" class="form-control" required>
                    <option value="income" {{ $transaction->type=='income'?'selected':'' }}>وارد</option>
                    <option value="expense" {{ $transaction->type=='expense'?'selected':'' }}>صادر</option>
                  </select>
                  <label>السبب:</label>
                  <input type="text" name="reason" class="form-control" value="{{ $transaction->reason }}" required>
                  <label>الجهة:</label>
                  <input type="text" name="party" class="form-control" value="{{ $transaction->party }}" required>
                  <label>المبلغ:</label>
                  <input type="number" name="amount" class="form-control" value="{{ $transaction->amount }}" required step="0.01">
                  <label>التاريخ:</label>
                  <input type="date" name="date" class="form-control" value="{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}" required>
                  <button type="submit" class="btn">حفظ التغييرات</button>
                  <button type="button" class="btn close-btn" onclick="closeEditModal({{ $transaction->id }})">إلغاء</button>
                </form>
              </div>
            </div>

          </td>
        </tr>
        @empty
          <tr><td colspan="6">لا توجد حركات مالية</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <br>
  <button class="btn" onclick="openModal()">➕ إضافة حركة جديدة</button>
</main>

<!-- مودال إضافة حركة جديدة -->
<div class="modal" id="transactionModal">
  <div class="modal-content">
    <h3>إضافة حركة جديدة</h3>
    <form method="POST" action="{{ route('financial.store') }}">
      @csrf
      <label>نوع الحركة:</label>
      <select name="type" class="form-control" required>
        <option value="income">وارد</option>
        <option value="expense">صادر</option>
      </select>
      <label>السبب:</label>
      <input type="text" name="reason" class="form-control" required>
      <label>الجهة:</label>
      <input type="text" name="party" class="form-control" required>
      <label>المبلغ:</label>
      <input type="number" name="amount" class="form-control" required step="0.01">
      <label>التاريخ:</label>
      <input type="date" name="date" class="form-control" required>
      <button type="submit" class="btn">حفظ</button>
      <button type="button" class="btn close-btn" onclick="closeModal()">إلغاء</button>
    </form>
  </div>
</div>

<!-- مودال تعديل الميزانية -->
<div class="modal" id="budgetModal">
  <div class="modal-content">
    <h3>تعديل الميزانية</h3>
    <form method="POST" action="{{ route('budget.update') }}">
      @csrf @method('PUT')
      <label>المبلغ الجديد للميزانية:</label>
      <input type="number" name="budget" class="form-control" value="{{ $budget->budget }}" required step="0.01">
      <button type="submit" class="btn">حفظ</button>
      <button type="button" class="btn close-btn" onclick="closeBudgetModal()">إلغاء</button>
    </form>
  </div>
</div>

<script>
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const menuBtn = document.getElementById("menuBtn");
  sidebar.classList.toggle("open");
  menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "block";
}

// مودال إضافة حركة
function openModal(){document.getElementById("transactionModal").style.display="flex";}
function closeModal(){document.getElementById("transactionModal").style.display="none";}

// مودال تعديل حركة
function openEditModal(id){document.getElementById("editTransactionModal"+id).style.display="flex";}
function closeEditModal(id){document.getElementById("editTransactionModal"+id).style.display="none";}

// مودال تعديل الميزانية
function openBudgetModal(){document.getElementById("budgetModal").style.display="flex";}
function closeBudgetModal(){document.getElementById("budgetModal").style.display="none";}
</script>

</body>
</html>
