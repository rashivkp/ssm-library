<?php
if(isset($_POST['nlc'])&&$_POST['reg']!="")
{
		$ob->nlc($_POST['reg']);
	
}
else
{
	?>
		<table width="500" border="0" cellpadding="5">
		<tbody>
		<form action="" method="POST">
			<tr><td>Register No.</td><td><input type="text" name="reg" /></td></tr>
			<tr><td colspan="2"><input type="submit" name="nlc" /></td></tr>			
		</form>
		</tbody>
		</table>

	<?php
}
?>
