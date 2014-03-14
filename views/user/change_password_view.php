<?php
/**
 * Created by PhpStorm.
 * User: lulzim
 * Date: 11/23/13
 * Time: 10:25 PM
 */

include '../../core/init.php';
$page_title = 'Ndrysho Fjalkalimin';
protect_page();
include $project_root . '/views/layout/header.php';
?>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>/js/form_validate.js"></script>

    <h1>Ndryshoni Fjalekalimin!</h1>

    <form name="change_password" id="change_password" action="<?php echo BASE_URL; ?>/core/user/change_password.php"
          method="post">
        <ul>
            <li>
                <label for="current_password">Fjalkalimi i tanishem <span class="required">*</span></label><br>
                <input type="password" name="current_password" id="current_password" class="txfform-wrapper input">
            </li>
            <li>
                <label for="password">Fjalkalimi i ri <span class="required">*</span></label><br>
                <input type="password" name="password" id="password" class="txfform-wrapper input">
            </li>
            <li>
                <label for="password_again">Konfirmo fjalekalimin e ri <span class="required">*</span></label><br>
                <input type="password" name="password_again" id="password_again" class="txfform-wrapper input">
            </li>
            <li>
                <input type="submit" value="Ndrysho">
            </li>
        </ul>
    </form>
    <div id="message"></div>
<?php

if (isset($_GET['message']) && isset($_GET['object'])) {
    echo $display_messages[$_GET['object']][$_GET['message']];
}

include $project_root . '/views/layout/footer.php';

?>