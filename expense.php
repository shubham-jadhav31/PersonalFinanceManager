<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Tab Icon -->
    <link rel="shortcut icon" type="x-icon" href="./images/slate_gray_logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Expense Page</title>

    <style>
      #nav_currentpage {
        border-bottom: 2px solid white; /* Adjust the size and color as needed */
      }
      .active {
        margin: 0px 5px;
      }
      .table{
        align: center;
        border: 2px;
        width:100%;
        line-height:40px;
        margin-left: 1px;
        Text: center;
      }
      .table thead {
        background-color: dark; /* Dark background color */
        color: white; /* Text color for the header row */
      }
      .table th, .table td {
        border: 1px solid black; /* Optional: Add borders to cells */
        padding: 10px; /* Optional: Add padding to cells */
      }
      .db{
        width:75%;
        margin-top: 60px;
        margin-left:10%;
      }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#"> <img src="./images/slate_gray_logo.png" style="height: 30px;"></img></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./transaction.php">Transaction <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./expense.php" id="nav_currentpage">Expense <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./income.php">Income <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./debt.php">Debts <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./budget.php">Budgets <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./investment.php">Investment <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0"> -->
      <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
      <!-- <button class="btn btn-outline-light" type="logout" style="opacity: 0.7;">Logout </button> -->
      <a href="logout.php" class="btn btn-outline-light" style="opacity: 0.7;">Logout</a>
    <!-- </form> -->
  </div>
</nav>

<!-- Content inside page -->

<!-- ================================== Display Table ================================================================ -->
<div class="db">
  <?php
  //Connecting to Database
  $servername = "localhost";
  $username = "root";
  $password = "root123";
  $database = "personalfinancemanager";
  $user_id = $_SESSION['id'];

  //Creating connection to database
  $conn = mysqli_connect($servername, $username, $password, $database);

   $sql = "SELECT * FROM transactions where type='Expense' && `id`=$user_id";
   $result = mysqli_query($conn, $sql);
  
   if(!$result){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Failed to fetch data from DB PFM.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>';
}
else{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Data fetch successfully from DB PFM.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>';
}
  ?>
  
<table class="table table-bordered"> 
	<tr> 
		<th colspan="6" class="text-center"><h2>Expense Record</h2></th> 
		</tr> 
  <tr class="bg-dark text-light">
			  <th class="text-center" style="width: 200px;"> Transaction_id </th> 
			  <th> Amount </th> 
			  <th> Type </th> 
			  <th> Category </th>
        <th> Date </th>
        <th> Time </th> 
			  
		</tr> 
		
		<?php 
    while($rows=mysqli_fetch_assoc($result)) 
		{ 
		?> 
		<tr>
    <td class="text-center"><?php echo $rows['transaction_id']; ?></td> 
		<td><?php echo $rows['amount']; ?></td> 
		<td><?php echo $rows['type']; ?></td> 
		<td><?php echo $rows['category']; ?></td>
    <td><?php echo $rows['date']; ?></td>
    <td><?php echo $rows['time']; ?></td> 
		</tr> 
    <?php 
    } 
    ?> 
</table>
</div>



<!-- ======================================================================================================================================= -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>