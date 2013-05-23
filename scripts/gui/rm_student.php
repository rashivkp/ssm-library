
<?php 
if(isset($_POST['remove']))
{
	$f=false;
	for($i=0;$i<$_POST['count'];$i++)
	{
		if(isset($_POST['del'][$i]))
			{
				$f=true;
				$ob->remove_student($_POST['del'][$i]);
			}
	}
	if($f)
	echo "<div class='error'>Removed..!</div>";	
	else
	echo "<div class='error'>Please select before removing..!</div>";	
	
}
else if(isset($_POST['edit']))
{
	$f=false;
	for($i=0;$i<@$_POST['count'];$i++)
	{
		if(isset($_POST['del'][$i]))
		{
			$f=true;	
			$ob->save_changes_student($i);
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
	      <?php
	     	  $ob->get_students();

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
	      <tr><td>Semester</td><td>
									<select name="sem">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								</td></tr>
	      <tr><td>&nbsp;</td><td><input type="submit" name="continue" value="    continue    " /></td></tr>
	     </form>
	    </tbody>
	   </table>
<?php
}
?>
