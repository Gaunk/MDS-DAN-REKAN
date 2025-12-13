<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?= esc($profile['nama']) ?></title>

    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS for styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .profile-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
        }
        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 20px; /* Space between image and specialization */
        }
        .profile-header h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        .profile-header p {
            color: #777;
            font-size: 14px;
        }
        .profile-header .badge {
            background-color: #007bff;
            color: #fff;
            font-size: 14px;
            border-radius: 10px;
            padding: 5px 10px;
        }
        .profile-details {
            margin-top: 20px;
        }
        .profile-details th {
            font-weight: bold;
            color: #555;
        }
        .profile-details td {
            padding: 8px;
            color: #555;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        .qr-code img {
            width: 150px;
            height: 150px;
        }
        
        /* Animation for hover and transition */
        .view-profile-link {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .view-profile-link:hover {
            background-color: #0056b3;
            transform: translateY(-3px); /* Button lift effect */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2); /* Slight shadow for hover */
        }

        .view-profile-link:active {
            transform: translateY(1px); /* Button depression effect */
            box-shadow: none;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Profile Card -->
    <div class="profile-card">
        <div class="profile-header">
            <!-- Profile Picture -->
            <?php if ($profile['foto']): ?>
                <img src="<?= base_url('uploads/profile/' . $profile['foto']) ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="https://via.placeholder.com/120" alt="Profile Picture">
            <?php endif; ?>

            <!-- Profile Information -->
            <h1><?= esc($profile['nama']) ?></h1>
            <p><strong>Spesialis: </strong><?= esc($profile['spesialis']) ?></p>
            <span class="badge"><?= esc($profile['no_hp']) ?></span>
        </div>

        <!-- Profile Details -->
        <div class="profile-details">
            <table class="table">
                <tr>
                    <th>Nama Pengacara</th>
                    <td><?= esc($profile['nama']) ?></td>
                </tr>
                <tr>
                    <th>No. Handphone</th>
                    <td><?= esc($profile['no_hp']) ?></td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td><?= esc($profile['lokasi_maps']) ?></td>
                </tr>
                <tr>
                    <th>Link Profil</th>
                    <td>
                        <a href="<?= esc($profile['link_profile']) ?>" target="_blank" class="view-profile-link">
                            View Profile
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <!-- QR Code -->
        <div class="qr-code">
            <h3>QR Code</h3>
            <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= urlencode('http://localhost:8080/profile/' . $profile['id']) ?>&size=150x150" alt="QR Code">
        </div>
    </div>
</div>

<!-- Link to Bootstrap JS for functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
