<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayo Produktif!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Latar Belakang Dinamis dengan Gradien */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(45deg, #00c6ff, #0072ff, #ff007f); /* Gradien warna yang bergerak */
            background-size: 400% 400%; /* Ukuran gradien besar untuk animasi */
            animation: gradientBG 10s ease infinite; /* Animasi latar belakang */
            color: #fff;
            height: 100vh; /* Full height untuk layar */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Animasi Latar Belakang Gradien Bergerak */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Animasi Teks */
        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            animation: fadeIn 2s ease-out;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.4);
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Button */
        .btn {
            background-color: #ff007f;
            border: none;
            color: white;
            font-size: 1.25rem;
            padding: 15px 35px;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #ff6f91;
            transform: scale(1.1);
        }

        .container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Ayo Produktif!</h1>
        <a href="board.php" class="btn btn-lg mt-4">Lihat Papan</a>
    </div>
</body>
</html>
