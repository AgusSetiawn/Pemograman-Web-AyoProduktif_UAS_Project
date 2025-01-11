<?php
include('backend/db.php');

// Ambil board_id dari URL
$board_id = isset($_GET['board_id']) ? $_GET['board_id'] : 0;

// Validasi jika board_id tidak valid
if ($board_id == 0) {
    echo "ID papan tidak valid.";
    exit();
}

// Menyimpan daftar baru jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['list_name']) && isset($_POST['description'])) {
    $list_name = $_POST['list_name'];
    $description = $_POST['description'];

    // Menyimpan list baru ke dalam database, termasuk deskripsi
    $stmt = getDB()->prepare("INSERT INTO lists (board_id, name, description) VALUES (:board_id, :list_name, :description)");
    $stmt->bindParam(':board_id', $board_id);
    $stmt->bindParam(':list_name', $list_name);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    // Redirect ke halaman yang sama setelah berhasil
    header("Location: list.php?board_id=" . $board_id);
    exit();
}

// Mengambil daftar berdasarkan board_id
$stmt = getDB()->prepare("SELECT * FROM lists WHERE board_id = :board_id");
$stmt->bindParam(':board_id', $board_id);
$stmt->execute();
$lists = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Cek jika ada data daftar yang ditemukan
if (!$lists || count($lists) == 0) {
    $lists = [];  // Jika tidak ada data, set menjadi array kosong
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar untuk Papan - Ayo Produktif!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Latar Belakang Dinamis dengan Gradien */
        body {
            font-family: 'Raleway', sans-serif;
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
            position: relative;
        }

        /* Animasi Latar Belakang Gradien Bergerak */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Animasi Teks */
        h1 {
            font-size: 4rem; /* Ukuran lebih besar untuk headline */
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            animation: fadeIn 2s ease-out;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.4);
            margin-bottom: 2rem;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Tombol */
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

        /* Container */
        .container {
            text-align: center;
        }

        /* Form untuk menambah daftar baru dengan deskripsi */
        .form-container {
            display: none;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            text-align: center;
        }

        .form-container input, .form-container textarea {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #fff;
            border-radius: 8px;
            color: white;
        }

        .button-container {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            gap: 20px;
            z-index: 10;
        }

        .button-container .btn-success,
        .button-container .btn-primary {
            border-radius: 50px;
            padding: 15px 30px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            font-size: 1.2rem;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .button-container .btn-success:hover,
        .button-container .btn-primary:hover {
            transform: scale(1.1);
            background: rgba(0, 0, 0, 0.8);
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05) rotate(5deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .card-body {
            padding: 20px;
            text-align: center;
            color: white;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .btn-danger {
            background: rgba(255, 0, 0, 0.8);
        }

        .btn-danger:hover {
            background: rgba(255, 0, 0, 1);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem; /* Slightly smaller for smaller screens */
            }

            .form-container {
                width: 80%;
            }

            .card {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Daftar Papan</h1>

        <!-- Form untuk menambah daftar baru dengan deskripsi -->
        <div id="formContainer" class="form-container">
            <form action="list.php?board_id=<?= $board_id ?>" method="POST">
                <div class="mb-3">
                    <label for="list_name" class="form-label">Nama Daftar</label>
                    <input type="text" class="form-control" id="list_name" name="list_name" placeholder="Nama Daftar Baru" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi daftar" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Buat Daftar</button>
                <button type="button" class="btn btn-secondary" onclick="toggleForm()">Batal</button>
            </form>
        </div>

        <!-- Menampilkan daftar yang ada -->
        <div class="row">
            <?php if (count($lists) > 0): ?>
                <?php foreach ($lists as $list): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($list['name']); ?></h5>
                                <p class="card-text"><?= nl2br(htmlspecialchars($list['description'])); ?></p>
                                <a href="delete_list.php?list_id=<?= $list['id'] ?>&board_id=<?= $board_id ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus daftar ini?')">Hapus Daftar</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Tidak ada daftar ditemukan untuk papan ini.</p>
            <?php endif; ?>
        </div>

        <!-- Tombol untuk kembali ke halaman board dan tombol tambah daftar -->
        <div class="button-container">
            <button class="btn btn-success" id="showFormBtnBottom" onclick="toggleForm()">
                <i class="fas fa-plus"></i> Tambah Daftar
            </button>
            <a href="board.php" class="btn btn-primary">
                <i class="fas fa-home"></i> Home
            </a>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan/menyembunyikan form input
        function toggleForm() {
            var formContainer = document.getElementById('formContainer');
            var showFormBtn = document.getElementById('showFormBtn');
            
            // Toggle visibility dari form
            if (formContainer.style.display === 'none') {
                formContainer.style.display = 'block';
                showFormBtn.style.display = 'none'; // Sembunyikan tombol + Tambah Daftar
            } else {
                formContainer.style.display = 'none';
                showFormBtn.style.display = 'inline-block'; // Tampilkan tombol + Tambah Daftar
            }
        }
    </script>
</body>
</html>
