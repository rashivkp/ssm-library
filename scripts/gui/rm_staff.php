<?php 
if(isset($_POST['remove']))
{
	for($i=0;$i<$_POST['count'];$i++)
	{
		if(isset($_POST['del'][$i]))
			$ob->remove_staff($_POST['del'][$i]);
	} echo "<div class='error'>Removed</div>";
}
else if(isset($_POST['edit']))
{
	$f=false;
	for($i=0;$i<$_POST['count'];$i++)
	{
		if(isset($_POST['del'][$i]))
		{
			$f=true;
			$ob->save_changes_staff($i);
		}
	}
	if($f)
	echo "<div class='error'>changes saved..!</div>";	
	else
	echo "<div class='error'>Please select before saving your changes..!</div>";	
	
}
else if(isset($_POST['continue']))
{
	?>
	  <table width="536" border="0" cellpadding="5">
	    <tbody>
	    <form method="POST" action="">
	    <input type="hidden" name="dpt" value="<?=$_POST['dpt']?>" />
	      <tr><th>Name</th><th>Unique ID</th><th>Type</th></tr>
	      <?php
	      $ob->get_staffs();
	      ?>
	      <tr><td>&nbsp;</td><td><input type="submit" name="remove" value="    Remove Selected   " /></td></tr>
	      <tr><td>&nbsp;</td><td><input type="submit" name="edit" value="    Save Changes of Selected   " /></td></tr>
	     </form>
	    </tbody>
	   </table>
	   <?php
}

if(!isset($_POST['continue']))
{
?>
	  <table width="536" border="0" cellpadding="5">
	    <tbody>
	    <form method="POST" action="">
	      <tr><td>Department</td><td>
									<select name="dpt">
										<?php
										$dpt=$ob->get_dpt();
										while($row=$dpt->fetch_assoc())
										{
											echo "<option value='".$row['id']."'>".$row['caption']."</option>";
										}
										?>
									</select>
								</td></tr>	      
	      <tr><td>&nbsp;</td><td><input type="submit" name="continue" value="    continue    " /></td></tr>
	     </form>
	    </tbody>
	   </table>
<?php
}
?>
