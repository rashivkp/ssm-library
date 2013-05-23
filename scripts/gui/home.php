<table width="536" border="0" cellpadding="0">
<tbody>
<form action="" method="POST">
	<tr>
	<td>Search term</td>
	<td>Search by</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td><input type="text" name="query" id="query"/></td>
	<td><select id="cat" name="cat">
			<option value="id">OLD NO</option>
			<option value="name">Book Name</option>
			<option value="author">Author</option>
			
			<optgroup label="Catagory..." title="Catagory">
				<?php
				$cat=$ob->get_catagory();
				while($row=$cat->fetch_assoc())
				{
					echo "<option value='".$row['id']."'>".$row['caption']."</option>";
				}
				?>
			</optgroup>
			</select>
		</td>
	<td><input type="submit" name="search" value="Search" id="search"/></td>
	</tr>
</form>
</tbody>
</table>
<br />
<?php				
if(isset($_POST['search']))
{
	if(!isset($_GET['pg']))
		$pg=0;
	else
		$pg=$_GET['pg'];
		
		$pg_flag=false;
		
	$result=$ob->search_books($_POST['cat'],$_POST['query'],$pg);
	if($result->num_rows==15)
			$pg_flag=true;
		if($result->num_rows>0)
			{						
				?>
				<table width="536" border="1" cellpadding="5" cellspacing="5">
				<tbody>
				  <tr><th width="100">Title</th><th width="100">Edition</th><th width="200">Author</th><th width="100">Location</th></tr>
					<?php $i=1;
					do 
					{$i++;
						$row=$result->fetch_assoc();
						echo "<tr><td><a href='./?id=10&book=".$row['old_no']."'>".$row['title']."</a></td><td>".$row['edition']."</td><td>".$row['author']."</td><td>".$row['location']."</td></tr>";
					}while($i<$result->num_rows)
					?>
				 
				</tbody>
			   </table>	
			  <?php
			   if(!(!$pg_flag && !$pg))
			   {
				   ?>
			   <table width="536" border="0" cellpadding="5" >
				<tbody>
				  
				<tr><td align="left" width="436"><?php if($pg==0)
									echo "&nbsp;";
								else
									echo "<a href='./?pg=".($pg-1)."'> previous page </a></a>"; ?>
					</td>
					<td width="100">
					<?php if($pg_flag==false)
									echo "&nbsp;";
								else
									echo "<a href='./?pg=".($pg+1)."'>next page</a></a>"; ?></td></tr>
				</tbody>
			   </table>			
			   <?php
				}
			}
		else
			echo "No result found for your search ...!";
}
else 
{
	if(!isset($_GET['pg']))
		$pg=0;
	else
		$pg=$_GET['pg'];
		
		$pg_flag=false;
		$result=$ob->get_books($pg);
		if($result->num_rows==15)
			$pg_flag=true;
		if($result->num_rows>0)
			{						
				?>
				<table width="536" border="1" cellpadding="5" cellspacing="5">
				<tbody>
				  <tr><th width="100">Title</th><th width="100">Edition</th><th width="200">Author</th><th width="100">Location</th></tr>
					<?php
					$i=1;
					do 
					{$i++;
						$row=$result->fetch_assoc();
						echo "<tr><td><a href='./?id=10&book=".$row['old_no']."'>".$row['title']."</a></td><td>".$row['edition']."</td><td>".$row['author']."</td><td>".$row['location']."</td></tr>";
					}while($i<$result->num_rows)
					?>
				 
				</tbody>
			   </table>	
			   <?php
			   if(!(!$pg_flag && !$pg))
			   {
				   ?>
			   <table width="536" border="0" cellpadding="5">
				<tbody>
				  
				<tr><td align="left" width="436"><?php if($pg==0)
									echo "&nbsp;";
								else
									echo "<a href='./?pg=".($pg-1)."'> previous page </a></a>"; ?>
					</td>
					<td width="100">
					<?php if($pg_flag==false)
									echo "&nbsp;";
								else
									echo "<a href='./?pg=".($pg+1)."'>next page</a></a>"; ?></td></tr>
				</tbody>
			   </table>			
			   <?php
				}
			}
		else
			echo "There is no books ...!";
}

?>
