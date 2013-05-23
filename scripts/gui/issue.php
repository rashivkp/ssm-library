<?php 
if(isset($_POST['issue']))
{
	if(@$_POST['reg_id']!="" && @$_POST['bk_id']!="")
	{
		?>
		<form action="" method="POST">
		<input type="hidden" value="<?=$_POST['reg_id']?>" name="reg_id" />
		<input type="hidden" value="<?=$_POST['bk_id']?>" name="bk_id" />
		<?php
		if(!$msg=$ob->confirm_issue())
		{
		?>
		<input type="submit" value="Confirm" name="confirm" />
		<input type="submit" value="Back" name="not_confirm" />
		<?php
		}
		else
		{
			foreach($msg as $item)
			echo "<br />".$item;
		}
		echo '</form>';
		
	}
	
}
else if(isset($_POST['confirm']))
{
	$ob->issue();
	
}
if(!isset($_POST['issue']))
{
?>
<form action="./?id=1" method="POST">
  <table width="350" border="0" cellpadding="3">
	  <tr>
	    <td width="200">User Register No.</td>
	    <td width="150"><input type="text" name="reg_id" id="reg_id" /></td>
    </tr>
	  <tr>
	    <td>Book Old No.</td>
	    <td><input type="text" name="bk_id" id="bk_id" /></td>
    </tr>
	  <tr>
	    <td colspan="2" align="center"><input type="submit" value="Continue" name="issue" /></td>
    </tr>
  </table>
</form>

<?php
}
?>
