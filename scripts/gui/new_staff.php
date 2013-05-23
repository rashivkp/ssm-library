<?php 
if(isset($_POST['save']))
{
	$ob->new_staffs();
}
else if(isset($_POST['continue']))
{
	?>
	  <table width="536" border="0" cellpadding="5">
	    <tbody>
	    <form method="POST" action="">
	    <input type="hidden" name="count" value="<?=$_POST['no_std']?>" />
	    <input type="hidden" name="dpt" value="<?=$_POST['dpt']?>" />
	      <tr><th>Name</th><th>Unique ID</th><th>Type</th></tr>
	      <?php
	      for($i=0;$i<$_POST['no_std'];$i++)
	      {
			  ?>
	      <tr>	<td><input type="text" name="name[<?=$i?>]" id="name" /></td>
				<td><input type="text" name="reg[<?=$i?>]" id="reg" /></td>
				<td><select name="type[<?=$i?>]">
										<option value="tutor">Tutor</option>
										<option value="HOD">HOD</option>
									</select></td></tr>
	      <?php
	      }
	      ?>
	      <tr><td>&nbsp;</td><td><input type="submit" name="save" value="    Save    " /></td></tr>
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
	      <tr><td>number of staffs</td><td><input type="text" name="no_std" id="no_std" /></td></tr>
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
