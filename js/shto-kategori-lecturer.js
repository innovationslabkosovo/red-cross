$(document).ready(function(){
 
    var counter = 2;
 
    $("#addButton").click(function () {
 
	if(counter>10){
            alert("Nuk lejohen me shume se 10 kategori per nje person");
            return false;
	}   
 
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
 
	newTextBoxDiv.after().html('<label>Category #'+ counter + ' : </label>' + '<select name="category' + counter + '" id="textbox' + counter + '"><?php while($row = mysql_fetch_array($result2)){ $rows[] = $row; echo '<option value='.$row['id'].' >'.$row['name'].' </option>'; } ?></select>');
 
	newTextBoxDiv.appendTo("#TextBoxesGroup");
 
	counter++;
     });
 
     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
 
	counter--;
 
        $("#TextBoxDiv" + counter).remove();
 
     });
  });