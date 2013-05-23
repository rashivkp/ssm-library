
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../includes/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 
if(isset($_POST['new']))
{
	require_once "../scripts/config.php";
	$db=mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if($db)
	{
		if(mysqli_query($db,"INSERT INTO `ssm_library`.`user` (`lib_id`, `name`) VALUES ('".$_POST['lib_id']."', '".$_POST['name']."');"))
			echo "new users added successfully";
		else
			echo "error on inserting , please check the values ..";
	}
	else
		echo "security problem";
	
}
?>
<div class="title">
	<h1 class="header">Add new user to SSM Library</h1>
</div>
<div class="choice">
</div>
<div class="content">
	<div align="justify">
	  <table width="536" border="1" cellpadding="5">
	    <tbody>
	    <form method="POST" action="">
	      <tr><th width="80">Name</th><th width="89">Library id</th></tr>
	      <tr><td><input type="text" name="name" id="name" /></td><td><input type="text" name="lib_id" id="lib_id" /></td></tr>
	      <tr><td><input type="submit" name="new" id="new" /></td><td>&nbsp;</td></tr>
	    </form>
	    </tbody>
	   </table>
  </div>
</div>
</body>
</html>
