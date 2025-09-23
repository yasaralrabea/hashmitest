<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول -  </title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Cairo', sans-serif;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            /* ✅ الخلفية */
            background: url("{{ asset('ha.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        /* ✅ طبقة التظليل فوق الخلفية */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45); /* معتمة */
            backdrop-filter: blur(3px);       /* ضبابية */
            z-index: 0;
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.92);
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            text-align: center;
            backdrop-filter: blur(5px);
        }

        /* ✅ تكبير الشعار */
        .login-card img {
            max-width: 180px;
            margin-bottom: 25px;
        }

        .login-card h2 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #253b5cff;
        }

        form {
            text-align: right;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 18px;
            margin-bottom: 20px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            outline: none;
            font-size: 15px;
            background: #fefefe;
            color: #333;
            text-align: right;
            direction: rtl;
            box-sizing: border-box; /* ✅ يمنع الطلوع برة الكرت */
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #9ca3af;
            text-align: right;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #253b5cff;
            box-shadow: 0 0 6px rgba(59, 130, 246, 0.35);
        }

        .remember-me {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 25px;
            color: #555;
            font-size: 14px;
        }
        .remember-me input {
            margin-left: 8px;
            accent-color: #253b5cff;
            width: 18px;
            height: 18px;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(90deg, #253b5cff, #253b5cff);
            color: white;
            font-weight: bold;
            font-size: 16px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        }
        .login-button:hover {
            background: linear-gradient(90deg, #253b5cff, #253b5cff);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.35);
        }

        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
            color: #253b5cff;
            text-decoration: underline;
        }
        .forgot-password:hover { color: #253b5cff; }

        .error-message {
            color: #dc2626;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: right;
        }

        @media (max-width: 500px) {
            .login-card { padding: 30px 20px; }
            .login-card img { max-width: 140px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- ✅ شعار الحلقات -->
            <img src="{{ asset('hashmi.png') }}" alt="شعار الحلقات">

            <h2>تسجيل الدخول</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- البريد الإلكتروني -->
                <div>
                    <label for="email">البريد الإلكتروني</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="أدخل بريدك الإلكتروني">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- كلمة المرور -->
                <div>
                    <label for="password">كلمة المرور</label>
                    <input id="password" type="password" name="password" required placeholder="أدخل كلمة المرور">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- تذكرني -->
                <div class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>تذكرني</span>
                </div>

                <button type="submit" class="login-button">تسجيل الدخول</button>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">نسيت كلمة المرور؟</a>
                @endif
            </form>
        </div>
    </div>
</body>
</html>
