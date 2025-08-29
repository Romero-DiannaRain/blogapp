<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Campus Blog Login</title>
  <style>
    html { height: 100%; background: linear-gradient(135deg, #ffffff, #800000); }
    body { margin:0; padding:0; height:100vh; display:flex; justify-content:center; align-items:center; font-family: Arial, sans-serif; }
    .wrapper { display: flex; flex-direction: column; align-items: center; width: 100%; }
    h1 { font-size: 85px; font-weight: bold; color: #8B0000; text-shadow: 2px 2px 2px #aaa; margin: 0 0 40px 0; }
    .login-container { background-color: rgba(237,237,237,0.51); padding: 60px 50px; border-radius: 25px; width: 600px; box-shadow: 0px 6px 15px rgba(0,0,0,0.15); }
    .login-container h2 { text-align:center; margin-top:0; margin-bottom:40px; font-size:22px; font-weight:bold; color:#333; display:flex; align-items:center; justify-content:center; gap:10px; }
    .form-group { margin-bottom: 20px; text-align: left; }
    .form-group label { display:block; margin-bottom: 8px; }
    .input-wrap { position: relative; }
    .input-wrap .input-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; fill: #666; pointer-events: none; transition: fill 0.3s ease; }
    .login-container input[type="text"], .login-container input[type="password"] {
      width:100%; padding:12px 12px 12px 45px; border:none; border-radius:25px; font-size:15px;
      background-color: rgba(255,255,255,0.72); transition: box-shadow 0.2s, border 0.2s, background 0.2s; height: 44px; box-sizing: border-box;
    }
    .login-container input[type="text"]:focus, .login-container input[type="password"]:focus {
      outline: none; box-shadow: 0 0 0 2px #4a63c755; border: 1.5px solid #4a63c7; background: #fff;
    }
    .input-wrap:focus-within .input-icon { fill: #4a63c7; }
    .login-container button {
      width:50%; padding:14px; border:none; border-radius:25px;
      background-color:#4a63c7; color:white; font-size:16px; font-weight:bold;
      cursor:pointer; box-shadow: 2px 3px 5px rgba(0,0,0,0.2); margin-top:50px;
      display:block; margin-left:auto; margin-right:auto; transition: background 0.3s ease;
    }
    .login-container button:hover { background-color:rgb(59,82,176); }
    .error-msg { color: red; text-align:center; margin-bottom:15px; }

    .back-btn {
      display: block;
      text-align: center;
      margin-top: 20px;
      font-size: 16px;
      color: #000;
      text-decoration: underline;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <h1>Welcome to Campus Blog</h1>
    <div class="login-container">
      <h2>
        <img src="https://www.transparentpng.com/download/user/gray-user-profile-icon-png-fP8Q1P.png" alt="Student Icon" style="width:32px;height:32px;">
        Student Login
      </h2>

      {{-- Show error messages --}}
      @if($errors->any())
        <div class="error-msg">{{ $errors->first('login') }}</div>
      @endif
      @if(session('error'))
        <div class="error-msg">{{ session('error') }}</div>
      @endif

      <form method="POST" action="{{ route('student.login.submit') }}">
        @csrf
        <input type="hidden" name="role" value="student">

        {{-- Email --}}
        <div class="form-group">
          <label for="studentEmail">Email</label>
          <div class="input-wrap">
            <svg class="input-icon" viewBox="0 0 20 20" aria-hidden="true">
              <path d="M2.94 5.5A2.5 2.5 0 0 1 5.5 3h9a2.5 2.5 0 0 1 2.56 2.5v9A2.5 2.5 0 0 1 14.5 17h-9a2.5 2.5 0 0 1-2.56-2.5v-9zm2.56-.5a1 1 0 0 0-1 1v.217l6 3.6 6-3.6V6a1 1 0 0 0-1-1h-10zm11 2.383-5.47 3.282a1 1 0 0 1-1.06 0L4 7.383V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V7.383z"/>
            </svg>
            <input type="text" id="studentEmail" name="email" placeholder="Enter Email" required>
          </div>
        </div>

        {{-- Password --}}
        <div class="form-group">
          <label for="studentPassword">Password</label>
          <div class="input-wrap">
            <svg class="input-icon" viewBox="0 0 20 20" aria-hidden="true">
              <path d="M10 2a5 5 0 0 0-5 5v3H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-1V7a5 5 0 0 0-5-5zm-3 5a3 3 0 1 1 6 0v3H7V7zm-3 5h12v6H4v-6zm6 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
            </svg>
            <input type="password" id="studentPassword" name="password" placeholder="Enter Password" required>
          </div>
        </div>

        <button type="submit">Login</button>
        
        <span class="back-btn" onclick="goBack()">Back</span>
      </form>
    </div>
  </div>

  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</body>
</html>