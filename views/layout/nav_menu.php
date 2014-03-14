<?php 
$user_id = $_SESSION['id'];
if (is_admin($user_id)): ?>
<ul id="nav">
    <li><a href="<?php echo BASE_URL; ?>/views/index.php">Ballina</a></li>
    <li><a href="javascript:void(0);">Menaxho te Dhenat</a>
        <ul>
            <li><a href="javascript:void(0);">Menaxho Kurset</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_class.php">Krijo Kurs te ri</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_class.php">Listo Kurset</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Menaxho Pjesemarresit</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_participant.php">Shto Pjesemarresit</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_participant.php">Listo Pjesemarresit</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/find_participant.php">Shto pergjegje per pjesemarresit</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Menaxho Grupet Tematike</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_topic_group.php">Krijo Grup Tematik</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_topic_groups.php">Listo Grupet Tematike</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Menaxho Temat</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_topic.php">Krijo Teme te Re</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_topics.php">Listo Temat</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Menaxho Pyetjet</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_question.php">Krijo Pyetje</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_question.php">Listo Pyetjet</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Menaxho Testet</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_test.php">Krijo Test</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_tests.php">Listo Testet</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);">Menaxho Kategorite</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_category.php">Krijo Kategori te Re</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_category.php">Listo Kategorite</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);">Menaxho Trajneret</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_trainer.php">Krijo Trajner te Ri</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_trainer.php">Listo Trajneret</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/create_evaluation.php">Performanca e Trajnerit</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);">Menaxho Supervizoret</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_supervisor.php">Krijo Supervizor te Ri</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_supervisor.php">Listo Supervizoret</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="<?php echo BASE_URL; ?>/views/reports.php">Raportet</a></li>
    <li><a href="<?php echo BASE_URL; ?>/views/create_location.php">Lokacionet</a></li>
</ul>
<?php else: ?>
<ul id="nav">
    <li><a href="<?php echo BASE_URL; ?>/views/index.php">Ballina</a></li>
    <li><a href="javascript:void(0);">Menaxho te Dhenat</a>
        <ul>
            <li><a href="javascript:void(0);">Menaxho Kurset</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_class.php">Krijo Kurs te ri</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_class.php">Listo Kurset</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Menaxho Pjesemarresit</a>
                <ul class="third_level">
                    <li><a href="<?php echo BASE_URL; ?>/views/create_participant.php">Shto Pjesemarresit</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/list_participant.php">Listo Pjesemarresit</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/find_participant.php">Shto pergjegje per pjesemarresit</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Menaxho Grupet Tematike</a>
                <ul class="third_level">
                    <!-- <li><a href="<?php // echo BASE_URL; ?>/views/create_topic_group.php">Krijo Grup Tematik</a></li> -->
                    <li><a href="<?php echo BASE_URL; ?>/views/list_topic_groups.php">Listo Grupet Tematike</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Menaxho Temat</a>
                <ul class="third_level">
                    <!-- <li><a href="<?php // echo BASE_URL; ?>/views/create_topic.php">Krijo Teme te Re</a></li> -->
                    <li><a href="<?php echo BASE_URL; ?>/views/list_topics.php">Listo Temat</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Menaxho Pyetjet</a>
                <ul class="third_level">
                    <!-- <li><a href="<?php // echo BASE_URL; ?>/views/create_question.php">Krijo Pyetje</a></li> -->
                    <li><a href="<?php echo BASE_URL; ?>/views/list_question.php">Listo Pyetjet</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Menaxho Testet</a>
                <ul class="third_level">
                    <!-- <li><a href="<?php // echo BASE_URL; ?>/views/create_test.php">Krijo Test</a></li> -->
                    <li><a href="<?php echo BASE_URL; ?>/views/list_tests.php">Listo Testet</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);">Menaxho Kategorite</a>
                <ul class="third_level">
                    <!-- <li><a href="<?php // echo BASE_URL; ?>/views/create_category.php">Krijo Kategori te Re</a></li> -->
                    <li><a href="<?php echo BASE_URL; ?>/views/list_category.php">Listo Kategorite</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);">Menaxho Trajneret</a>
                <ul class="third_level">
                    <!-- <li><a href="<?php // echo BASE_URL; ?>/views/create_trainer.php">Krijo Trajner te Ri</a></li> -->
                    <li><a href="<?php echo BASE_URL; ?>/views/list_trainer.php">Listo Trajneret</a></li>
                    <!-- <li><a href="<?php // echo BASE_URL; ?>/views/create_evaluation.php">Performanca e Trajnerit</a></li> -->
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);">Menaxho Supervizoret</a>
                <ul class="third_level">
                    <!-- <li><a href="<?php // echo BASE_URL; ?>/views/create_supervisor.php">Krijo Supervizor te Ri</a></li> -->
                    <li><a href="<?php echo BASE_URL; ?>/views/list_supervisor.php">Listo Supervizoret</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="<?php echo BASE_URL; ?>/views/reports.php">Raportet</a></li>
    <li><a href="<?php echo BASE_URL; ?>/views/create_location.php">Lokacionet</a></li>
</ul>
<?php endif; ?>



    <?php
    	if (logged_in() == false)
    	{
    		$base_url = BASE_URL;
    		echo "<a href='$base_url/views/user/login_user.php' style='float:right;'>Kycuni</a>";
	
    	}
    ?>
