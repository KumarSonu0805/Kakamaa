<?= form_open('validatelogin/'); ?>
    <input type="text" name="username" id="username" required placeholder="Username">
    <input type="password" name="password" id="password" required placeholder="Password">
    <button type="submit" name="login">Login</button>
    <?= error_msg('logerr'); ?>
<?= form_close(); ?>