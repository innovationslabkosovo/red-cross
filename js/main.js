/**
 * Created by visar on 11/21/13.
 */
jQuery(function($){
    $.datepicker.regional['sq'] = {
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janar', 'Shkurt', 'Mars', 'Prill', 'Maj', 'Qershor',
            'Korrik', 'Gusht', 'Shtator', 'Tetor', 'Nentor', 'Dhjetor'],
        monthNamesShort: ['Jan', 'Shkurt', 'Mars', 'Prill', 'Maj', 'Qer',
            'Korr', 'Gusht', 'Shta', 'Tet', 'Nen', 'Dhje'],
        dayNames: ['Diell', 'Hene', 'Marte', 'Merkure', 'Enjte', 'Premte', 'Shtune'],
        dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
        dayNamesMin: ['D','H','Ma','Me','E','P','S'],
        weekHeader: 'Sem.',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['sq']);
});



$(function () {
    $(".datefrom, .dateto, .date_topic, .date").datepicker({dateFormat: 'yy-mm-dd' }, $.datepicker.regional[ "sq" ]);
    $(".time_topic, .time_from, .time_to").timepicker();
});

$(document).ready(function () {
    // Start General Edit Function
    $(".edit").on("click", function () {
        var ID = $(this).attr('id');
        var td = $("td");
        // span = results_
        td.find("#results_" + ID).hide();
        td.find(".editbox_" + ID).show();
        $(".save_"+ID+", .cancel_"+ID+"").attr("style", "display: inline;");
        $(this).addClass("hide");
    });

    $(".save").click(function () {
        var ID = $(this).attr("id");
        var td = $("td");
        // var fileUrl = $("#url").attr("url");
        var fileUrl = $('form#url').attr('action');
        var dataString = td.find(".editbox_" + ID).serializeArray();
        if($('td').hasClass('has-error')) {
            return false;
        }
        $.ajax({
            type: "POST",
            url: fileUrl,
            data: dataString,
            cache: false,
            dataType: "json",
            success: function (data) {
                $.each(data,function(key, val) {
                    if($.isArray(val)) {
                        $.each(val, function(k, v) {
                            console.log(k);
                            console.log(v);
                            $("[name="+key+"\\[\\]][class~=editbox_"+ID+"][history="+k+"]").prev("#results_"+ID).html(v);
                            $("[name="+key+"\\[\\]][class~=editbox_"+ID+"][history="+k+"]").attr("value", v);
                        });
                    }
                    // console.log(val);
                    $("[name="+key+"]").prev("#results_"+ID).html(val);
                    });
                    $(".editbox_"+ID+", .save_"+ID+",.cancel_"+ID+"").hide();
                    td.find("#results_"+ID+"").show();
                    $(".edit_"+ID+"").removeClass("hide");
            }
        });
    });

    $(".editbox").mouseup(function () {
        return false;
    });

    $(".cancel").click(function () {
        var td = $("td");
        var ID = $(this).attr("id");
        td.find("#results_" + ID).show();
        td.find(".editbox_" + ID).hide();
        $(".save_"+ID+"").hide();
        $(".edit_"+ID).removeClass("hide");
        $(this).hide();
    });
    // End General Edit Function

    // Add active class to the menu
    $('#nav li a').each(function (){
        var path = location.pathname.split("/").pop(-1);
        var current_page = $(this).attr("href").split("/").pop(-1);
        if(path == current_page) {
            $(this).addClass('active').siblings().removeClass('active');
        }
    });

  var myLanguage = {
      errorTitle : '',
      requiredFields : 'Nuk jeni zgjedhur/pergjigjur te gjitha pyetjeve te detyrueshme',
      badTime : 'Ju nuk keni plotesuar kohen ne formatin e duhur',
      badEmail : 'Ju nuk keni plotesuar adresen elektronike ne formatin e duhur',
      badTelephone : 'Ju nuk keni plotesuar telefonin ne formatin e duhur',
      badSecurityAnswer : 'Ju nuk keni dhene pergjigje te sakte ne pyetjen per siguri',
      badDate : 'Ju nuk keni plotesuar daten ne formatin e duhur',
      lengthBadStart : 'Ju duhet te jepni nje pergjigje ne mes ',
      lengthBadEnd : ' karaktereve',
      lengthTooLongStart : 'Ju nuk keni dhene nje pergjigje me te gjate se ',
      lengthTooShortStart : 'Ju nuk keni dhene nje pergjigje me te shkurte se ',
      notConfirmed : 'Vlerat nuk mund te konfirmohen',
      badDomain : 'Vlere e gabuar e domenit',
      badUrl : 'Pergjigja qe ju keni dhene nuk eshte URL i sakte',
      badCustomVal : 'Ju keni dhene nje pergjigje te pasakte',
      badInt : 'Pergjigja qe ju keni dhene nuk eshte numer i sakte',
      badSecurityNumber : 'Your social security number was incorrect',
      badUKVatAnswer : 'Incorrect UK VAT Number',
      badStrength : 'Fjalekalimi nuk eshte mjaftushem i sigurte',
      badNumberOfSelectedOptionsStart : 'Ju duhet te zgjedhni se paku ',
      badNumberOfSelectedOptionsEnd : ' pergjigje',
      badAlphaNumeric : 'Pergjigja qe ju keni dhene duhet te kete vetem karaktere alfanumerike ',
      badAlphaNumericExtra: ' dhe ',
      wrongFileSize : 'The file you are trying to upload is too large',
      wrongFileType : 'The file you are trying to upload is of wrong type',
      groupCheckedRangeStart : 'Ju lutemi zgjedhni ne mes ',
      groupCheckedTooFewStart : 'Ju lutemi zgjedhni se paku ',
      groupCheckedTooManyStart : 'Ju lutemi zgjedhni me se shumti ',
      groupCheckedEnd : ' kategori'
    };


    $.validate({
        language : myLanguage,
        modules: 'date',
        validateOnBlur: true, // disable validation when input looses focus
        errorMessagePosition: 'top',// Instead of 'element' which is default
        // borderColorOnError : 'red',
        addValidClassOnAll : true,
        scrollToTopOnError : false

    });

});
