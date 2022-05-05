<?php
session_start();

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$message = $_SESSION['message'];
$to      = 'kaytharimyatmoe@gmail.com'; //todo change to isogawa
$subject = 'ジェニオ へのお問合せを受け付けました';
$body = buildMessage($email, $name, $message);
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: kaytharimyatmoe@gmail.com'; //todo change to isogawa
$headers[] = 'Reply-To: ' . $email;
$headers[] = 'From: ' . $email;
$headers[] = 'Cc: kaythari14@gmail.com';
$headers[] = 'Bcc: kaythari14@gmail.com';
// echo $body . ' >>>>> ' . json_encode($headers);

$success = mail($to, $subject, $message, implode("\r\n", $headers));
echo $success;
if (!$success) {
    print_r(error_get_last()['message']);
} else {
    print_r("sent mail was >>>>> ".$body);
    // header("Location:/index.php");
}
return;

function buildMessage($fromMail, $fromName, $fromInqury)
{
    return '<body>' .
        '<div>件名：ジェニオ へのお問合せを受け付けました</div>' .
        '<br>'.
        ' <div>以下本文：</div>' .
        '<br>'.
        '<div>==============</div>' .
        '<div>問合わせフォームより、下記ユーザーからお問合せがございました。<br>' .
        '速やかにご対応いただけますよう御願い申し上げます。<br>' .
        '【ご注意】<br>' .
        'このメールは事務局より自動送信させていただいております。<br>' .
        'こちらのメールに返信いただきましてもご対応いたしかねますので<br>' .
        '何卒ご了承くださいませ。<br></div>' .
        '<div>==============</div>' .
        '<br>'.
        '<div>━お問合せいただいたお客様━━━━━━━━━━━━━━</div>' .
        '<br>'.
        '<div>お名前：' . $fromName . '</div>' .
        '<div>メールアドレス： ' . $fromMail . '</div>' .
        '<br>'.
        '<div>━お問合せ内容━━━━━━━━━━━━━━━━━━━━</div>' .
        '<br>'.
        '<div>お問合せ内容 : <br>' . $fromInqury . '</div>' .
        '<br>'.
        '<div>━━━━━━━━━━━━━━━━━━━━━━━━━━━</div>' .
        '</body>';
}
