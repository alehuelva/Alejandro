<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          vAxis: {title: 'Year',  titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        google.visualization.events.addListener(chart, 'select', selectHandler);
        }


      

      function selectHandler() {
        alert('A table row was selected');
      }

      

     // function selectHandler() {
    	//   	 var selectedItem = chart.getSelection()[0];
    	 	//   if (selectedItem) {
    	    	      
    	   	   //	window.open('http://kunstmaan.airbrake.io/projects/11/deploys.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff' , 'new');
    	  	  //  }
    	 //    }
      

// Add our selection handler.


// The selection handler.
// Loop through all items in the selection and concatenate
// a single message from all of them.
function selectHandler() {

	  window.open('http://kunstmaan.airbrake.io/projects/11/deploys.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff' , 'new');
}
    	 
      
      
    </script>
  </head>

  <body>
<!--Div that will hold the pie chart-->
    <div id="chart_div" style="width:400; height:300"></div>
  </body>
</html>








<?php

echo '<table border="1">
<tr>
<th>action</th>
<th>controller</th>
<th>created-at</th>
<th>error-message</th>
<th>file</th>
<th>line-number</th>
</tr>';
foreach($xml->group as $v){
	echo '<tr>
	<td>' . $v->action . '</td>
	<td>' . $v->controller . '</td>
	<td>' . $v->{'created-at'} . '</td>
	<td>' . $v->{'error-message'} . '</td>
	<td>' . $v->file . '</td>
	<td>' . $v->{'line-number'} . '</td>
	</tr>';
}
echo '</table>';
?>


