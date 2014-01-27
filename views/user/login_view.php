<div class="widget">
    <h2>Login</h2>
    <div class="inner">
        <form action="<?php echo BASE_URL; ?>/core/user/login.php" method="POST">
            <ul id="login">
                <li>
                    Username:<br>
                    <label for="username"></label>
                    <input type="text" name="username" id="username" class="txfform-wrapper input" placeholder="Username">
                </li>
                <li>
                    Password:<br>
                    <label for="password"></label>
                    <input type="password" name="password" id="password" class="txfform-wrapper input" placeholder="Password">
                </li>
                <li>
                    <input type="submit" value="Log in">
                </li>
            </ul>
        </form>
    </div>
</div>