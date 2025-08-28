<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Campus Blog Faculty Login</title>
  <style>
    html { height: 100%; background: linear-gradient(135deg, #ffffff, #800000); }
    body { margin:0; padding:0; height:100vh; display:flex; justify-content:center; align-items:center; font-family: Arial, sans-serif; }
    .wrapper { display: flex; flex-direction: column; align-items: center; width: 100%; }
    h1 { font-size: 64px; font-weight: bold; color: #8B0000; text-shadow: 2px 2px 2px #aaa; margin: 0 0 30px 0; }
    .login-container { background-color: rgba(237,237,237,0.51); padding: 50px 40px; border-radius: 20px; width: 560px; box-shadow: 0px 6px 15px rgba(0,0,0,0.15); }
    .login-container h2 { text-align:center; margin-top:0; margin-bottom:30px; font-size:22px; font-weight:bold; color:#333; display:flex; align-items:center; justify-content:center; gap:10px; }
    .form-group { margin-bottom: 18px; text-align: left; }
    .login-container input[type="text"], .login-container input[type="password"] {
      width:100%; padding:12px; border:none; border-radius:25px; font-size:15px;
      background-color: rgba(255,255,255,0.72); height: 44px; box-sizing: border-box;
    }
    .login-container button {
      width:50%; padding:14px; border:none; border-radius:25px;
      background-color:#4a63c7; color:white; font-size:16px; font-weight:bold;
      cursor:pointer; box-shadow: 2px 3px 5px rgba(0,0,0,0.2); margin-top:40px;
      display:block; margin-left:auto; margin-right:auto;
    }
    .login-container button:hover { background-color:rgb(59,82,176); }
    .error-msg { color: red; text-align:center; margin-bottom:15px; }
  </style>
</head>
<body>
  <div class="wrapper">
    <h1>Welcome Faculty</h1>
    <div class="login-container">
      <h2>
        <img src="https://www.transparentpng.com/download/user/gray-user-profile-icon-png-fP8Q1P.png" alt="Faculty Icon" style="width:32px;height:32px;">
        Faculty Login
      </h2>

      @if($errors->any())
        <div class="error-msg">{{ $errors->first('login') }}</div>
      @endif
      @if(session('error'))
        <div class="error-msg">{{ session('error') }}</div>
      @endif

      <form method="POST" action="{{ route('faculty.login.submit') }}">
        @csrf

        <div class="form-group">
          <label for="facultyEmail">Email</label>
          <input type="text" id="facultyEmail" name="email" placeholder="Enter Email" required>
        </div>

        <div class="form-group">
          <label for="facultyPassword">Password</label>
          <input type="password" id="facultyPassword" name="password" placeholder="Enter Password" required>
        </div>

        <button type="submit">Login</button>
      </form>
    </div>
  </div>
</body>
</html>


