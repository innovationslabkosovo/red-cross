/* Create an object. */
var obj = {

    /* AJAX - Appends select-drop-down of viti based on drejtimi selected. */
    changeMunicipality:  function() {
        /* Cache the variable this so it doesn't jump too pool everytime :p. */
        var $this = $(this);
        var municipality_id = $this.val();
		var dataString = 'mun_id=' + municipality_id;

		$.ajax
		({
			type: "GET",
			url: "../core/return_class_report.php",
			data: dataString,
			cache: false,
			success: function (html) {
				$('.class_id')
				.find('option:gt(0)')
				.remove('')
				.end()
				.append(html);
			}
		});
    }
}

/* AJAX - Call changeDrejtimi. */
$('.municipality_id').change(obj.changeMunicipality);

/* AJAX - Call changeViti. */
//$('#class_id').change(obj.changeClass);
