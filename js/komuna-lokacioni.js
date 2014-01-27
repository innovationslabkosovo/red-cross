$(function(){
  $("select#municipality").change(function(){
	$.getJSON("select.php",{municipality: $(this).val(), ajax: 'true'}, function(j){
	  var options = '';
	  for (var i = 0; i < j.length; i++) {
		options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
	  }
	  $("select#location").html(options);
	})
  })


})