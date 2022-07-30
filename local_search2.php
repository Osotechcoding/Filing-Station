<?php 

// Database Structure 
//CREATE TABLE `search` (
 //`title` text NOT NULL,
 //`description` text NOT NULL,
 //`link` text NOT NULL,
 //FULLTEXT KEY ('title','description')
//) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1

if(isset($_POST['search']))
{
 $host="localhost";
 $username="root";
 $password="";
 $databasename="sample";
 $connect=mysql_connect($host,$username,$password);
 $db=mysql_select_db($databasename);

 $search_val=$_POST['search_term'];
    
 $get_result = mysql_query("select * from search where MATCH(title,description) AGAINST('$search_val')");
 while($row=mysql_fetch_array($get_result))
 {
  echo "<li><a href='http://talkerscode.com/webtricks/".$row['link']."'><span class='title'>".$row['title']."</span><br><span class='desc'>".$row['description']."</span></a></li>";
 }
 exit();
}
?>
<!-- get_result.php -->
<!-- end here -->
<!Doctype HTML>
<html>
<head>
<link type="text/css" rel="stylesheet" href="search_style.css"/>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
function do_search()
{
 var search_term=$("#search_term").val();
 $.ajax
 ({
  type:'post',
  url:'get_results.php',
  data:{
   search:"search",
   search_term:search_term
  },
  success:function(response) 
  {
   document.getElementById("result_div").innerHTML=response;
  }
 });
 
 return false;
}
</script>
</head>
<body>
<div id="wrapper">

<div id="search_box">
 <form method="post"action="get_results.php" onsubmit="return do_search();">
  <input type="text" id="search_term" name="search_term" placeholder="Enter Search" onkeyup="do_search();">
  <input type="submit" name="search" value="SEARCH">
 </form>
</div>

<div id="result_div"></div>

</div>
</body>
</html>