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
                    <br><a href="<?php echo BASE_URL; ?>/views/user/public_forgot_view.php">Keni harruar fjalkalimin?</a>
                </li>
                <br>
                <li>
                    <input type="submit" value="Kycuni">
                </li>
            </ul>
        </form>
    </div>
</div>
