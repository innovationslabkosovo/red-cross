<div class="login_view">
    <h2>Login</h2>
    <div>
        <form action="<?php echo BASE_URL; ?>/core/user/login.php" method="POST">
            <ul id="login">
                <li>
                    <label for="username"></label>
                    <input type="text" name="username" id="username" class="txfform-wrapper input" placeholder="Username">
                </li>
                <br>
                <li>
                    <label for="password"></label>
                    <input type="password" name="password" id="password" class="txfform-wrapper input" placeholder="Password">
                </li>
                <br>
                <li>
                    <input type="submit" value="Log in">
                </li>
            </ul>
        </form>
    </div>
</div>