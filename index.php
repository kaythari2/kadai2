<?php
require __DIR__ . '/inc/header.php';

$errors = [];

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($request_method === 'GET') {
    require __DIR__ . '/inc/form.php';
} elseif ($request_method === 'POST') {
    require __DIR__ .  '/inc/validation.php';
    // show the form if the error exists
    if (count($errors) > 0) {
        require __DIR__ . '/inc/form.php';
        return;
    }
    require __DIR__ . '/inc/confirmation.php';
}

require __DIR__ .  '/inc/footer.php';

