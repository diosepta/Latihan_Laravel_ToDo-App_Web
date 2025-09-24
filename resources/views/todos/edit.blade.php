<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit To-Do</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color-dark: #120A2F; /* Deepest purple */
            --bg-color-light: #1A0D3E; /* Slightly lighter purple */
            --card-bg: rgba(255, 255, 255, 0.08); /* Semi-transparent for depth */
            --primary-neon: #8A2BE2; /* Amethyst Neon */
            --secondary-neon: #00FFFF; /* Aqua Neon */
            --text-light: #E0E0E0; /* Off-white for readability */
            --text-muted: #A0A0A0; /* Lighter grey for secondary text */
            --success-neon: #39FF14; /* Green Neon */
            --danger-neon: #FF3131; /* Red Neon */
            --border-glow: rgba(138, 43, 226, 0.6); /* Primary neon glow */
            --shadow-strong: 0 15px 40px rgba(0, 0, 0, 0.5);
            --shadow-light: 0 5px 20px rgba(0, 0, 0, 0.3);
            --transition-speed: 0.3s;
        }

        body {
            background: linear-gradient(135deg, var(--bg-color-dark) 0%, var(--bg-color-light) 100%);
            font-family: 'Poppins', sans-serif;
            color: var(--text-light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        body::before { /* Background animation */
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 15% 15%, var(--primary-neon) 0%, transparent 10%),
                radial-gradient(circle at 85% 85%, var(--secondary-neon) 0%, transparent 10%);
            opacity: 0.1;
            filter: blur(80px);
            animation: backgroundPulse 15s infinite alternate;
            z-index: 0;
        }

        @keyframes backgroundPulse {
            0% { transform: scale(1); opacity: 0.1; }
            50% { transform: scale(1.1); opacity: 0.15; }
            100% { transform: scale(1); opacity: 0.1; }
        }

        .container {
            max-width: 600px;
            position: relative;
            z-index: 10;
        }
        .form-container,
        .todo-container {
            background: var(--card-bg);
            border-radius: 25px;
            box-shadow: var(--shadow-strong);
            padding: 40px;
            width: 100%;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            animation: fadeIn var(--transition-speed) ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .header {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 3rem;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
            background: linear-gradient(45deg, var(--primary-neon), var(--secondary-neon));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 10px var(--primary-neon), 0 0 20px var(--secondary-neon);
            animation: neonPulse 2s infinite alternate;
        }

        @keyframes neonPulse {
            0% { text-shadow: 0 0 5px var(--primary-neon), 0 0 10px var(--secondary-neon); }
            100% { text-shadow: 0 0 15px var(--primary-neon), 0 0 25px var(--secondary-neon); }
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            padding: 15px;
            border-radius: 10px;
            transition: all var(--transition-speed) ease;
        }
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: var(--primary-neon);
            box-shadow: 0 0 0 0.25rem rgba(138, 43, 226, 0.25), 0 0 10px var(--primary-neon);
            color: var(--text-light);
            outline: none;
        }
        .text-label {
            color: var(--text-light);
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }

        .btn {
            font-weight: 600;
            border-radius: 50px;
            transition: all var(--transition-speed) ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.5s ease;
        }
        .btn:hover::before {
            left: 100%;
        }

        .btn-submit {
            background: linear-gradient(45deg, var(--secondary-neon), var(--primary-neon));
            border: none;
            color: white;
            padding: 15px 30px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.6);
        }
        .btn-submit:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.8), 0 10px 30px rgba(0, 0, 0, 0.6);
            background: linear-gradient(45deg, var(--primary-neon), var(--secondary-neon));
        }
        
        .btn-back {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--text-muted);
            color: var(--text-muted);
            padding: 12px 25px;
            border-radius: 50px;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.1);
        }
        .btn-back:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            transform: translateY(-3px) scale(1.01);
            border-color: var(--text-light);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <h1 class="header">Edit To-Do</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('todos.update', $todo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label text-label">Judul To-Do</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $todo->title }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label text-label">Deskripsi (Opsional)</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $todo->description }}</textarea>
            </div>
            <div class="d-grid gap-3">
                <button type="submit" class="btn btn-submit text-white">
                    <i class="fas fa-save me-2"></i>Perbarui
                </button>
                <a href="{{ route('todos.index') }}" class="btn btn-back mt-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</body>
</html>