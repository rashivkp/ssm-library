<?php
require_once "scripts/config_set.php";  // including the details for connect to mysql database 

class Library
{
	public $db; //mysqli connect object
    public $msg; //message connect object
    public $sub_ob; //message connect object
    
		function __construct()
		{
			$this->db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
			switch(date('m'))
			{
				case '06': 
				$this->db->query("UPDATE `student` SET  sem = sem+1 WHERE  sem=2 OR sem=4");
							$this->db->query("UPDATE `student` SET  sem = 'passout' WHERE  sem=6");
							break;
				case '12':$this->db->query("UPDATE `student` SET  sem = sem+1 WHERE  sem=1 OR sem=3 OR sem=5");
							break;
				default: break;
			}
			
		}
		
		function issue()
		{
				$this->db->query("UPDATE `books` SET  `status` ='".$_POST['id']."', `date_transaction` ='".date("y.m.d")."' WHERE  `books`.`old_no` ='".$_POST['bk_id']."' AND `books`.`status` =0 LIMIT 1 ;");
				$this->db->query("UPDATE `user` SET  `books_kept` =books_kept+1  WHERE  `user`.`id` ='".$_POST['id']."' LIMIT 1 ;");
				$this->db->query("INSERT INTO `circulation` (`user_id`, `book_old_no`, `issued`) VALUES ('".$_POST['id']."', '".$_POST['bk_id']."', '".date("y.m.d")."');");
				
				echo "book issued successfully";			
		}

		function retrieve()
		{
			$this->db->query("UPDATE `books` SET  `status` =0 , `date_transaction` ='".date("y.m.d")."' WHERE  `books`.`old_no` ='".$_POST['bk_id']."' AND `books`.`status` ='".$_POST['id']."' LIMIT 1 ;");
			$this->db->query("UPDATE `user` SET  `books_kept` =books_kept-1  WHERE  `user`.`id` ='".$_POST['id']."' LIMIT 1 ;");
			//$r=$this->db->query("SELECT MAX(id) as id FROM `circulation` WHERE user_id='".$_POST['id']."' AND book_old_no='".$_POST['bk_id']."' AND returned IS NULL ");				
			//$row=$r->fetch_assoc();
			//$t_id=$row['id'];
			//$this->db->query("UPDATE `circulation` SET returned='".date("y.m.d")."' WHERE id='".$t_id."'");				
			$this->db->query("UPDATE `circulation` SET returned='".date("y.m.d")."' WHERE user_id='".$_POST['id']."' AND book_old_no='".$_POST['bk_id']."' AND returned IS NULL ");				
				echo "book delivered successfully";			
		}

		function search_books($cat,$query,$pg)
		{
			$pg=$pg*14;
			$sql;
			if($this->db)
			{
				switch($cat)
				{
					case "name": $sql="SELECT * FROM `books` WHERE `title` LIKE '%".$query."%' LIMIT $pg , 15;";
							break;
					case "author": $sql="SELECT * FROM `books` WHERE `author` LIKE '%".$query."%' LIMIT $pg , 15;";
							break;
					case "id":$sql="SELECT * FROM `books` WHERE `old_no`='".$query."' LIMIT $pg , 15;";
							break;
					default: $sql="SELECT * FROM  `books` WHERE  `title` LIKE  '%$query%'AND  `catagory` =$cat LIMIT $pg , 15";
							break;
				}
				return $result=$this->db->query($sql);
			}
			else
				return 0;
		}
		function get_books($pg)
		{
			$pg=$pg*14;
			$sql="SELECT * FROM  `books` LIMIT $pg , 15"; //this constant must be 1 lesser to the mulpilying constant of $pg
			return $result=$this->db->query($sql);
		}
				
		function new_students()
		{		
			if($this->db)
			{
				for($i=0;$i<$_POST['count'];$i++)
				{
					$sql1="INSERT INTO `user` (`id`, `reg`, `name`, `type`, `books_kept`, `dpt`) VALUES (NULL, '".$_POST["reg"][$i]."', '".$_POST["name"][$i]."', 'student', '0', '".$_POST["dpt"]."');";
					$sql2="INSERT INTO `student` (`id`, `sem`, `roll_no`, `admission`) VALUES ((SELECT id FROM user WHERE reg='".$_POST["reg"][$i]."'), '".$_POST["sem"]."', '".$_POST["roll"][$i]."', '".$_POST["adm"][$i]."');";
					$this->db->query($sql1);
					$this->db->query($sql2);
				}
				echo "new students details added successfully";
			}
			else
				echo "security problem";
		}
		
		function new_staffs()
		{		
			if($this->db)
			{
				for($i=0;$i<$_POST['count'];$i++)
				{
					$sql1="INSERT INTO `user` (`id`, `reg`, `name`, `type`, `books_kept`, `dpt`) VALUES (NULL, '".$_POST["reg"][$i]."', '".$_POST["name"][$i]."', '".$_POST["type"][$i]."', '0', '".$_POST["dpt"]."');";
					$this->db->query($sql1);
				}
				echo "new staffs details added successfully";
			}
			else
				echo "security problem";
			
		}
		
		function get_dpt()
		{
			if($this->db)
			{
				return $this->db->query("SELECT *FROM department");
			}
		}
		
		function get_catagory()
		{
			if($this->db)
			{
				return $this->db->query("SELECT *FROM catagory");
			}
		}
		
		function get_catagory_by_id($id)
		{
			$r=$this->db->query("SELECT *FROM catagory WHERE id='".$id."'");
			$row=$r->fetch_assoc();
			return $row['caption'];
		}
		//listing students of class for manipulation
		function get_students()
		{
			if($this->db)
			{
				$result=$this->db->query("SELECT *FROM user WHERE dpt='".$_POST['dpt']."' AND type='student'");
				if($result->num_rows)
				{
					$i=0;
					?>
								<form method="POST" action="">
					<table width="400" border="1" cellpadding="5" >
					<tbody>
					<input type="hidden" name="dpt" value="<?=$_POST['dpt']?>" />
					<input type="hidden" name="sem" value="<?=$_POST['sem']?>" />
					
					<tr><th width="150">Name</th><th width="70">Register No.</th><th width="70">Roll No.</th><th width="70">Admission No.</th><th>&nbsp;</th></tr>
					<?php
					while($user=$result->fetch_assoc())
					{
						$result1=$this->db->query("SELECT *FROM student WHERE id='".$user['id']."'");
						$student=$result1->fetch_assoc();
						?>
						<tr>	<td><input  size="20" type="text" value="<?=$user['name']?>" name="name[<?=$i?>]" /></td>
								<td><input size="9" type="text" value="<?=$user['reg']?>" name="reg[<?=$i?>]" /></td>
								<td><input size="4" type="text" value="<?=$student['roll_no']?>" name="roll[<?=$i?>]" /></td>
								<td><input size="6" type="text" value="<?=$student['admission']?>" name="adm[<?=$i?>]" /></td>
								<td><input type="checkbox" value="<?=$student['id']?>" name="del[<?=$i?>]" /></td></tr>
				<?php
						$i++;
					}
					echo '<input type="hidden" value="'.$i.'" name="count" />';
						      ?>
					  </tbody>
				   </table><br />
					<input type="submit" name="remove" value="    Remove selected    " /><br />
					<input type="submit" name="edit" value=" save changes of selected   " />
					
				   </form>
					<?php
				}
				else 
					echo "<div class='error'>There is no students..</div>";
			}
		}
		
		//listing staffs of department for manipulation		
		function get_staffs()
		{
			$result=$this->db->query("SELECT *FROM user WHERE dpt='".$_POST['dpt']."' AND type!='student'");
			if($result->num_rows)
			{
				$i=0;
				while($staff=$result->fetch_assoc())
				{
					$result1=$this->db->query("SELECT *FROM user WHERE id='".$staff['id']."'");
					$user=$result1->fetch_assoc();
					?>
					<tr>	<td><input type="text" value="<?=$user['name']?>" name="name[<?=$i?>]" /></td>
							<td><input type="text" value="<?=$user['reg']?>" name="reg[<?=$i?>]" /></td>
							<td><select  name="type[<?=$i?>]" >
								<option value="<?=$user['type']?>"><?=$user['type']?></option>
								<option value="HOD">HOD</option>
								<option value="tutor">tutor</option>
								</select></td>
							<td><input type="checkbox" value="<?=$user['id']?>" name="del[<?=$i?>]" /></td></tr>
			<?php
					$i++;
				} 				
					echo '<input type="hidden" value="'.$i.'" name="count" />';

			}		
		}
		
		function get_authors()
		{
			if($this->db)
			{
				return $this->db->query("SELECT name, id FROM author");
			}
		}		

		function new_books($type)
		{		
			switch($type)
			{
				case "copies":
						
							for($i=0;$i<$_POST['count'];$i++)
							{
								$sql1="INSERT INTO `books` (`id`, `title`, `author`, `acc_date`, `status`, `vol`, `edition`,
								 `no_of_pg`, `scheme`, `publisher`, `supplier`, `old_no`, `acc_no`, `catagory`, `location`, `cost`, `remarks`) 
								VALUES (NULL, '".$_POST['title']."', '".$_POST['author']."', '".$_POST['acc_date'][$i]."', 
								'0', '".$_POST['vol']."', '".$_POST['edition']."', '".$_POST['no_pg']."', 
								'".$_POST['scheme']."', '".$_POST['publisher']."', '".$_POST['supplier']."',
								 '".$_POST['old_no'][$i]."', '".$_POST['acc_no'][$i]."', '".$_POST['cat']."', '".$_POST['location'][$i]."',
								 '".$_POST['cost']."', '".$_POST['remarks']."');";
												
								$this->db->query($sql1);
							}
							echo "new books added successfully";
						break;
				case "new":$sql1="INSERT INTO `books` (`id`, `title`, `author`, `acc_date`, `status`, `vol`, `edition`,
								 `no_of_pg`, `scheme`, `publisher`, `supplier`, `old_no`, `acc_no`, `catagory`, `location`, `cost`, `remarks`) 
								VALUES (NULL, '".$_POST['title']."', '".$_POST['author']."', '".$_POST['acc_date']."', 
								'0', '".$_POST['vol']."', '".$_POST['edition']."', '".$_POST['no_pg']."', 
								'".$_POST['scheme']."', '".$_POST['publisher']."', '".$_POST['supplier']."',
								 '".$_POST['old_no']."', '".$_POST['acc_no']."', '".$_POST['cat']."', '".$_POST['location']."',
								 '".$_POST['cost']."', '".$_POST['remarks']."');";
													
								$this->db->query($sql1);
							
							echo "new books added successfully";
						break;
				case "edit":$sql1="UPDATE `books` SET `title`='".$_POST['title']."', `author`='".$_POST['author']."',
				 `acc_date`='".$_POST['acc_date']."', `vol`='".$_POST['vol']."', `edition`='".$_POST['edition']."',
								 `no_of_pg`='".$_POST['no_pg']."', `scheme`='".$_POST['scheme']."',
								  `publisher`='".$_POST['publisher']."', `supplier`='".$_POST['supplier']."',
								   `old_no`='".$_POST['old_no']."', `acc_no`='".$_POST['acc_no']."', `catagory`='".$_POST['cat']."',
								    `location`='".$_POST['location']."', `cost`='".$_POST['cost']."', `remarks`='".$_POST['remarks']."'
								    WHERE id='".$_POST['id_bk']."';";
													
								$this->db->query($sql1);
							
							echo "<div class='error'>changes saved</div>";
						break;
			}
		}		
		//Checking the constraints for issueing  a book, it includes validation, check status....
		function confirm_issue()
		{	
			$this->msg=false;
			$j=0;//msg index
			$sql1="SELECT *FROM user WHERE reg='".$_POST['reg_id']."'";					
			$result=$this->db->query($sql1);
			if($result->num_rows)
			{
				$row=$result->fetch_assoc();
				echo "Name: ".$row['name'];
				echo '<input type="hidden" value="'.$row['id'].'" name="id" />';
				echo '<input type="hidden" value="'.$row['books_kept'].'" name="books_kept" />';
				switch($row['type'])
				{
					case "HOD": if($row['books_kept']>=5)
								{
									$this->msg[]="Sorry, maximum books can kept is over... so can not issue the book.";
									$this->msg[]="Students can not hold more than 5 books";
								}
					break;
					case "tutor": if($row['books_kept']>=3)
								{
									$this->msg[]="Sorry, maximum books can kept is over... so can not issue the book.";
									$this->msg[]="Tutors can not hold more than 3 books";
								}
									break;
					default:if($row['books_kept']>=2)
							{
								$this->msg[]="Sorry, maximum books can kept is over... so can not issue the book.";
								$this->msg[]="Students can not hold more than 2 books";
							}
					
				}
			}
			else
			{
				$this->msg[]="<div class='error'>user does not exist</div>";
			}
			$sql="SELECT *FROM books WHERE old_no='".$_POST['bk_id']."' AND `status`=0";					
			$result=$this->db->query($sql);
			if($result->num_rows)
			{
				$row=$result->fetch_assoc();
				echo "Book: ".$row['title'];
			}
			else
				$this->msg[]="<div class='error'>Check Book id or status...</div>";
			return $this->msg;
		}
		
		//Checking the constraints for issueing  a book, it includes validation, check status....
		function confirm_retrieve()
		{		
			$msg=false;
			$id;
			
			$sql1="SELECT title,status, (TO_DAYS(NOW()) - TO_DAYS(date_transaction)) as days FROM books WHERE old_no='".$_POST['bk_id']."' AND status !='0'";					
			$result=$this->db->query($sql1);
			if(@$result->num_rows)
			{
				$row=$result->fetch_assoc();
				$id=$row['status'];
				echo "Book: ".$row['title']."<br />Holded days Count:".$row['days'];
				if($row['days']>15)
				{
					$d=$row['days']-15;
					echo "<br />You have to pay fine for $d days<br />";
				}
					
				$sql="SELECT *FROM user WHERE id='".$id."'";					
				$result=$this->db->query($sql);
				if($result->num_rows)
				{
					$row=$result->fetch_assoc();
					echo "Name: ".$row['name'];
					$id=$row['id'];
					echo '<input type="hidden" value="'.$row['id'].'" name="id" />';
					echo '<input type="hidden" value="'.$row['books_kept'].'" name="books_kept" />';
					switch($row['type'])
					{
						case "HOD": break;
						case "tutor": break;
						default:
								//$sql2="SELECT *FROM student WHERE id='".$id."')";	
								//$result=$this->db->query($sql2);
					}
				}
				else
					$msg[]="<div class='error'>user does not exist</div>";
			}
			else
				$msg[]="<div class='error'>Check Book id or status</div>";
			
			
			
			return $msg;
		}
		
		function remove_student($id)
		{		
			$sql1="DELETE FROM user WHERE id='".$id."'";					
			$result=$this->db->query($sql1);
			
			$sql2="DELETE FROM student WHERE id='".$id."'";					
			$result=$this->db->query($sql2);
		}
		function remove_staff($id)
		{		
			$sql1="DELETE FROM user WHERE id='".$id."'";					
			$result=$this->db->query($sql1);
		}
		//listing students of department, who has to return one or more books to library
		function students_books_kept()
		{
			$result=$this->db->query("SELECT *FROM user WHERE dpt='".$_POST['dpt']."' AND type='student' AND books_kept>0");
			if($result->num_rows)
			{?>
				<table width="536" border="1" cellpadding="5">
	    <tbody>
	      <tr><th>Name</th><th>Register No.</th><th>Roll No.</th><th>Admission No.</th></tr>
	      <?php
	      	$i=0;
				while($user=$result->fetch_assoc())
				{
					$result1=$this->db->query("SELECT *FROM student WHERE id='".$user['id']."'");
					$student=$result1->fetch_assoc();
					?>
					<tr>	<td><?=$user['name']?></td>
							<td><?=$user['reg']?></td>
							<td><?=$student['roll_no']?></td>
							<td><?=$student['admission']?></td>
							</tr>
			<?php
					$i++;
				}
				echo '</tbody></table>
			<input type="hidden" value="'.$i.'" name="count" />';
			}
			else
			 echo "<div class='error'>no one has to return books</div>";
		}
		
		function new_sem()
		{
			$result=$this->db->query("SELECT *FROM student WHERE sem=6");
			if($result->num_rows)
			{
				while($student=$result->fetch_assoc())
				{
					$result1=$this->db->query("SELECT *FROM user WHERE id='".$student['id']."' AND `dpt`='".$_POST['dpt']."'");
					if($result->num_rows)
					{
						$user=$result1->fetch_assoc();
						$this->db->query("INSERT INTO `passout` (`id`, `reg`, `dpt`, `name`, `books_kept`, `admission`) VALUES ('".$user['id']."', '".$user['reg']."', '".$user['dpt']."', '".$user['name']."', '".$user['books_kept']."', '".$student['admission']."');");
						$this->db->query("DELETE FROM student WHERE id='".$student['id']."'");					
						$this->db->query("DELETE FROM user WHERE id='".$student['id']."'");					
					}
				}
			}
			
			$result=$this->db->query("SELECT *FROM student WHERE sem!=6");
			if($result->num_rows)
			{
				while($student=$result->fetch_assoc())
				{
					$result1=$this->db->query("SELECT *FROM user WHERE id='".$student['id']."' AND `dpt`='".$_POST['dpt']."'");
					if($result->num_rows)
					{
						$sem=$student['sem'];
						$this->db->query("UPDATE student SET sem='".($sem+1)."' WHERE id='".$student['id']."'");					
					}
				}
			}			
		}
		
		function new_sem_all_dpt()
		{
			$result=$this->db->query("SELECT *FROM student WHERE sem=6");
			if($result->num_rows)
			{
				while($student=$result->fetch_assoc())
				{
					$result1=$this->db->query("SELECT *FROM user WHERE id='".$student['id']."' ");
					if($result->num_rows)
					{
						$user=$result1->fetch_assoc();
						$this->db->query("INSERT INTO `passout` (`id`, `reg`, `dpt`, `name`, `books_kept`, `admission`) VALUES ('".$user['id']."', '".$user['reg']."', '".$user['dpt']."', '".$user['name']."', '".$user['books_kept']."', '".$student['admission']."');");
						$this->db->query("DELETE FROM student WHERE id='".$student['id']."'");					
						$this->db->query("DELETE FROM user WHERE id='".$student['id']."'");					
					}
				}
			}
			
			$result=$this->db->query("SELECT *FROM student WHERE sem!=6");
			if($result->num_rows)
			{
				while($student=$result->fetch_assoc())
				{
					$result1=$this->db->query("SELECT *FROM user WHERE id='".$student['id']."'");
					if($result->num_rows)
					{
						$sem=$student['sem'];
						$this->db->query("UPDATE student SET sem='".($sem+1)."' WHERE id='".$student['id']."'");					
					}
				}
			}			
		}
		
		function get_catalog_by_id($id)
		{
			$r=$this->db->query("SELECT *FROM books WHERE old_no='".$id."'");
			$row=$r->fetch_assoc();
			return $row;
		}
		
		function nlc($reg)
		{
			$r=$this->db->query("SELECT *FROM user WHERE reg='".$reg."'");
			if($r->num_rows)
			{
				$row=$r->fetch_assoc();
				?>
				<table border='0'>
						<tr><td>Name</td><td>:</td><td><?=$row['name']?></td></tr>
						<tr><td>Register No.</td><td>:</td><td><?=$row['reg']?></td></tr>
				</table>
				<?php	
				$r1=$this->db->query("SELECT *FROM circulation WHERE user_id='".$row['id']."' ");
				if($r1->num_rows)
				{
					?>
					<table border='1' colspan='15' >
						<tr><th>Title</th><th>Issued On</th><th>Returned On</th></tr>
					<?php
					while($row1=$r1->fetch_assoc())
					{ 
						$book=$this->get_catalog_by_id($row1['book_old_no']);
						
						?>
						<tr><td><?=$book['title']?></td><td><?=$row1['issued']?></td><td><?=$row1['returned']?></td></tr>
			  <?php }
			  ?>
					</table>
					<?php
				}
			}
			else
				echo "<div class='error'>check register number</div>";
					
				
			
		}
		
		function get_user_by_id()
		{
			$r=$this->db->query("SELECT *FROM user WHERE reg='".$_POST['reg']."'");
			$row=$r->fetch_assoc();
			return $row;
		}
		function save_changes_student($i)
		{
				$result=$this->db->query("UPDATE student SET admission='".$_POST['adm'][$i]."', roll_no='".$_POST['roll'][$i]."' WHERE id='".$_POST['del'][$i]."' ");
				$result=$this->db->query("UPDATE user SET name='".$_POST['name'][$i]."', reg='".$_POST['reg'][$i]."' WHERE id='".$_POST['del'][$i]."' ");				
		}	
		
		function save_changes_staff($i)
		{
				$result=$this->db->query("UPDATE user SET name='".$_POST['name'][$i]."', type='".$_POST['type'][$i]."', reg='".$_POST['reg'][$i]."' WHERE id='".$_POST['del'][$i]."' ");				
		}	
}

?>

