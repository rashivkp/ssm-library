<?php
if(isset($_GET['book']))
{
	$book=$ob->get_catalog_by_id($_GET['book']);
		?>
		<table width="500" border="0" cellpadding="5">
		<tbody>
		<form action="" method="POST">
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
		</form>
		</tbody>
		</table>

		<?php
	
}
else
	echo "Not found"
?>
