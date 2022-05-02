<?php
include 'email_message.php';

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

// $name = filter_input(INPUT_POST, 'name');
$name = htmlspecialchars($_POST['name']);
$inputs['name'] = $name;

if ($name) {
    // $name = trim($name);
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
$email = htmlspecialchars($_POST['email']);;
$inputs['email'] = $email;
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
$message = htmlspecialchars($_POST['message']);
$inputs['message'] = $message;
$inputMessage = $message;
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

function onSendClicked($mMail="", $mName="", $mMessage="") {
    echo "Send was clicked";
    // $to      = 'kaytharimyatmoe@gmail.com'; //todo change to isogawa
    // $subject = 'ジェニオ へのお問合せを受け付けました';
    // $emailMessageBuilder = new EmailMessage();
    // echo $mMail . ' >>>>> ' . $mMessage;
    // $body = $emailMessageBuilder->buildMessage($mMail, $mName, $mMessage);
    // $headers[] = 'MIME-Version: 1.0';
    // $headers[] = 'Content-type: text/html; charset=iso-8859-1';

    // // Additional headers
    // $headers[] = 'To: kaytharimyatmoe@gmail.com'; //todo change to isogawa
    // $headers[] = 'From: ' . $mMail;
    // $headers[] = 'Cc: kaythari14@gmail.com';
    // $headers[] = 'Bcc: kaythari14@gmail.com';
    // echo $body . ' >>>>> ' . $headers;

    // if (mail($to, $subject, $mMessage, implode("\r\n", $headers))) {
    //     echo 'Your mail has been sent successfully.';
    //     // header("location:index.php");
    // } else {
    //     echo 'Unable to send email. Please try again.';
    // }

    // echo 'Email Sent.';
}

?>

<?php if (count($errors) === 0) : ?>
    <h2>確認画面</h2>
    <form>
        <table class="confirm_table">
            <tr>
                <td>名前</td>
                <td><?php echo $inputs['name'] ?? '' ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td><?php echo $inputs['email'] ?? '' ?></td>
            </tr>
            <tr>
                <td>内容</td>
                <td><?php echo nl2br($inputs['message'] ?? '') ?></td>
            </tr>
            <tr>
                <td>
                    <!-- <input type="submit" value="前に戻る"> -->
                    <button onclick="history.go(-1);">前に戻る</button>
                </td>
                <td>
                    <button onclick="onSendClicked()">送信する</button>
                </td>
            </tr>
        </table>
    </form>
<?php endif ?>