 /*
function some_function(arg1, arg2) {

	    var my_number = (arg1 - arg2) + arg2);
	    // then we're done, so we'll call the callback and
    // pass our result
    return my_number;
	}
*/
//document.getElementById('demo').innerHTML= some_function(5, 15);

alert("Un mensaje de prueba")
function changeText(){
	document.getElementById('demo').innerHTML = 'Fred Flinstone';
}





//TWIG SCRIPTS

{% block body %} 

{# var prueba=new Array();
 prueba = {{ charts2['v']|e }};
patron = " ";
 prueba=prueba.replace(patron,'');
document.writeln(prueba)
#}
<script>

projectArray = new Array();
 {% for key, charts2 in charts['0']['rows']  %}
projectArray['{{key}}'] = "{{charts2['c']['0']['v']|e }}";
document.writeln(projectArray['{{key}}']);
 {% endfor %}


</script>

{% for key, charts2 in charts['0']['rows']  %}

{{ key }} -- {{charts2['c']['0']['v']|e }}

{# Colum number and associated projectname#}


{% endfor %}



<script>

function ChartCallBackHandlerchart2() {
	//var str = datachart2.getRowProperties(chartchart2.getSelection()[0].row)
    //var str = datachart2.getValue(chartchart2.getSelection()[0].row, chartchart2.getSelection()[0].column);
	//alert('Hey! Callbackhandler! Bar ' + chartchart2.getSelection()[0].row);
		//var str = datachart2.getValue(chartchart2.getSelection()[0].row, chartchart2.getSelection()[0].column);
		
		//select = datachart2.getValue(chartchart2.getSelection()[0].row, chartchart2.getSelection()[0].column);
		
		selectrow = chartchart2.getSelection()[0].row

		alert(projectArray['selectrow']);

		
		alert('Hey! Callbackhandler!  ' + selectrow); // + chartchart2.getSelection()[0].column + '----' + str);


		 alert('{{ charts['0']['rows'] }}[select]')
	
}



$(function() {
{{ gchart_column_chart(charts[0], 'chart2', 800, 500, 'vertical') }}

});






/*PARA QUE SELECCIONE Y LINK
            function selectHandler(project) {
            	var selectedItem = chart.getSelection()[0];
            	if (selectedItem) {
            		var topping = data.getValue(selectedItem.row, 0);
            		window.open('http://kunstmaan.airbrake.io/projects/' + project + '/deploys.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff' , '_blank');
            	}
            }



            function drawVisualization() {
            	  visualization = new google.visualization.Table(document.getElementById('table'));
            	  visualization.draw(data, null);

            	  // Add our selection handler.
            	  google.visualization.events.addListener(visualization, 'select', selectHandler);
            	}

            	// The selection handler.
            	// Loop through all items in the selection and concatenate
            	// a single message from all of them.
            	function selectHandler() {
            	  var selection = visualization.getSelection();
            	  var message = 'prazratat';
            	 
            	  alert('You selected ' + message);
            	}