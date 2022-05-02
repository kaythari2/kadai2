<h2>お問い合わせ</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <table class="input_table">
        <tr>
            <td>名前</td>
            <td><input type="text" name="name" id="name" value="<?php echo $inputs['name'] ?? '' ?>" placeholder="Dummy Name" class="name"></td>
            <td><small><?php echo $errors['name'] ?? '' ?></small></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><input type="text" name="email" id="email" value="<?php echo $inputs['email'] ?? '' ?>" placeholder="info@example.com" class="email"></td>
            <td><small><?php echo $errors['email'] ?? '' ?></small></td>
        </tr>
        <tr>
            <td>内容</td>
            <td>
                <textarea name="message" id="message" rows="5" cols="50" placeholder="1000文字まで" class="message"><?php echo $inputs['message'] ?? '' ?></textarea>
            </td>
            <td><small><?php echo $errors['message'] ?? '' ?></small></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="確認する">
            </td>
        </tr>
    </table>
</form>