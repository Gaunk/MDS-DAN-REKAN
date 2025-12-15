<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= base_url('temp_home/assets/img/icon-1.png') ?>">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            text-align: center;
        }

        .maintenance-container {
            background: rgba(0,0,0,0.5);
            padding: 50px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 90%;
            animation: fadeIn 1s ease-in-out;
        }

        .maintenance-container img {
            max-width: 150px;   /* maksimal lebar logo */
            height: auto;       /* proporsional */
            margin-bottom: 20px; /* jarak dengan judul */
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #ffcc00;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .loader {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #ffcc00;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin: 0 auto;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0%   { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 500px) {
            h1 { font-size: 2rem; }
            p { font-size: 1rem; }
            .maintenance-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <img src="<?= base_url('images') ?>/logo.png" alt="Logo Perusahaan">
        <h1>WEBSITE SEDANG DALAM PEMELIHARAAN</h1>
        <p>Mohon maaf, website sedang diperbarui. Silakan kunjungi kembali nanti.</p>
        <div class="loader"></div>
    </div>
</body>
</html>
