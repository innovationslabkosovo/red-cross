
$(document).ready(function(){
 
    var counter = 1;
	var text = counter +1;
	
 
    $("#addButton").click(function () {
		
		
 
		if(text>30){
	            alert("Vetem 30 fusha lejohen");
	            return false;
		}   
	 
 	
 
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + text);		//text sepse u fshijke divi gabim div2 para div1 
	
	newTextBoxDiv.after().html('<label><strong>Pyetja #'+ text + ' :</strong> </label><br>' +
	      '<input type="text" name="question[]" id="q'+ counter + '" value="" class="txfform-wrapper input" data-validation="required"> <br> <label>Pergjigjja A : </label><br>' +
	      '<input type="text" name="answer[q'+ counter + '][]" id="a'+ counter + '" value="" class="txfform-wrapper input" data-validation="required"> ' +
		  '<input type="hidden" name="check[c'+ counter +'][a1]" value="0"><br>' 
		  // '<input type="checkbox" name="check[c'+ counter +'][a1]" value="1"><br>'
		  
		  
		  + '<label> Pergjigjja B : </label><br>' +
	      '<input type="text" name="answer[q'+ counter + '][]" id="a'+ counter + '" value="" class="txfform-wrapper input">' +
		  '<input type="hidden" name="check[c'+ counter +'][a2]" value="0"><br>' 
		  // '<input type="checkbox" name="check[c'+ counter +'][a2]" value="1"><br>'
		  
		  
		  + '<label> Pergjigjja C : </label><br>' +
	      '<input type="text" name="answer[q'+ counter + '][]" id="a'+ counter + '" value="" class="txfform-wrapper input">' +
		  '<input type="hidden" name="check[c'+ counter +'][a3]" value="0"><br>' 
		  // '<input type="checkbox" name="check[c'+ counter +'][a3]" value="1"><br>'
		  

		  
		  + '<label> Pergjigjja D : </label><br>' +
	      '<input type="text" name="answer[q'+ counter + '][]" id="a'+ counter + '" value="" class="txfform-wrapper input">' +
		  '<input type="hidden" name="check[c'+ counter +'][a4]" value="0"><br>' 
		  // '<input type="checkbox" name="check[c'+ counter +'][a4]" value="1"><br>'
		  	
		  
		  
		  + '<label> Pergjigjja E : </label><br>' +
	      '<input type="text" name="answer[q'+ counter + '][]" id="a'+ counter + '" value="" class="txfform-wrapper input">' +
		  '<input type="hidden" name="check[c'+ counter +'][a5]" value="0"><br>'		  


		  + '<label> Pergjigjja F : </label><br>' +
	      '<input type="text" name="answer[q'+ counter + '][]" id="a'+ counter + '" value="" class="txfform-wrapper input">' +
		  '<input type="hidden" name="check[c'+ counter +'][a6]" value="0"><br>'

		  + '<label> Pergjigjja G : </label><br>' +
	      '<input type="text" name="answer[q'+ counter + '][]" id="a'+ counter + '" value="" class="txfform-wrapper input">' +
		  '<input type="hidden" name="check[c'+ counter +'][a7]" value="0"><br>');
		  // '<input type="checkbox" name="check[c'+ counter +'][a5]" value="1"><br>');
		  
 
	newTextBoxDiv.appendTo("#TextBox");
	
 
	counter++;
	text++;
     });
 
     $("#removeButton").click(function () {
	if(text==1){
          alert("Nuk ka me fusha per te fshire");
          return false;
       }   
 
	counter--;
	text--;
	
        $("#TextBoxDiv" + text).remove();
 
     });
 
  });