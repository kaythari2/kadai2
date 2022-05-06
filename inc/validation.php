<?php
include 'util/basic_utilities.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
 }

const NAME_REQUIRED = '名前を入力してください。';
const NAME_INVALID = '20文字を超えない名前お願いします。';
const EMAIL_REQUIRED = 'メールアドレスを入力してください。';
const EMAIL_INVALID = '100文字を超えないメールアドレスをお願いします。';
const EMAIL_AMBIGUOUS = '誤ってメールアドレスです。';
const MESSAGE_REQUIRED = '内容を入力してください。';
const MESSAGE_INVALID = '1,000文字を超えない内容をお願いします。';

const MAX_NAME_CNT = 20;
const MAX_MAIL_CNT = 100;
const MAX_MESSAGE_CNT = 1000;

if (isset($_POST['name'])) {
    $name = htmlspecialchars($_POST['name']);
    // $inputs['name'] = $name;
    $_SESSION['name'] = $name;
} else $name = $_SESSION['name'] ?? '';
// } else $name = $inputs['name'] ?? '';
if ($name) {
    $name = trimAndValidateLenght($name, 1, MAX_NAME_CNT);
    if ($name === '') {
        $errors['name'] = NAME_REQUIRED;
    } else if (!$name) {
        $errors['name'] = NAME_INVALID;
    }
} else {
    $errors['name'] = NAME_REQUIRED;
}

// sanitize & validate email
if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    // $inputs['email'] = $email;
    $_SESSION['email'] = $email;
} else $email = $_SESSION['email'] ?? '';
// } else $email = $inputs['email'] ?? '';
if ($email) {
    $email = trimAndValidateLenght($email, 1, MAX_MAIL_CNT);
    if ($email === '') {
        $errors['email'] = EMAIL_REQUIRED;
    } else if (!$email) {
        $errors['email'] = EMAIL_INVALID;
    } else {
        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = EMAIL_AMBIGUOUS;
        }
    }
} else {
    $errors['email'] = EMAIL_REQUIRED;
}

// sanitize & validate message
if (isset($_POST['message'])) {
    $message = htmlspecialchars($_POST['message']);
    $_SESSION['message'] = $message;
    // $inputs['message'] = $message;
} else $message = $_SESSION['message'] ?? '';
// } else $message = $inputs['message'] ?? '';
if ($message) {
    // validate email
    $message = trimAndValidateLenght($message, 1, MAX_MESSAGE_CNT);
    if ($message === '') {
        $errors['message'] = MESSAGE_REQUIRED;
    } else if (!$message) {
        $errors['message'] = MESSAGE_INVALID;
    }
} else {
    $errors['message'] = MESSAGE_REQUIRED;
}

if (isset($_POST['to_validate'])) {
    $allErrors = implode("\\n", $errors);
    if ($allErrors != '') {
        echo '<script type="text/javascript">alert("' . $allErrors . '");</script>';
    }
}

function trimAndValidateLenght($s, $min, $max)
{
    $s = trim($s);
    if (strlen($s) > $max) {
        return false;
    } else if (strlen($s) < $min) return '';
    else {
        return $s;
    }
}
