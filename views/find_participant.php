<?php
$page_title = "Shto pergjegje per participantet";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';

$user_id = $_SESSION['id'];

if (is_admin($user_id))
    $mun_qs = "SELECT m.municipality_id, m.name FROM Municipality m";
else
    $mun_qs = "SELECT m.municipality_id, m.name FROM Municipality m INNER JOIN User u on m.municipality_id=u.municipality_id where user_id=$user_id ";

$get_municipalities = $mun_qs;
$municipalities = mysql_query($get_municipalities);
?>
<h1>Participantet sipas klasave</h1>

<div class="row">
    <label>Komuna : </label>
    <div class="dropdown">

        <select id="municipality_id" class="dropdown-select" name="municipality" >
            <option value="">--Zgjedh Komunen--</option>
            <?php
            create_options($municipalities, "municipality_id", "name");
            ?>
        </select>
    </div>
    <label>Klasa : </label>
    <div class="dropdown">

        <select id="class_id" class="dropdown-select" name="class" >
            <option value="">--Zgjedh Klasen--</option>

        </select><br>
    </div>
    </div>
<br>
<div class="row">

    <table id="participants" class="bordered" style="display: none">
        <tr>
            <th >Emri</th>
            <th >Mbiemri</th>
            <th >Gjinia</th>
            <th >Shto Pergjegje</th>
        </tr>
    </table>

</div>
<br>
<div class="row">
   <p id="empty_result" style="display: none"></p>
</div>



<script>
    $.validate({
        modules: 'date',
        validateOnBlur: false, // disable validation when input looses focus
        errorMessagePosition: 'top',// Instead of 'element' which is default
//            borderColorOnError : 'red',
        addValidClassOnAll : true
    });

    $("#municipality_id").change(function () {

        var mun_val = $(this).val();
        var dataString = 'municipality_id='+mun_val;

        $.ajax
        ({
            type: "POST",
            url: "../core/return_munic_classes.php",
            data: dataString,
            cache: false,
            success: function (html) {
                $('#class_id')
                    .find('option:gt(0)')
                    .remove('')
                    .end()
                    .append(html)
                ;
            }
        });

    });

    $("#class_id").change(function () {

        var class_val = $(this).val();
        var dataString = 'class_id='+class_val;
        $('#participants').find("tr:gt(0)").remove();

        $.ajax
        ({
            type: "POST",
            url: "../core/return_munic_classes.php",
            data: {'class_id':class_val},
            cache: false,
            dataType:'json',
            success: function (data) {
                $('#participants').show();
                jQuery.each(data, function(i, val) {

                    $('#participants tr:last').after('<tr><td>'+val['name']+'</td><td>'+val['surname']+'</td><td>'+val['gender']+'</td><td><a href="participant_answer.php?p_id='+val['participant_id']+'">Shto Pergjegje</a></td></tr>');


                });
            },
            error:function(){
                $('#participants').hide();
                $('#empty_result').show();

            }
        });

    });


</script>
<?php include $project_root . 'views/layout/footer.php'; ?>
