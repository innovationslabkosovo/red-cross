<?php
include '../../config/config.php';

if(empty($_POST) === false)
{

    if(isset($_POST['date']) &&
        isset($_POST['time_from']) &&
        isset($_POST['time_to']) &&
        isset($_POST['participants']) &&
        isset($_POST['age_group']) &&
        isset($_POST['gender']) &&
        isset($_POST['trainer']) &&
        isset($_POST['supervisor']) &&
        isset($_POST['location']) &&
        isset($_POST['place']) &&
        isset($_POST['notes']))

    {
        $date = $_POST['date'];
        $time_from = $_POST['time_from'];
        $time_to = $_POST['time_to'];
        $participant = trim($_POST['participants']);
        $age_group = trim($_POST['age_group']);
        $gender = $_POST['gender'];
        $trainer = trim($_POST['trainer']);
        $supervisor = trim($_POST['supervisor']);
        $location = trim($_POST['location']);
        $place = trim($_POST['place']);
        $notes = trim($_POST['notes']);
        $categories = trim($_POST['category']);
        $categories_db = mysql_query("SELECT category_id FROM Category");

        if (mysql_query("INSERT INTO Evaluation(evaluation_id, date, time_from, time_to, participants, age_group, gender, trainer_id, supervisor_id, location_id, location, notes)
                            values ('', '$date', '$time_from', '$time_to', '$participant', '$age_group', '$gender', $trainer, $supervisor, $location, '$place', '$notes')")){

            $evaluation_id = mysql_insert_id();

            while($data_cat = mysql_fetch_assoc($categories_db)) {

                if (in_array($data_cat[category_id], $categories)){

                    if (mysql_query("INSERT INTO EvaluationCategory(evaluation_id, category_id, evaluation) values ($evaluation_id, $data_cat[category_id], '1')")){

                        header("location: ../../views/list_trainer.php?message=success&object=Evaluation");
                    }

                } else {

                    if (mysql_query("INSERT INTO EvaluationCategory(evaluation_id, category_id, evaluation) values ($evaluation_id, $data_cat[category_id], '0')")){

                        header("location: ../../views/list_trainer.php?message=success&object=Evaluation");
                    }

                }

            }
        }

        else {

            header("location: ../../views/list_trainer.php?message=fail&object=Evaluation");
        }

    }

    else {

        header("location: ../../views/create_evaluation.php?message=fail&object=Evaluation");
    }
}


