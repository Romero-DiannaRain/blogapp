<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Campus Blog')</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f4f9;
    }
    header {
      background: #800000;
      color: white;
      padding: 15px;
      text-align: center;
    }
    .container {
      display: flex;
      padding: 20px;
      gap: 20px;
    }
    .sidebar {
      width: 25%;
    }
    .feed {
      width: 75%;
    }
    .card {
      background: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      display: flex;
      flex-direction: column;
    }
    .card h3 {
      margin-top: 0;
    }
    .card input, 
    .card textarea, 
    .card button {
      width: 100%;
      margin: 8px 0;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }
    .card button {
      background: #800000;
      color: white;
      border: none;
      cursor: pointer;
    }
    .card button:hover {
      background: #a52a2a;
    }
    .post {
      background: white;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .post img {
      max-width: 100%;
      border-radius: 6px;
      margin-top: 10px;
    }
    .btn-small {
      padding: 6px 12px;
      margin: 5px 5px 0 0;
      font-size: 13px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      background: #800000;
      color: white;
    }
    .btn-small:hover {
      background: #a52a2a;
    }
    .search-box {
      margin-bottom: 20px;
    }
    .search-box input {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
  </style>
</head>
<body>

<header>
  <h1>Campus Blog</h1>
</header>

<div class="container">
  <!-- Sidebar -->
  <div class="sidebar">
    @yield('sidebar')
  </div>

  <!-- Feed -->
  <div class="feed">
    @yield('content')
  </div>
</div>

</body>
</html>
