<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar To-Do</title>
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

        body::before {
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
            max-width: 800px;
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

        .btn-add-todo {
            background: linear-gradient(45deg, var(--primary-neon), var(--secondary-neon));
            border: none;
            color: white;
            padding: 15px 30px;
            box-shadow: 0 0 15px rgba(138, 43, 226, 0.6);
        }
        .btn-add-todo:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 0 25px rgba(138, 43, 226, 0.8), 0 10px 30px rgba(0, 0, 0, 0.6);
        }

        .todo-item {
            background: rgba(255, 255, 255, 0.05);
            border-left: 5px solid transparent;
            border-radius: 15px;
            margin-bottom: 20px;
            transition: all var(--transition-speed) ease-in-out;
            cursor: pointer;
            color: var(--text-light);
            position: relative;
            padding: 20px;
            box-shadow: var(--shadow-light);
            overflow: hidden;
        }

        .todo-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary-neon), var(--secondary-neon));
            opacity: 0.7;
            transition: opacity var(--transition-speed) ease;
        }
        .todo-item:hover::before {
            opacity: 1;
        }
        .todo-item:hover {
            transform: translateY(-10px) scale(1.01);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5), 0 0 20px var(--border-glow);
            background: rgba(255, 255, 255, 0.08);
        }
        .completed-item {
            background: rgba(57, 255, 20, 0.1);
            opacity: 0.8;
            box-shadow: 0 0 10px rgba(57, 255, 20, 0.4);
        }
        .completed-item::before {
            background: linear-gradient(to bottom, var(--success-neon), #39FF14);
            opacity: 1;
        }
        .completed-item .title {
            text-decoration: line-through;
            color: var(--text-muted);
        }
        .completed-item p, .completed-item small {
            color: var(--text-muted) !important;
        }
        
        .btn-action {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: var(--text-light);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }
        .btn-action:hover {
            transform: scale(1.2);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.4), 0 5px 15px rgba(0, 0, 0, 0.5);
        }
        
        .btn-complete { 
            background: var(--success-neon);
            color: var(--bg-color-dark);
            box-shadow: 0 0 10px var(--success-neon);
        }
        .btn-complete:hover { 
            background: linear-gradient(45deg, #39FF14, #00FF00);
            box-shadow: 0 0 20px var(--success-neon);
            transform: scale(1.25);
        }
        
        .btn-edit { 
            background: var(--primary-neon);
            color: white;
            box-shadow: 0 0 10px var(--primary-neon);
        }
        .btn-edit:hover { 
            background: linear-gradient(45deg, var(--primary-neon), #CC66FF);
            box-shadow: 0 0 20px var(--primary-neon);
            transform: scale(1.25);
        }
        
        .btn-delete { 
            background: var(--danger-neon);
            color: white;
            box-shadow: 0 0 10px var(--danger-neon);
        }
        .btn-delete:hover { 
            background: linear-gradient(45deg, var(--danger-neon), #FF6666);
            box-shadow: 0 0 20px var(--danger-neon);
            transform: scale(1.25);
        }
        
        .empty-state {
            background: rgba(255, 255, 255, 0.03);
            color: var(--text-muted);
            border-radius: 15px;
            padding: 30px;
            border: 1px dashed rgba(255, 255, 255, 0.08);
            font-style: italic;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .alert {
            background-color: rgba(57, 255, 20, 0.2);
            color: var(--success-neon);
            border: 1px solid var(--success-neon);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
            font-weight: 500;
            text-shadow: 0 0 5px rgba(57, 255, 20, 0.5);
            animation: slideIn var(--transition-speed) ease-out forwards;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container todo-container">
        <h1 class="header">Daftar To-Do</h1>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-center mb-4">
            <a href="{{ route('todos.create') }}" class="btn btn-add-todo text-white">
                <i class="fas fa-plus-circle me-2"></i>Buat To-Do Baru
            </a>
        </div>

        @if ($todos->isEmpty())
            <div class="alert alert-info empty-state" role="alert">
                Belum ada To-Do yang dibuat. Klik "Buat To-Do Baru" untuk memulai!
            </div>
        @else
            @foreach ($todos as $todo)
                <div class="todo-item p-3 d-flex justify-content-between align-items-center {{ $todo->is_completed ? 'completed-item' : '' }}">
                    <div>
                        <h5 class="mb-1 title">{{ $todo->title }}</h5>
                        @if ($todo->description)
                            <p class="mb-1">{{ $todo->description }}</p>
                        @else
                            <p class="mb-1 text-muted fst-italic">Deskripsi tidak diisi</p>
                        @endif
                        @if ($todo->is_completed)
                            @if (!empty($todo->completed_at))
                                <small class="text-white fw-bold">Selesai pada: {{ $todo->completed_at->format('d M Y') }}</small>
                            @else
                                <small class="text-warning fw-bold">Selesai, tanggal tidak tersedia</small>
                            @endif
                        @endif
                    </div>
                    <div class="d-flex align-items-center">
                        @if (!$todo->is_completed)
                            <form action="{{ route('todos.complete', $todo->id) }}" method="POST" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-complete btn-sm btn-action">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-edit btn-sm me-2 btn-action">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus To-Do ini?');" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-sm btn-action">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>