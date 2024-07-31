<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vigilancia PRT</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 3.5rem; 
        }
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 40px;
        }
        .pulse-effect {
            border: none;
            color: white;
            padding: 40px 80px; 
            cursor: pointer;
            border-radius: 50px;
            background-color: #b31500; 
            font-size: 1.5rem; 
            transition: transform 0.1s ease-in-out; 
        }
        .pulse-effect:hover {
            background-color: #0047a4; 
        }
        .pulse-effect:active {
            transform: scale(1.1); 
        }
        .btn i {
            margin-right: 20px;
            font-size: 2rem; 
        }
    </style>
</head>
<body>

    <div class="text-center">
        <h1>Vigilancia PRT</h1>
        <div class="btn-container">
            <button class="btn pulse-effect"><i class="fas fa-user-shield"></i> Vigilante</button>
            <a href="{{ route('login') }}" class="btn pulse-effect"><i class="fas fa-users-cog"></i> Operativo</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
