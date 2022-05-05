<h2>確認画面</h2>
<form action="inc/send_mail.php" method="post">
    <table class="confirm_table">
        <tr>
            <td>名前</td>
            <td><?php //echo $inputs['name'] ?? '' ?></td>
            <td><?php echo $_SESSION['name'] ?? '' ?></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><?php //echo $inputs['email'] ?? '' ?></td>
            <td><?php echo $_SESSION['email'] ?? '' ?></td>
        </tr>
        <tr>
            <td>内容</td>
            <td><?php //echo nl2br($inputs['message'] ?? '') ?></td>
            <td><?php echo nl2br($_SESSION['message'] ?? '') ?></td>
        </tr>
        <tr>
            <td>
                <button type="submit" name="back">前に戻る</button>
                <!-- <button onclick="history.go(-1);">前に戻る</button> -->
            </td>
            <td>
                <input type="submit" value="送信する" name="send_mail">
            </td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST['back'])) {
    header("Location:".$_SERVER['HTTP_REFERER']);
}
?>