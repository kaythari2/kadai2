<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    名前 <input type="text" name="name" id="name" 
    value="<?php echo $inputs['name'] ?? '' ?>" placeholder="Dummy Name"
    class="<?php echo isset($errors['name']) ? 'error' : ''  ?>"><br>

    E-mail <input type="text" name="email" id="email"
    value="<?php echo $inputs['email'] ?? '' ?>" placeholder="info@example.com"
    class="<?php echo isset($errors['name']) ? 'error' : ''  ?>"><br>

    内容 <input type="text" name="message" id="message"
    value="<?php echo $inputs['message'] ?? '' ?>" placeholder="1000文字まで"
    class="<?php echo isset($errors['name']) ? 'error' : ''  ?>"><br>
    
    <input type="submit" value="確認する">
</form>