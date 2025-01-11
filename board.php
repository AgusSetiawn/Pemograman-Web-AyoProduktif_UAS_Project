<?php
include('backend/db.php');

// Cek apakah form untuk membuat board telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['board_name'])) {
    $board_name = $_POST['board_name'];

    // Menyimpan board baru ke dalam database
    $stmt = getDB()->prepare("INSERT INTO boards (name) VALUES (:board_name)");
    $stmt->bindParam(':board_name', $board_name);
    $stmt->execute();

    // Redirect setelah berhasil menambah board
    header("Location: board.php");
    exit();
}

// Ambil daftar boards dari database
$stmt = getDB()->query("SELECT * FROM boards");
$boards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayo Produktif - Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Latar Belakang Gradien Bergerak */
        body {
            font-family: 'Raleway', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(45deg, #00c6ff, #0072ff, #ff007f); /* Gradien warna yang bergerak */
            background-size: 400% 400%; /* Ukuran gradien besar untuk animasi */
            animation: gradientBG 10s ease infinite; /* Animasi latar belakang */
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Animasi Latar Belakang Gradien Bergerak */
        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            max-width: 1200px;
            padding: 50px;
            text-align: center;
        }

        h1 {
            font-size: 4rem;
            font-weight: 800;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 5px;
            margin-bottom: 30px;
            text-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .input-group input {
            border-radius: 50px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            border: 1px solid #fff;
            padding: 18px;
        }

        .input-group button {
            border-radius: 50px;
            background-color: #ff007f;
            border: none;
            color: white;
            padding: 18px 35px;
            font-size: 1.2rem;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .input-group button:hover {
            background-color: #ff6f91;
            transform: scale(1.1);
        }

        /* Card Desain dengan Efek 3D */
        .card {
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.85);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            margin: 20px;
            transition: all 0.4s ease;
            transform-style: preserve-3d;
            cursor: pointer;
        }

        .card-body {
            padding: 30px;
            text-align: center;
        }

        .card-title {
            font-size: 1.6rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }

        /* Tombol dengan Ikon */
        .btn {
            border-radius: 30px;
            padding: 14px 30px;
            font-size: 1.2rem;
            margin: 10px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #6e7bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #4b61e5;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn i {
            margin-right: 8px;
        }

        /* Efek Hover pada Card */
        .card:hover {
            transform: translateY(-10px) rotateY(10deg);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }

        /* Responsif untuk Mobile */
        @media (max-width: 768px) {

            .input-group input,
            .input-group button {
                width: 100%;
                margin-bottom: 10px;
            }

            .card {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Daftar Papan</h1>

        <!-- Form untuk menambah board baru -->
        <form action="board.php" method="POST" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="board_name" placeholder="Nama Papan Baru" required>
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>Buat Papan</button>
            </div>
        </form>

        <div class="row">
            <?php foreach ($boards as $board): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($board['name']); ?></h5>
                            <a href="list.php?board_id=<?= $board['id'] ?>" class="btn btn-success"><i class="fas fa-list"></i>Lihat Daftar</a>
                            <a href="delete_board.php?id=<?= $board['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus papan ini?')"><i class="fas fa-trash-alt"></i> Hapus Papan</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>
