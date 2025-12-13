<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?= esc($profile['nama']) ?></title>

    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Link to Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- AOS (Animate On Scroll) CSS for animations -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            background-color: #121212;
            color: #f1f1f1;
            padding-top: 40px;
        }

        .card {
            background: #1e1e1e;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            border: none;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }

        .card-body {
            padding: 25px;
        }

        .card-body h3, .card-body h4 {
            color: #FFD700;
            font-weight: bold;
        }

        .badge {
            background-color: #FFD700;
            color: #1f1f1f;
            font-weight: bold;
            border-radius: 20px;
            padding: 6px 12px;
        }

        .table-dark th {
            background-color: #333;
            color: #FFD700;
        }

        .table-dark td {
            color: #f1f1f1;
        }

        .btn-warning {
            background-color: #FFD700;
            color: #1f1f1f;
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .btn-warning:hover {
            background-color: #cc9b00;
            transform: scale(1.05);
        }

        .qr-code {
            border: 3px solid #FFD700;
            padding: 10px;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .qr-code:hover {
            transform: scale(1.1);
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #FFD700;
            transition: transform 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Profile Card with AOS Animation (fade-up) -->
    <div class="card mx-auto" style="width: 18rem;" data-aos="fade-up" data-aos-duration="3000">
        <!-- Image Section -->
        <div class="d-flex justify-content-center mt-4">
            <img src="<?= base_url('uploads/profile/' . $profile['foto']) ?>" class="profile-img" alt="Profile Picture">
        </div>
        
        <div class="card-body text-center">
            <!-- Profile Information -->
            <h5 class="card-title"><?= esc($profile['nama']) ?></h5>
            <h4><span class="badge"><?= esc($profile['spesialis']) ?></span></h4>
        </div>

        <!-- List Group Section -->
        <ul class="list-group list-group-flush">
        </ul>

        <!-- Card Links Section -->
        <div class="card-body text-center" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
            <a href="<?= esc($profile['link_profile']) ?>" target="_blank" class="card-link btn btn-warning btn-sm">
                View Profile
            </a>
            <a href="tel:<?= esc($profile['no_hp']) ?>" class="card-link btn btn-warning btn-sm">
                Call
            </a>
        </div>

        <!-- QR Code Section -->
        <div class="text-center mt-4 qr-code" data-aos="fade-up" data-aos-duration="2000">
            <h4>QR Code</h4>
            <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= urlencode('http://localhost:8080/profile/' . $profile['id']) ?>&size=100x100" class="rounded" alt="QR Code">
        </div>
    </div>
</div>

<!-- Link to Bootstrap JS for functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS (Animate On Scroll) JS for animations -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init();
</script>

</body>
</html>
