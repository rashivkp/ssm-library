<?php 
if(isset($_GET['edit']))
{
	$book=$ob->get_catalog_by_id($_GET['edit']);
		?>
		<form action="" method="POST">

		<table width="500" border="0" cellpadding="5">
		<tbody>
			<tr><td>Title</td><td>:</td><td><input type="text" name="title" value='<?=$book['title']?>' /></td></tr>
			<tr><td>Author</td><td>:</td><td><input type="text" name="author" value='<?=$book['author']?>' /></td></tr>
			<tr><td>Vol</td><td>:</td><td><input type="text" name="vol" value='<?=$book['vol']?>' /></td></tr>
			<tr><td>Edition</td><td>:</td><td><input type="text" name="edition" value='<?=$book['edition']?>' /></td></tr>
			<tr><td>Acc Date</td><td>:</td><td><input type="text" name="acc_date" value='<?=$book['acc_date']?>' /></td></tr>
			<tr><td>Catagory</td></td><td>:</td><td><select name="cat">
										<option value='<?=$book['catagory']?>'> <?=$ob->get_catagory_by_id($book['catagory'])?> </option>
										<?php
										$cat=$ob->get_catagory();
										while($row=$cat->fetch_assoc())
										{
											echo "<option value='".$row['id']."'>".$row['caption']."</option>";
										}
										?>
									</select></td></tr>
			<tr><td>Location</td><td>:</td><td><input type="text" name="location" value='<?=$book['location']?>' /></td></tr>
			<tr><td>Publisher / Place</td><td>:</td><td><input type="text" name="publisher" value='<?=$book['publisher']?>' /></td></tr>
			<tr><td>Supplier</td><td>:</td><td><input type="text" name="supplier" value='<?=$book['supplier']?>' /></td></tr>
			<tr><td>Scheme</td><td>:</td><td><input type="text" name="scheme" value='<?=$book['scheme']?>' /></td></tr>
			<tr><td>Acc No.</td><td>:</td><td><input type="text" name="acc_no" value='<?=$book['acc_no']?>' /></td></tr>
			<tr><td>Old No.</td><td>:</td><td><input type="text" name="old_no" value='<?=$book['old_no']?>' /></td></tr>
			<tr><td>No. of pages</td><td>:</td><td><input type="text" name="no_pg" value='<?=$book['no_of_pg']?>' /></td></tr>
			<tr><td>Cost</td><td>:</td><td><input type="text" name="cost" value='<?=$book['cost']?>' /></td></tr>
			<tr><td>Remarks</td><td>:</td><td><select name="remarks">											
											<option value='<?=$book['remarks']?>'><?=$book['remarks']?></option>
											<option value='ok'>ok</option>
											<option value='damaged'>damaged</option>
											<option value='lost'>lost</option>
									</select></td></tr>
			
		</tbody>
		</table>
		
		<br />
		<br />
		<input type="submit" name="save" value="          Save        " />
		</form>
	<?php
}
else if(isset($_GET['edit']))
{}
else if(isset($_POST['save']))
{
	$ob->new_books("new");
	if($_POST['copies']>1)
	{
		?>
		<form method="POST" action="">
	      <input type="hidden" name="title" value='<?=$_POST['title']?>' /> 
	      <input type="hidden" name="count" value='<?=($_POST['copies']-1)?>' /> 
	      <input type="hidden" name="acc_no" value='<?=$_POST['acc_no']?>' /> 
	      <input type="hidden" name="author" value='<?=$_POST['author']?>' /> 
	      <input type="hidden" name="acc_date" value='<?=$_POST['acc_date']?>' /> 
	      <input type="hidden" name="publisher" value='<?=$_POST['publisher']?>' /> 
	      <input type="hidden" name="vol" value='<?=$_POST['vol']?>' /> 
	      <input type="hidden" name="edition" value='<?=$_POST['edition']?>' /> 
	      <input type="hidden" name="no_pg" value='<?=$_POST['no_pg']?>' /> 
	      <input type="hidden" name="author" value='<?=$_POST['author']?>' /> 
	      <input type="hidden" name="scheme" value='<?=$_POST['scheme']?>' /> 
	      <input type="hidden" name="old_no" value='<?=$_POST['old_no']?>' /> 
	      <input type="hidden" name="supplier" value='<?=$_POST['supplier']?>' /> 
	      <input type="hidden" name="cost" value='<?=$_POST['cost']?>' /> 
	      <input type="hidden" name="remarks" value='<?=$_POST['remarks']?>' /> 
	      <input type="hidden" name="cat" value='<?=$_POST['cat']?>' /> 
	      <table>
			  <tbody>
	      <?php
	      
		for($i=0;$i<($_POST['copies']-1);$i++)
		{
		?>
		<tr><td colspan="2"><h1>details of <?=($i+2)?> th copy</h1></td></tr>
		<tr><td>Acc Date</td><td><input type="text" name="acc_date[<?=$i?>]" value='<?=$_POST['acc_date']?>' /></td></tr>
		<tr><td>Location</td><td><input type="text" name="location[<?=$i?>]" value='<?=$_POST['location']?>' /> </td></tr>	      
		<tr><td>Acc No.</td><td><input type="text" name="acc_no[<?=$i?>]" /></td></tr>	      
	    <tr><td>Old No.</td><td><input type="text" name="old_no[<?=$i?>]" /></td></tr>	      
	    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>	      
	    
		<?php	
			
		}
		?>
		<tr><td>&nbsp;</td><td><input type="submit" name="save_copies" value="    Save    " /></td></tr>	      
		</tbody>
		</table>
		</form>
	      <?php
	  }
	  else
		echo "saved";
		
}
else if(isset($_POST['save_copies']))
{
	$ob->new_books("copies");
	echo "saved";
}
else 
{
?>

	
	  <table width="536" border="0" cellpadding="5">
	    <tbody>
	    <form method="POST" action="">
	      <tr><td>Title</td><td><input type="text" name="title" /></td></tr>
	      <tr><td>Acc No.</td><td><input type="text" name="acc_no"/></td></tr>
	      <tr><td>Author</td><td><input type="text" name="author"  /></td></tr>
	      <tr><td>Acc Date</td><td><input type="text" name="acc_date" /></td></tr>
	      <tr><td>Publisher / Place</td><td><input type="text" name="publisher" /></td></tr>
	      <tr><td>Vol</td><td><input type="text" name="vol" /></td></tr>
	      <tr><td>Edition</td><td><input type="text" name="edition" /></td></tr>
	      <tr><td>No. of Pages</td><td><input type="text" name="no_pg" /></td></tr>
	      <tr><td>Scheme</td><td><input type="text" name="scheme" /></td></tr>
	      <tr><td>Old No.</td><td><input type="text" name="old_no" /></td></tr>
	      <tr><td>Supplier</td><td><input type="text" name="supplier" /></td></tr>
	      <tr><td>Cost</td><td><input type="text" name="cost" /></td></tr>
	      <tr><td>Remarks</td><td><select name="remarks">											
											<option value='ok'>ok</option>
											<option value='damaged'>damaged</option>
											<option value='lost'>lost</option>
									</select></td></tr>
	      <tr><td>Catagory</td><td>
									<select name="cat">
										<?php
										$cat=$ob->get_catagory();
										while($row=$cat->fetch_assoc())
										{
											echo "<option value='".$row['id']."'>".$row['caption']."</option>";
										}
										?>
									</select>
								</td></tr>	      
	      <tr><td>Location</td><td><input type="text" name="location" /></td></tr>
	      <tr><td>No. of Copies</td><td><input type="text" name="copies" value="1"/></td></tr>
	      <tr><td>&nbsp;</td><td><input type="submit" name="save" value="    Save    " /></td></tr>	      
	      </form>
	    </tbody>
	   </table>
<?php
}
?>
