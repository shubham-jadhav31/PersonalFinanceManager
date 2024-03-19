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
    <!-- Awesome Inclusion Up Arrow -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 

    <title>Budget Page</title>

    <style>
      /* body{
        background-color: #deeeff;
      } */
      
      .other_than_nav {
        margin-top: 65px;
      }
      #nav_currentpage {
        border-bottom: 2px solid white; /* Adjust the size and color as needed */
      }
      .active {
        margin: 0px 5px;
      }
      .rounded-container {
          width: 1130px; /* Set the width of your container */
          /* height: 200px; /* Set the height of your container */
          background-color: #f0f0f0; /* Set the background color */
          border-radius: 5px; /* Adjust the border-radius to control the roundness of corners */
          padding: 20px; /* Add padding for content inside the container */
          display: flex;
          margin-left: 10%;
          box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
      }
      
          
      .table{
        align: center;
        border: 2px;
        width:100%;
        line-height:40px;
        margin-left: 1px;
        Text: center;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
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
        margin-top: 50px;
        margin-left:10%;
      }
      select{
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        border-radius: 0.25rem;
      }
      button.btn.btn-primary.col-md-1 {
        width: 200px;
        height: calc(1.5em + .75rem + 2px);
        margin-top: 30px;
      }
      button.btn.btn-success.col-md-1 {
        width: 200px;
        height: calc(1.5em + .75rem + 2px);
        margin-top: 30px;
      }
      button.btn.btn-danger.col-md-1 {
        width: 200px;
        height: calc(1.5em + .75rem + 2px);
        margin-top: 30px;
      }
      #btn-back-to-top {
        position: fixed;
        bottom: 60px;
        right: 40px;
        font-size: 20px;
        padding: 10px 17px;
        background-color: #333;
        border-radius: 50%;
        display: none;
      }
      #btn-back-to-top i {
        color: #f0f0f0; /* Light gray color */
      }
      .sticky-header {
        position: sticky;
        top: 55px;
      }
      
    </style>
  </head>
  <body>
    
<!-- ============================================Nav Bar=========================================================================================== -->
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
        <a class="nav-link" href="./transaction.php">Transaction <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./expense.php">Expense <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./income.php">Income <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./debt.php">Debts <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./budget.php" id="nav_currentpage">Budget <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./investment.php">Investment <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./bin.php">Bin <span class="sr-only"></span></a>
      </li>
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0"> -->
      <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
      <!-- <button class="btn btn-outline-light" type="logout" style="opacity: 0.7;">Logout </button> -->
      <a href="logout.php" class="btn btn-outline-light" style="opacity: 0.7;">Logout</a>
    <!-- </form> -->
  </div>
</nav>

<!-- ======================================================================================================================================= -->
<div class="other_than_nav">
<!-- Content inside page -->
<!-- -----------------------------------insertion------------------------------------- --> 
<?php

if($_SERVER ['REQUEST_METHOD'] == 'POST')
{
    //Connecting to Database
    $servername = "localhost";
    $username = "root";
    $password = "root123";
    $database = "personalfinancemanager";

    //Creating connection to database
    $conn = mysqli_connect($servername, $username, $password, $database);

    if(!$conn){
        die("Sorry we failed to connect to server due to --> " . mysqli_connect_error());
    }
    else
    {
      if(isset($_POST['insert'])){
        $amount = $_POST['amount'];
        $category = $_POST['category'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $sql = "INSERT INTO `budgets` (`amount`, `category`,`start_date`, `end_date`,`date`,`time`) VALUES ('$amount','$category', '$start_date', '$end_date', CURDATE(),CURTIME())";
        $result = mysqli_query($conn, $sql);

        if(!$result){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 60px; width: 75%; margin-left: 10%;">
            <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>';
        }
        else{
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 60px; width: 75%; margin-left: 10%;">
            <strong>Success!</strong> Your entry has been submitted successfully!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>';
        }
      }

      elseif (isset($_POST['update'])) {
        $updatecol = $_POST['updatecol'];
        $updateto = $_POST['updateto'];
        $wherecol = $_POST['wherecol'];
        $whereis = $_POST['whereis'];
  
        $sql = "UPDATE `budgets` SET `$updatecol` = '$updateto' WHERE `$wherecol` = '$whereis'";
        $result = mysqli_query($conn, $sql);
        
        if(!$result){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"style="margin-top: 60px; width: 75%; margin-left: 10%;">
          <strong>Error!</strong> Failed to fetch data from DB PFM.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
      }
      else{
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert"style="margin-top: 60px; width: 75%; margin-left: 10%;">
          <strong>Success!</strong> Data fetch successfully from DB PFM.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
      }
        
      }
  
      elseif (isset($_POST['delete'])) {
        $deletecol = $_POST['deletecol'];
        $deleteis = $_POST['deleteis'];
  
        
        $sql = "DELETE FROM `budgets` WHERE `$deletecol` = '$deleteis'";
        $result = mysqli_query($conn, $sql);
        
        if(!$result){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"style="margin-top: 60px; width: 75%; margin-left: 10%;">
          <strong>Error!</strong> Failed to fetch data from DB PFM.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
      }
      else{
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert"style="margin-top: 60px; width: 75%; margin-left: 10%;">
          <strong>Success!</strong> Data fetch successfully from DB PFM.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
      }
        
      }
    }


}


?>

<!-- Creating a Form to insert data in database -->
<div class = "rounded-container bg-dark text-white" id="form1">
<!--  <h2>Data operations in Transaction Record</h2> -->
<div class = "col g-3">
<form action="/dbmscp/budget.php" name="insertform" onsubmit="return validateForm('insertform');" method="post">
  <h3>Insert Data</h3>
  
  <div class="row g-3">
  <div class="form-group col-md-3">
    <label for="amount">Amount</label>
    <b><span class="formerror"> </span></b>
    <input type="number" name="amount" class="form-control" id="amount" aria-describedby="emailHelp" required>
  </div>

  <div class="form-group col-md-3">
    <label for="marks">Category</label>
    <input type="text" name="category" class="form-control" id="category" aria-describedby="emailHelp">
  </div>

  <div class="form-group col-md-2">
    <label for="start_date">Start Date</label>
    <input type="date" class="form-control" name="start_date" id="start_date" required>
  </div>

  <div class="form-group col-md-2">
    <label for="end_date">End Date</label>
    <input type="date" class="form-control" name="end_date" id="end_date" required>
  </div>


  <!-- <div class="form-group">
  <label>&nbsp;</label> -->
  <button type="insert" name="insert" class="btn btn-primary col-md-1 but">Insert</button>

  </div>
  
</form>


    <!-- =========== update form ================= -->

    <form action="/dbmscp/budget.php" method="post" id="form2" name="updateform" onsubmit="return validateForm(name)">
      <h3>Update Data</h3>
      
      <div class="row g-3">
      <div class="form-group dropdown col-md-3">
        <label for="updatecol">Update</label>
        <div class="form-floating">
          <select class="form-select" name="updatecol" id="updatecol_floatingSelect" aria-label="Floating label select example">
            <option selected> </option>
            <option value="amount">Amount</option>
            <option value="category" >Category</option>
            <option value="start_date" >Start Date</option>
            <option value="end_date" >End Date</option>
          </select>
      <!-- <label for="floatingSelect">Works with selects</label> -->
        </div>
      </div>

      <div class="form-group col-md-3">
        <label for="updateto">To</label>
        <input type="number" name="updateto" class="form-control" id="updateto" aria-describedby="emailHelp" required>
      </div>
      
      <div class="form-group dropdown col-md-2">
        <label for="wherecol">Where</label>
        <div class="form-floating">
          <select class="form-select" name="wherecol" id="wherecol_floatingSelect" aria-label="Floating label select example">
            <option selected> </option>
            <option value="budget_id">Budget id</option>
            <option value="amount">Amount</option>
            <option value="category" >Category</option>
            <option value="start_date" >Start Date</option>
            <option value="end_date" >End Date</option>
          </select>
      <!-- <label for="floatingSelect">Works with selects</label> -->
        </div>
      </div>

      <div class="form-group col-md-2">
        <label for="whereis">Is</label>
        <input type="number" name="whereis" class="form-control" id="whereis" aria-describedby="emailHelp" required>
      </div>

      <!-- <div class="form-group">
      <label>&nbsp;</label> -->
      <button type="update" name="update" class="btn btn-success col-md-1">Update</button>

      </div>
      
    </form>
    
    <!-- =================== Delete form ================ -->

    <form action="/dbmscp/budget.php" method="post" id="form3" name="deleteform" onsubmit="return validateForm(name)">
      <h3>Delete Data</h3>
      
      <div class="row g-3">
      <div class="form-group dropdown col-md-3">
        <label for="deletecol">Delete</label>
        <div class="form-floating">
          <select class="form-select" name="deletecol" id="deletecol_floatingSelect" aria-label="Floating label select example">
            <option selected> </option>
            <option value="budget_id">Budget id</option>
            <option value="amount">Amount</option>
            <option value="category" >Category</option>
            <option value="start_date" >Start Date</option>
            <option value="end_date" >End Date</option>
          </select>
      <!-- <label for="floatingSelect">Works with selects</label> -->
        </div>
      </div>

      <div class="form-group col-md-2">
        <label for="deleteis">Is</label>
        <input type="number" name="deleteis" class="form-control" id="deleteis" aria-describedby="emailHelp" required>
      </div>

      <!-- <div class="form-group">
      <label>&nbsp;</label> -->
      <button type="delete" name="delete" class="btn btn-danger col-md-1">Delete</button>

      </div>
      
    </form>


    </div>
</div>




<hr>
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

   $sql = "SELECT `budget_id`, `amount`, `category`, `start_date`, `end_date`, `date`, `time` FROM budgets WHERE `id`=$user_id";
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
		<th colspan="7" class="text-center"><h2>Budget Record</h2></th> 
		</tr> 
  <tr class="sticky-header bg-dark text-light">
			  <th> Budget_id </th> 
			  <th> Amount </th>  
			  <th> Category </th>
        <th> Start Date </th>
        <th> End Date </th>
        <th> Date </th>
        <th> Time </th> 
			  
		</tr> 
		
		<?php 
    while($rows=mysqli_fetch_assoc($result)) 
		{ 
		?> 
		<tr>
    <td class="text-center"><?php echo $rows['budget_id']; ?></td> 
		<td><?php echo $rows['amount']; ?></td>  
		<td><?php echo $rows['category']; ?></td>
    <td><?php echo $rows['start_date']; ?></td>
    <td><?php echo $rows['end_date']; ?></td>
    <td><?php echo $rows['date']; ?></td>
    <td><?php echo $rows['time']; ?></td> 
		</tr> 
    <?php 
    } 
    ?> 
</table>
</div>

<!-- ================================ to change type of input resp to previous ============================================================== -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // FOR UPDATE FORM ------------- 
    // Get the "updatecol" and "wherecol" dropdown elements
    var updatecolSelect = document.getElementById("updatecol_floatingSelect");
    var wherecolSelect = document.getElementById("wherecol_floatingSelect");

    // Get the corresponding input fields
    var updatetoInput = document.getElementById("updateto");
    var whereisInput = document.getElementById("whereis");

    // Add event listeners to the "updatecol" and "wherecol" dropdowns
    updatecolSelect.addEventListener("change", function () {
      // Check the selected value and update form fields accordingly
      if (updatecolSelect.value === "category") {
        // Convert "To" input to a text input
        updatetoInput.type = "text";
      } else if (updatecolSelect.value === "start_date" || updatecolSelect.value === "end_date") {
        updatetoInput.type = "date";
      } else {
        // Convert "To" input to a number input
        updatetoInput.type = "number";
      }
    });

    wherecolSelect.addEventListener("change", function () {
      // Check the selected value and update form fields accordingly
      if (wherecolSelect.value === "category") {
        // Convert "Is" input to text input
        whereisInput.type = "text";
      } else if (wherecolSelect.value === "start_date" || wherecolSelect.value === "end_date") {
        whereisInput.type = "date";
      } else {
        // Convert "Is" input to a number input
        whereisInput.type = "number";
      }
    });

    // FOR DELETE FORM ------------- 
    // Get the "deletecol" and "deleteis" input elements
  var deletecolSelect = document.getElementById("deletecol_floatingSelect");
  var deleteisInput = document.getElementById("deleteis");

  // Add an event listener to the "deletecol" dropdown
  deletecolSelect.addEventListener("change", function () {
      if (deletecolSelect.value === "category") {
          // If "Due Date" is selected, change the input type to "date"
          deleteisInput.type = "text";
      } else if (deletecolSelect.value === "start_date" || deletecolSelect.value === "end_date") {
        deleteisInput.type = "date";
      } else {
          // For other options, set the input type back to "number"
          deleteisInput.type = "number";
      }
  });
  });
</script>

<!-- ================================= Scroll to top button ================================================================================ -->
    <!-- Back to top button -->
    <button
        type="button"
        class="btn btn-floating"
        id="btn-back-to-top"
        >
  <i class="fas fa-arrow-up"></i>
</button>


<script>
  //Get the button
  let mybutton = document.getElementById("btn-back-to-top");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if (
      document.body.scrollTop > 40 ||
      document.documentElement.scrollTop > 40
    ) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }
  // When the user clicks on the button, scroll to the top of the document
  mybutton.addEventListener("click", backToTop);

  function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
  </script>

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

    </div> <!-- this division is to seperate nav and other component-->
  </body>
</html>