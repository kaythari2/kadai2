<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['send_mail'])) {
    header("Location:/index.php");
    return;
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

mb_language("japanese");
mb_internal_encoding("UTF-8");
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$message = nl2br($_SESSION['message'] ?? '');
// $_inquiryTo      = 'kaytharimyatmoe@gmail.com';
$inquiryTo      = 'isogawa@genio.co.jp';
$inquirySubject = 'ジェニオ へのお問合せを受け付けました';
$inquiryHeaders[] = 'MIME-Version: 1.0';
$inquiryHeaders[] = 'Content-type: text/html; charset=iso-2022-jp';
$inquiryHeaders[] = 'From: ' . $email;
$inquiryHeaders[] = 'Cc: sakata@genio.co.jp,endou@genio.co.jp';
$inquiryHeaders[] = 'Bcc: koska@genio.co.jp,'.$email;
// $_inquiryHeaders[] = 'Cc: kaythari@genio.co.jp,kt@genio.co.jp';
// $_inquiryHeaders[] = 'Bcc: k@genio.co.jp,'.$email;

$inquiryBody = buildMessage($email, $name, $message);
$inquirySuccess = mb_send_mail($inquiryTo, $inquirySubject, $inquiryBody, implode("\r\n", $inquiryHeaders));

if (!$inquirySuccess) {
    print_r(error_get_last()['message']);
} else {
    doAutoReply($email, $name, $message);
}
return;

function doAutoReply($fromMail, $fromName, $fromInqury) {
    $replyTo = $fromName;
    $replySubject = 'ジェニオ へのお問合せありがとうございました';
    $replyHeaders[] = 'MIME-Version: 1.0';
    $replyHeaders[] = 'Content-type: text/html; charset=iso-2022-jp';
    $replyHeaders[] = 'From: info@genio.co.jp';
    // $_replyHeaders[] = 'From: k@genio.co.jp';
    $replyHeaders[] = 'Bcc: isogawa@genio.co.jp';
    // $_replyHeaders[] = 'Bcc: kaytharimyatmoe@gmail.com';
    $replyBody = buildAutoReply($fromMail, $fromName, $fromInqury);
    $replySuccess = mb_send_mail($replyTo, $replySubject, $replyBody, implode("\r\n", $replyHeaders));
    if (!$replySuccess) {
        print_r(error_get_last()['message']);
    } else {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header("Location:/index.php");
    }
}

function buildMessage($fromMail, $fromName, $fromInqury)
{
    return '<html lang="ja-jp" >' .
        '<head> ' .
        '<meta charset="utf-8" /> ' .
        '</head> ' .
        '<body>' .
        '<div>件名：ジェニオ へのお問合せを受け付けました</div>' .
        '<br>' .
        ' <div>以下本文：</div>' .
        '<br>' .
        '<div>==============</div>' .
        '<div>問合わせフォームより、下記ユーザーからお問合せがございました。<br>' .
        '速やかにご対応いただけますよう御願い申し上げます。<br>' .
        '【ご注意】<br>' .
        'このメールは事務局より自動送信させていただいております。<br>' .
        'こちらのメールに返信いただきましてもご対応いたしかねますので<br>' .
        '何卒ご了承くださいませ。<br></div>' .
        '<div>==============</div>' .
        '<br>' .
        '<div> ━お問合せいただいたお客様━━━━━━ </div>' .
        '<br>' .
        '<div>お名前：' . $fromName . '</div>' .
        '<div>メールアドレス： ' . $fromMail . '</div>' .
        '<br>' .
        '<div> ━お問合せ内容━━━━━━━━━━　</div>' .
        '<br>' .
        '<div>お問合せ内容 : <br>' . $fromInqury . '</div>' .
        '<br>' .
        '<div> ━━━━━━━━━━━━━━━━━━━ </div>' .
        '</body>' .
        '</html>';
}

function buildAutoReply($fromMail, $fromName, $fromInqury)
{
    return '<html lang="ja-jp" >' .
        '<head> ' .
        '<meta charset="utf-8" /> ' .
        '</head> ' .
        '<body>' .
        '<div>件名：ジェニオ へのお問合せありがとうございました</div>' .
        '<br>' .
        ' <div>以下本文：</div>' .
        '<br>' .
        '<div>==============</div>' .
        '<div>本メールは、ジェニオ ホームページにお問合せいただいた方に<br>' .
        '確認のため自動的にお送りしています。<br>' .
        'このメールに心当たりのない場合やご不明な点がある場合は、<br>' .
        'このメールは事務局より自動送信させていただいております。<br>' .
        'こちらのメールに返信いただきましてもご対応いたしかねますので<br>' .
        'isogawa@genio.co.jp までご連絡ください。</div>' .
        '<div>==============</div>' .
        '<br>' .
        '<div>' . $fromName . '様</div>' .
        '<br>' .
        '<div>この度は ジェニオ ホームページへお問合せいただき誠にありがとうございます。</div>' .
        '<div>確認でき次第メールなどで回答させていただきます。</div>' .
        '<br>' .
        '<div> ━お問合せいただいたお客様━━━━━━━━━━━━ </div>' .
        '<br>' .
        '<div>お名前 : ' . $fromName . ' </div>' .
        '<div>メールアドレス： ' . $fromMail . '</div>' .
        '<br>' .
        '<div> ━お問合せ内容━━━━━━━ </div> <br>' .
        '<div>お問合せ内容 : <br>' . $fromInqury . '</div>' .
        '<div> ━━━━━━━━━━━━━━━━━ </div>' .
        '</body>' .
        '</html>';
}
