/* Create an object. */
var obj = {

    /* AJAX - Appends select-drop-down of viti based on drejtimi selected. */
    changeMunicipality:  function() {
        /* Cache the variable this so it doesn't jump too pool everytime :p. */
        var $this = $(this);
        var municipality_id = $this.val();
		var dataString = 'municipality_id=' + municipality_id;

		$.ajax
		({
			type: "POST",
			url: "../core/return_class_report.php",
			data: dataString,
			cache: false,
			success: function (html) {
				$('#class_id')
				.find('option:gt(0)')
				.remove('')
				.end()
				.append(html);
			}
		});
    },
    /* AJAX - Appends select-drop-down of lenda based on drejtimi&viti selected. */
    changeClass: function() {
        /* Cache the variable this so it doesn't jump too pool everytime :p. */
        var $this = $(this);
        /* Get the exact value of Drejtimi selected from select-drop-down. */
        var municipality_id = $this.prev().val();
        var dataString = 'municipality_id='+municipality_id+'&class_id='+$this.val();

        /* Make the AJAX call based on what is selected. */
        $.ajax({
            // url: "http://77.81.240.20/shkolla/lenda/drejtimi_lenda/"+drejtimi+'/'+''+this.value,
            type: 'POST',
            url: "../core/return_class_report.php",
            type: 'POST',
            data: dataString,
            cache: false,
			success: function (html) {
				console.log(html);
				$('#questions')
				.find('option:gt(0)')
				.remove('')
				.end()
				.append(html);
			}
        });
    }
}

/* AJAX - Call changeDrejtimi. */
$('#municipality_id').change(obj.changeMunicipality);

/* AJAX - Call changeViti. */
$('#class_id').change(obj.changeClass);
