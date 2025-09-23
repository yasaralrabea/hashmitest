<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تفاصيل الطالب</title>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: "Cairo", sans-serif; background: #f9fafb; margin: 0; padding: 40px; }
    .card {
      background: #fff; border-radius: 14px; padding: 28px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1); max-width: 600px; margin: auto;
    }
    h2 { margin-top: 0; color: #2759a4ff; }
    p { margin: 8px 0; font-size: 16px; }

    .actions { margin-top: 20px; display: flex; gap: 10px; flex-wrap: wrap; }
    .btn {
      padding: 10px 16px; border: none; border-radius: 8px;
      cursor: pointer; font-weight: 600; font-size: 14px;
      transition: 0.2s; color: #fff; text-decoration: none;
    }
    .btn-edit { background: #2563eb; }
    .btn-edit:hover { background: #1d4ed8; }
    .btn-delete { background: #dc2626; }
    .btn-delete:hover { background: #b91c1c; }

    /* Modal */
    .modal {
      display: none; position: fixed; z-index: 1000; left: 0; top: 0;
      width: 100%; height: 100%; background: rgba(0,0,0,0.5);
      justify-content: center; align-items: center;
    }
    .modal-content {
      background: #fff; padding: 20px; border-radius: 12px;
      width: 90%; max-width: 500px;
    }
    .modal-content h3 { margin-top: 0; color: #2759a4ff; }
    .modal-content label { display: block; margin-top: 10px; font-weight: 600; }
    .modal-content input {
      width: 100%; padding: 8px; margin-top: 4px;
      border: 1px solid #ddd; border-radius: 6px;
    }
    .modal-content button {
      margin-top: 16px; padding: 10px 14px;
      border: none; border-radius: 8px; background: #2563eb;
      color: #fff; font-weight: 600; cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>تفاصيل الطالب: {{ $student->name }}</h2>
    <p><strong>الاسم:</strong> {{ $student->name }}</p>
    <p><strong>العمر:</strong> {{ $student->age }}</p>
    <p><strong>المسار:</strong> {{ $student->track }}</p>
    <p><strong>كمية الحفظ:</strong> {{ $student->memorization }}</p>
    <p><strong>الأجزاء :</strong> {{ $student->juz }}</p>

    <p><strong>المستوى:</strong> {{ $student->level }}</p>
    <p><strong>الهدف:</strong> {{ $student->goal }}</p>
    <p><strong>رقم الهاتف:</strong> {{ $student->phone }}</p>

    <div class="actions">
      <button class="btn btn-edit" onclick="openModal()">تعديل</button>

      <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-delete">حذف</button>
      </form>
    </div>
  </div>

  <!-- Modal تعديل بيانات الطالب -->
  <div class="modal" id="editModal">
    <div class="modal-content">
      <h3>تعديل بيانات الطالب</h3>
      <form method="POST" action="{{ route('students.update', $student->id) }}">
        @csrf
        @method('PUT')

        <label>الاسم:</label>
        <input type="text" name="name" value="{{ $student->name }}" required>

        <label>العمر:</label>
        <input type="number" name="age" value="{{ $student->age }}" required>

        <label>المسار:</label>
        <input type="text" name="track" value="{{ $student->track }}" required>

        <label>كمية الحفظ:</label>
        <input type="number" name="memorization" value="{{ $student->memorization }}" required>
        
        <label>الأجزاء :</label>
        <input type="text" name="juz" value="{{ $student->juz }}" required>

        <label>المستوى:</label>
        <input type="text" name="level" value="{{ $student->level }}" required>

        <label>الهدف:</label>
        <input type="text" name="goal" value="{{ $student->goal }}" required>

        <label>رقم الهاتف:</label>
        <input type="text" name="phone" value="{{ $student->phone }}" required>

        <button type="submit">حفظ التغييرات</button>
      </form>
    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById('editModal').style.display = 'flex';
    }
    window.onclick = function(e) {
      if (e.target == document.getElementById('editModal')) {
        document.getElementById('editModal').style.display = 'none';
      }
    }
  </script>
</body>
</html>
