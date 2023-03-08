<html>  
<head>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<title> Pagination in PHP & MySQL </title> 
<style> 
#tab{background-image: linear-gradient(to right, white, lightgreen); border: solid; border-color: darkorange; border-radius: 5px}

#hd{background-image: linear-gradient(to right, teal, lightgreen); border: solid; border-color: darkorange; border-radius: 5px; color: white; text-shadow: 2px 2px darkgreen; font-family: monospace;}


body{
    background-image: linear-gradient(to right, lightgreen, white); border: solid; border-color: darkorange; border-radius: 5px}
}

</style>
</head>  

<body>  
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="https://www.mitindia.in/">MITIndia</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Search</a></li>
      <li><a href="#">Updates <span class="badge">7</span> </a></li>
      <li><a href="#">Login</a></li>
    </ul>
  </div>
</nav>

<center>
<h1 id='hd'> Record Navigation  </h1>  <hr color=red>

<?php  
$conn = mysqli_connect('localhost', 'root', '');  
if (! $conn) {  
 die("Connection failed" . mysqli_connect_error());  
}  
else 
{  mysqli_select_db($conn, 'college_db');  

}  

// variable to store number of rows per page

    $limit = 10;  

    // query to retrieve all rows from the table 

    $getQuery = "select * from student_info";    

    // get the result

    $result = mysqli_query($conn, $getQuery);  
    $total_rows = mysqli_num_rows($result);    

    // get the required number of pages

    $total_pages = ceil ($total_rows / $limit);    

    // update the active page number

    if (!isset ($_GET['page']) ) {  

        $page_number = 1;  

    } else {  

        $page_number = $_GET['page'];  

    }    

    // get the initial page number

    $initial_page = ($page_number-1) * $limit;   

    // get data of selected rows per page    

    $getQuery = "SELECT *FROM student_info LIMIT " . $initial_page . ',' . $limit;  

    $result = mysqli_query($conn, $getQuery);       

    //display the retrieved result on the webpage  
    echo"<table border=1 id='tab'> <tr bgcolor=yellow> <td> RegNo </td> <td> Name </td> <td> Course </td> <td> Academic Year </td></tr>";

    while ($row = mysqli_fetch_array($result)) {  

        echo "<tr><td>".$row['regno'] . "</td><td>" . $row['sname'] . "</td><td>" . $row['course'] . "</td><td>" . $row['aca_yr'] . "</td> </tr>";  

    }    
echo "</table>";
echo "<ul class='pagination'>";

    // show page number with link   

    for($page_number = 1; $page_number<= $total_pages; $page_number++) {  

        echo '<li><a href = "pagination.php?page=' . $page_number . '">' . $page_number . ' </a></li>';  

    }    
?>  
<hr>
<div class="alert alert-success">
    <strong>Navigation</strong> aka pagination 
  </div>
  <img src="Business_Card_MIT.png" width="160px" class="img-rounded" alt="MIT India">
</body>  
</html> 
