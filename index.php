<?php

require __DIR__ . '/inc/header.php';

$errors = [];
$inputs = [];

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($request_method === 'GET') {
    // show the form
    echo "GET_DETECTED";
    require __DIR__ . '/inc/form.php';
} elseif ($request_method === 'POST') {
    echo "POST_DETECTED";
    // handle the form submission
    require __DIR__ .  '/inc/validation.php';
    // show the form if the error exists
    if (count($errors) > 0) {
        require __DIR__ . '/inc/form.php';
    }
}

require __DIR__ .  '/inc/footer.php';