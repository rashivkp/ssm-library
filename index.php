<?php 
		require_once "scripts/library.php";
		$ob=new Library();
		?>

<!-- saved from url=(0036)file:///home/ssmpoly/Desktop/wp.html -->
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"><head profile="http://gmpg.org/xfn/11"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>SSM Poly Technic Library  </title>
<meta name="generator" content="WordPress 3.3.2"> <!-- leave this for stats -->
<link rel="stylesheet" href="./stylesheets/style.css" type="text/css" media="all">
<link rel="pingback" href="http://localhost/wp/xmlrpc.php">

		<link rel="archives" title="June 2012" href="http://localhost/wp/?m=201206">
		<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://localhost/wp/xmlrpc.php?rsd">
<meta name="generator" content="WordPress 3.3.2">
</head>
<body>


<div class="wrapper">

<div class="top">
	<div class="blogname">
		<h1><a href="#" title="SSM Poly Technic Library">SSM Poly Technic Library</a></h1>
		<h2>developed by Computer Engineering Students</h2>
	</div>
</div>
<div id="foxmenucontainer">
			<div id="foxmenu">
			<?php require GUI."choice.php"; ?>
	</div>		
	</div>		
<div class="content">
<div id="content"><a name="content"></a>

<div class="post" id="post-1">
<div class="title">
<h2><a href="#" rel="bookmark" title="Permanent Link to Hello world!"><?php switch(@$_GET['id'])
					{
						case 1: echo "Issue";
								break;
						case 2: echo "Return";
								break;
						case 3: echo "Add New Student";
								break;
						case 4: echo "Add New Staff";
								break;
						case 5: echo "Add New Book";
								break;
						case 6: echo "Manage Students";
								break;
						case 7: echo "Manage Staffs";
								break;
						case 9: echo "Find Students On Under Issue";
								break;
						case 10: echo "Catalog";
								break;
						case 11: echo "None Liability Cirtificate";
								break;
						default:echo "Search and Browse books";
					} ?></a></h2>


</div>
<div class="cover">
<div class="entry">
					<!--<p>Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!</p>-->
					<?php 
					switch(@$_GET['id'])
					{
						case 1: require GUI."issue.php";
								break;
						case 2: require GUI."retrieve.php";
								break;
						case 3: require GUI."new_student.php";
								break;
						case 4: require GUI."new_staff.php";
								break;
						case 5: require GUI."new_book.php";
								break;
						case 6: require GUI."rm_student.php";
								break;
						case 7: require GUI."rm_staff.php";
								break;
						case 9: require GUI."find_returners.php";
								break;
						case 10: require GUI."catalog.php";
								break;
						case 11: require GUI."nlc.php";
								break;
						default:require GUI."home.php";
					} ?>
				
</div>

</div>

<div class="postinfo">
					<div class="category"> </div>
					<div class="com"></div>
</div>


</div>
		
		<div class="navigation">
			<div class="alignleft"></div>
			<div class="alignright"></div>
		</div>

		

</div>

<div class="rightcolumn">

<div class="sidebar">
	
	
</div>
</div>
 <div class="clear"></div>

	
	
<div id="footer">


<!-- Bitte seid so fair und belohnt den Designer f�r seine Arbeit mit dem Link	-->	



  
</div>	
	
</div>	 </div>
</body></html>
