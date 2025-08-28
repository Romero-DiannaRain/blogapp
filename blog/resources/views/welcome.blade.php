<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Campus Blog Login</title>
  <style>
    html {
      height: 100%;
      background: linear-gradient(135deg, #ffffff, #800000);
    }
    body {
      margin: 0;
      padding: 0;
      height: 90vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
    }

    .wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      font-size: 85px;
      font-weight: bold;
      color: #8B0000;
      text-shadow: 2px 2px 2px #aaa;
      margin: 0 0 40px 0;
    }

    .login-container {
      background-color:rgba(237, 237, 237, 0.51);
      padding: 60px 50px;
      border-radius: 25px;
      width: 600px;
      box-shadow: 0px 6px 15px rgba(0,0,0,0.15);
    }

    .login-container h2 {
      text-align: center;
      margin-top: 0;
      margin-bottom: 40px;
      font-size: 22px;
      font-weight: bold;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .form-group label {
      display: block;
      font-size: 16px;
      font-weight: bold;
      color: #333;
      margin-bottom: 8px;
      padding-left: 10px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 25px;
      font-size: 15px;
      text-align: left;
      box-sizing: border-box;
      background-color: rgba(255, 255, 255, 0.72);
    }

    .login-container button {
      width: 50%;
      padding: 14px;
      border: none;
      border-radius: 25px;
      background-color: #4a63c7;
      color: white;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 2px 3px 5px rgba(0,0,0,0.2);
      margin-top: 50px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .login-container button:hover {
      background-color:rgb(59, 82, 176);
    }

    .back-btn {
      display: block;
      text-align: center;
      margin-top: 20px;
      font-size: 16px;
      color: #000;
      text-decoration: underline;
      cursor: pointer;
    }

    .role-container {
      background-color: rgba(237, 237, 237, 0.51);
      padding: 40px;
      border-radius: 25px;
      text-align: center;
      box-shadow: 0px 6px 15px rgba(0,0,0,0.15);
      height: 350px;
    }

    .role-title {
      font-size: 50px;
      font-weight: bold;
      color: #8B0000;
      margin-bottom: 30px;
      text-shadow: 2px 2px 2px #aaa;
    }

    .roles {
      display: flex;
      justify-content: center;
      gap: 40px;
    }

    .role {
      background: #f9dada;
      border-radius: 20px;
      padding: 20px;
      width: 150px;
      height: 120px;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .role:hover {
      transform: scale(1.05);
      box-shadow: 0px 6px 15px rgba(0,0,0,0.2);
    }

    .role img {
      width: 70px;
      height: 70px;
      margin-bottom: 10px;
    }

    .role p {
      font-size: 1rem;
      font-weight: bold;
      color: #333;
      margin: 0;
    }

    #admin-login, #student-login {
      display: none;
    }
  </style>
</head>
<body>
  <div id="role-selection" class="wrapper">
    <div class="role-container">
      <h2 class="role-title">Log in as</h2>
      <div class="roles">
        <a href="{{ route('auth.faculty.login') }}" style="text-decoration:none;">
          <div class="role">
            <img src="https://icons.veryicon.com/png/o/commerce-shopping/wangdianbao-icon-monochrome/administrators-6.png" alt="Administrator">
            <p>Administrator</p>
          </div>
        </a>
        <a href="{{ route('student.login.form') }}" style="text-decoration:none;">
          <div class="role">
            <img src="https://www.transparentpng.com/download/user/gray-user-profile-icon-png-fP8Q1P.png" alt="Student">
            <p>Student</p>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div id="admin-login" class="wrapper">
    <h1>Welcome Admin</h1>
    <div class="login-container">
      <h2>Administrator Login</h2>
      <form method="POST" action="/admin-login">
        @csrf
        <div class="form-group">
          <label for="adminUsername">Username</label>
          <input type="text" id="adminUsername" name="adminUsername" placeholder="Enter Username" required>
        </div>
        <div class="form-group">
          <label for="adminPassword">Password</label>
          <input type="password" id="adminPassword" name="adminPassword" placeholder="Enter Password" required>
        </div>
        <button type="submit">Login</button>
        <span class="back-btn" onclick="goBack()">Back</span>
      </form>
    </div>
  </div>

  <div id="student-login" class="wrapper">
    <h1>Welcome to Campus Blog</h1>
    <div class="login-container">
      <h2>Student Login</h2>
      <form method="POST" action="{{ route('student.login.submit') }}">
        @csrf
        <div class="form-group">
          <label for="studentId">Student ID</label>
          <input type="text" id="username" name="username" placeholder="Enter Student ID"
                  required pattern="[A-Za-z0-9\-]+" title="Student ID can contain letters, numbers, and '-' only">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit">Login</button>
        <span class="back-btn" onclick="goBack()">Back</span>
      </form>
    </div>
  </div>

  <script>
    function showLogin(role) {
      document.getElementById('role-selection').style.display = 'none';
      if (role === 'admin') {
        document.getElementById('admin-login').style.display = 'flex';
      } else if (role === 'student') {
        document.getElementById('student-login').style.display = 'flex';
      }
    }

    function goBack() {
      document.getElementById('admin-login').style.display = 'none';
      document.getElementById('student-login').style.display = 'none';
      document.getElementById('role-selection').style.display = 'flex';
    }
  </script>
</body>
</html>
