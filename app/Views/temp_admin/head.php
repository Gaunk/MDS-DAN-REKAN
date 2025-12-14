<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>MDS Dashboard <?= $judul ?></title>

    <!-- Fontfaces CSS-->
    <link href="<?= base_url('temp_admin/')?>css/font-face.css" rel="stylesheet" media="all">
    <link href="<?= base_url('temp_admin/')?>vendor/fontawesome-7.0.1/css/all.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('temp_admin/')?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Bootstrap CSS-->
    <link href="<?= base_url('temp_admin/')?>vendor/bootstrap-5.3.8.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?= base_url('temp_admin/')?>css/aos.css" rel="stylesheet" media="all">
    <link href="<?= base_url('temp_admin/')?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('temp_admin/')?>css/swiper-bundle-11.2.10.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('temp_admin/')?>vendor/perfect-scrollbar/perfect-scrollbar-1.5.6.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?= base_url('temp_admin/')?>css/theme.css" rel="stylesheet" media="all">
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <!-- =============================================================== -->    <!-- FullCalendar v6+ CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css' rel='stylesheet' />
<style type="text/css">
    /* FullCalendar Bootstrap 5 integration */
    .fc-theme-standard .fc-view-harness {
        border: none;
    }
    
    .fc-theme-standard .fc-scrollgrid {
        border: 1px solid var(--bs-border-color);
        border-radius: 0.375rem;
    }
    
    .fc .fc-button-primary {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        color: #fff;
    }
    
    .fc .fc-button-primary:hover {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        opacity: 0.9;
    }
    
    .fc-theme-standard .fc-header-toolbar {
        margin-bottom: 1rem;
    }
    
    .fc-event {
        border-radius: 0.25rem;
        border: none !important;
        font-size: 0.875rem;
    }
    
    .fc-daygrid-event {
        margin: 2px 4px;
    }
    </style>
</head>