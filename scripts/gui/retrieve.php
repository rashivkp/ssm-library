<?php 
if(isset($_POST['retrieve']))
{
	if(@$_POST['bk_id']!="")
	{
		?>
		<form action="" method="POST">
		<input type="hidden" value="<?=$_POST['bk_id']?>" name="bk_id" />
		<?php
		if(!$msg=$ob->confirm_retrieve())
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
	$ob->retrieve();
	
}
if(!isset($_POST['retrieve']))
{
?>
<form action="./?id=2" method="POST">
  <table width="300" border="0" cellpadding="3">
	  <tr>
	    <td>Book Old No. </td>
	    <td><input type="text" name="bk_id" id="bk_id" /></td>
    </tr>
	  <tr>
	    <td colspan="2" align="center"><input type="submit" name="retrieve" value="RETRIEVE" /></td>
    </tr>
  </table>
</form>

<?php
}
?>
