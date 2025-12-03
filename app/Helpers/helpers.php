<?php
function lang($key) {
    // Ambil bahasa dari query string, default 'id'
    $lang = isset($_GET['lang']) ? $_GET['lang'] : 'id';

    // Load file bahasa
    $translations = [];
    if ($lang === 'en') {
        $translations = include __DIR__ . '/Language/en.php';
    } else {
        $translations = include __DIR__ . '/Language/id.php';
    }

    // Kembalikan nilai dari key
    return $translations[$key] ?? $key;
}
