<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: sans-serif; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; background-color: #e6f7ff; }
        .container { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; }
        h2 { color: #0056b3; margin-bottom: 20px; }
        p { color: #333; margin-bottom: 10px; }
        .logout-form { margin-top: 20px; }
        button {
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selamat Datang di Admin Dashboard, {{ Auth::user()->name }}!</h2>
        <p>Anda login sebagai **{{ Auth::user()->role }}**.</p>

        <form class="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>