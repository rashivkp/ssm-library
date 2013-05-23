<?php
if(isset($_POST['edit_b']))
{
	$book=$ob->get_catalog_by_id($_POST['book_old_no']);
	
?>			<form action="" method="POST">
<input type="hidden" name="id_bk" value='<?=$book['id']?>' />
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
else if(isset($_POST['save']))
{
	$ob->new_books("edit");
}
else if(isset($_POST['new']))
{
	$book=$ob->get_catalog_by_id($_POST['book_old_no']);
	
?>			<form action="" method="POST">
<input type="hidden" name="id_bk" value='<?=$book['id']?>' />
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
			<tr><td>Acc No.</td><td>:</td><td><input type="text" name="acc_no" /></td></tr>
			<tr><td>Old No.</td><td>:</td><td><input type="text" name="old_no" /></td></tr>
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
		<input type="submit" name="new_save" value="          Save        " />		
		</form> <?php
}
else if(isset($_POST['new_save']))
{
	$ob->new_books("new");
}
else if(isset($_GET['book']))
{
	$book=$ob->get_catalog_by_id($_GET['book']);
		?>
		<form action="" method="POST">

		<table width="500" border="0" cellpadding="5">
		<tbody>
			<tr><td>Title</td><td>:</td><td><?=$book['title']?></td></tr>
			<tr><td>Author</td><td>:</td><td><?=$book['author']?></td></tr>
			<tr><td>Vol</td><td>:</td><td><?=$book['vol']?></td></tr>
			<tr><td>Edition</td><td>:</td><td><?=$book['edition']?></td></tr>
			<tr><td>Acc Date</td><td>:</td><td><?=$book['acc_date']?></td></tr>
			<tr><td>Catagory</td></td><td>:</td><td><?=$book['catagory']?></td></tr>
			<tr><td>Location</td><td>:</td><td><?=$book['location']?></td></tr>
			<tr><td>Publisher / Place</td><td>:</td><td><?=$book['publisher']?></td></tr>
			<tr><td>Supplier</td><td>:</td><td><?=$book['supplier']?></td></tr>
			<tr><td>Scheme</td><td>:</td><td><?=$book['scheme']?></td></tr>
			<tr><td>Acc No.</td><td>:</td><td><?=$book['acc_no']?></td></tr>
			<tr><td>Old No.</td><td>:</td><td><?=$book['old_no']?></td></tr>
			<tr><td>No. of pages</td><td>:</td><td><?=$book['no_of_pg']?></td></tr>
			<tr><td>Cost</td><td>:</td><td><?=$book['cost']?></td></tr>
			<tr><td>Remarks</td><td>:</td><td><?=$book['remarks']?></td></tr>
			<tr><td>Status</td><td>:</td><td>
						<?php if($book['status']==0) 
									echo "On Location";
								else
									echo "Under issue";	?></td></tr>
		</tbody>
		</table>
		
		<br />
		<br />
		<input type="hidden" name="book_old_no" value="<?=$_GET['book']?>" />
		<input type="submit" name="edit_b" value="Edit This Book" />
		<br />
		<input type="submit" name="new" value="New Edition of this book " />
		</form>
		
		<?php
	
}
else
	echo "Not found"
?>
