
<?php 
if(isset($_POST['new_sem']))
{
	$ob->new_sem();
}
else if(isset($_POST['continue_all']))
{
	$ob->new_sem_all_dpt();
}
else if(isset($_POST['continue']))
{
	?>
	  <table width="536" border="0" cellpadding="5">
	    <tbody>
	    <form method="POST" action="">
	    <input type="hidden" name="dpt" value="<?=$_POST['dpt']?>" />
	    <input type="hidden" name="sem" value="<?=$_POST['sem']?>" />
	      <tr><th>Name</th><th>Register No.</th><th>Roll No.</th><th>Admission No.</th></tr>
	      <?php
	     	  $ob->students_books_kept();
	      ?>
	      <tr><td>&nbsp;</td><td><input type="submit" name="new_sem" value="    Continue to save to new semester    " /></td></tr>
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
	      <tr><td>&nbsp;</td><td><input type="submit" name="continue_all" value="    continue with all departments    " /></td></tr>
	     </form>
	    </tbody>
	   </table>
<?php
}
?>
