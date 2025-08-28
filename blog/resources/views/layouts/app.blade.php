<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: auto; }
        .flash { background: #d4edda; padding: 10px; margin-bottom: 10px; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <div class="container">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        {{-- Page-specific content will be inserted here --}}
        @yield('content')
    </div>
</body>
</html>
