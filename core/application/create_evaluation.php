<?php
include '../../config/config.php';

if(empty($_POST) === false)
{

    if(isset($_POST['date']) && $_POST['date'] != "" &&
        isset($_POST['time_from']) && $_POST['time_from'] != "" &&
        isset($_POST['time_to']) && $_POST['time_to'] != "" &&
        isset($_POST['participant']) && $_POST['participant'] != "" &&
        isset($_POST['age_group']) && $_POST['age_group'] != "" &&
        isset($_POST['gender']) && $_POST['gender'] != "" &&
        isset($_POST['trainer']) && $_POST['trainer'] != "" &&
        isset($_POST['supervisor']) && $_POST['supervisor'] != "" &&
        isset($_POST['location']) && $_POST['location'] != "" &&
        isset($_POST['place']) && $_POST['place'] != "" &&
        isset($_POST['notes']) && $_POST['notes'] != "")

    {
        print_r($_POST);

        $date = $_POST['date'];
        $time_from = $_POST['time_from'];
        $time_to = $_POST['time_to'];
        $participant = $_POST['participant'];
        $age_group = $_POST['age_group'];
        $gender = $_POST['gender'];
        $trainer = $_POST['trainer'];
        $supervisor = $_POST['supervisor'];
        $location = $_POST['location'];
        $place = $_POST['place'];
        $notes = $_POST['notes'];


    if (mysql_query("INSERT INTO Evaluation(evaluation_id, date, time_from, time_to, participants, age_group, gender, trainer_id, supervisor_id, location_id, location, notes)
                            values ('', '$date', '$time_from', '$time_to', '$participant', '$age_group', '$gender', $trainer, $supervisor, $location, '$place', '$notes')")){
        echo "nice";
    }

        else {

            echo "cannot enter";
        }

    }
}


