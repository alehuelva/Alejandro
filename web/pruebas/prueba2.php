<?php
$page = array_key_exists('page', $_GET) ? $_GET['page'] : 1;
$xml = new SimpleXMLElement("http://kunstmaan.airbrake.io/errors.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff&page=" . $page, null, true);
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