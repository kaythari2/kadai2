<h2>確認画面</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                <input type="submit" value="送信する" name="send">
            </td>
        </tr>
    </table>
</form>

<?php
include 'email_message.php';
if (isset($_POST['send'])) {
    $reName = htmlspecialchars($_POST['name']);

    $to      = 'kaytharimyatmoe@gmail.com'; //todo change to isogawa
    $subject = 'ジェニオ へのお問合せを受け付けました';
    $emailMessageBuilder = new EmailMessage();
    echo $reName . ' >>>>> ' . $inputs['email'];
    $body = $emailMessageBuilder->buildMessage($email, $name, $message);
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

    // Additional headers
    $headers[] = 'To: kaytharimyatmoe@gmail.com'; //todo change to isogawa
    $headers[] = 'From: ' . $email;
    $headers[] = 'Cc: kaythari14@gmail.com';
    $headers[] = 'Bcc: kaythari14@gmail.com';
    echo $body . ' >>>>> ' . $headers;

    // if (mail($to, $subject, $message, implode("\r\n", $headers))) {
    //     // echo 'Your mail has been sent successfully.';
    //     header("location:index.php");
    // } else {
    //     echo 'Unable to send email. Please try again.';
    // }

    echo 'Email Sent.';
}
?>