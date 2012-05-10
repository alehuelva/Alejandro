<?php
namespace Mistakes\MistakesBundle\pruebas;

$xmlprojects = loadprojects();
$xmlerrors = loaderrors(10);
resetErrors($xmlprojects);
setErrors($xmlerrors);
setProjectname($xmlprojects);
$tempproj= getProjectname();
$temperror= getErrors();



echo '<table border="1">
<tr>
<th>name</th>
<th>number</th>
<th>cont</th>

</tr>';
foreach($temperror as $proj => $cont){
	echo '<tr>
	<td>' . $tempproj[(int)$proj] . '</td>
	<td>' . $proj . '</td>
	<td>' . $cont . '</td>

	</tr>';
}
echo '</table>';


