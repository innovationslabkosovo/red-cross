<?php
error_reporting(0);
include('init.php');

if (isset($_POST['municipality_id'])){
    $municipality_id = $_POST['municipality_id'];

    if ($query_result=mysql_query("select class_id , name from Class where location_id IN(SELECT l.location_id from Location l where l.municipality_id =$municipality_id) order by date_from"))
        echo create_options($query_result , 'class_id' , 'name');
    else
        echo "";
}

if (isset($_POST['class_id'])){
    $class_id = $_POST['class_id'];

    $get_participants ="SELECT p.participant_id, p.name, p.surname, p.gender FROM Participant p INNER JOIN ParticipantClass pc on p.participant_id=pc.participant_id
                                                                      INNER JOIN Class c on pc.class_id=c.class_id where c.class_id=$class_id";
    if ($query_result=mysql_query($get_participants))
    {
        $i=0;
        while ($row = mysql_fetch_assoc($query_result)) {
            $participant_rows[$i]['participant_id'] = $row['participant_id'];
            $participant_rows[$i]['name'] = $row['name'];
            $participant_rows[$i]['surname'] = $row['surname'];
            $participant_rows[$i]['gender'] = $row['gender'];
            $i++;
        }

        echo json_encode($participant_rows);

    }
    else
        echo "";
}

