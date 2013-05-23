<body>
<?php 
if(isset($_POST['save']))
{
	$ob->new_students();
}
else if(isset($_POST['continue']))
{
	?>
	  <table width="536" border="0" cellpadding="5">
	    <tbody>
	    <form method="POST" action="">
	    <input type="hidden" name="count" value="<?=$_POST['no_std']?>" />
	    <input type="hidden" name="dpt" value="<?=$_POST['dpt']?>" />
	    <input type="hidden" name="sem" value="<?=$_POST['sem']?>" />
	      <tr><th>Name</th><th>Register No.</th><th>Roll No.</th><th>Admission No.</th></tr>
	      <?php
	      for($i=0;$i<$_POST['no_std'];$i++)
	      {
			  ?>
	      <tr>	<td><input type="text" name="name[<?=$i?>]" id="name" /></td>
				<td><input type="text" name="reg[<?=$i?>]" id="reg" /></td>
				<td><input type="text" name="roll[<?=$i?>]" id="roll" /></td>
				<td><input type="text" name="adm[<?=$i?>]" id="adm" /></td></tr>
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
	      <tr><td>number of students</td><td><input type="text" name="no_std" id="no_std" /></td></tr>
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
