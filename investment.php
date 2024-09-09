<?php
include 'session.php';
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
    <link rel="stylesheet" href="./styles/investment.css">

    <title>Investment Page</title>

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
        <a class="nav-link" href="./transaction.php">Transaction <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./expense.php">Expense <span class="sr-only"></span></a>
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
        <a class="nav-link" href="./investment.php" id="nav_currentpage">Investment <span class="sr-only">(current)</span></a>
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

  if(!$conn)
  {
      die("Sorry we failed to connect to server due to --> " . mysqli_connect_error());
  }

  else 
  {
    if(isset($_POST['insert'])){
      $amount = $_POST['amount'];
      $type = $_POST['type'];
      $description = $_POST['description'];

          $sql = "INSERT INTO `investments` (`amount`, `type`, `description`, `date`, `time`) VALUES ('$amount', '$type', '$description', CURDATE(), CURTIME());";
          $result = mysqli_query($conn, $sql);

          if(!$result){
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"style="margin-top: 60px; width: 75%; margin-left: 10%;">
              <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>';
          }
          else{
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert"style="margin-top: 60px; width: 75%; margin-left: 10%;">
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

      $sql = "UPDATE `investments` SET `$updatecol` = '$updateto' WHERE `$wherecol` = '$whereis'";
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

      
      $sql = "DELETE FROM `investments` WHERE `$deletecol` = '$deleteis'";
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
<div class = "rounded-container bg-dark text-white">
<!--  <h2>Data operations in Transaction Record</h2> -->
<div class = "col g-3">
    <form action="/dbmscp/investment.php" id="form1" name="insertform" onsubmit="return validateForm('insertform');" method="post">
      <h3>Insert Data</h3>
      
      <div class="row g-3">
      <div class="form-group col-md-3">
        <label for="amount">Amount</label>
        <b><span class="formerror"> </span></b>
        <input type="number" name="amount" class="form-control" id="amount" aria-describedby="emailHelp" required>
      </div>
      
      <div class="form-group dropdown col-md-3">
        <label for="type">Type</label>
        <div class="form-floating">
          <select class="form-select" name="type" id="floatingSelect" aria-label="Floating label select example">
            <option selected> </option>
            <option value="Stock Market">Stock Market</option>
            <option value="Mutual Fund" >Mutual Fund</option>
            <option value="Public Providant Fund PPF" >Public Providant Fund PPF</option>
            <option value="Employee Providant Fund EPF" >Employee Providant Fund EPF</option>
            <option value="Government Bonds" >Government Bonds</option>
            <option value="Real Estate" >Real Estate</option>
          </select>
      <!-- <label for="floatingSelect">Works with selects</label> -->
        </div>
      </div>

      <div class="form-group col-md-3">
        <label for="description">Description</label>
        <input type="text" name="description" class="form-control" id="description" aria-describedby="emailHelp">
      </div>

      <!-- <div class="form-group">
      <label>&nbsp;</label> -->
      <button type="insert" name="insert" class="btn btn-primary col-md-1">Insert</button>

      </div>
      
    </form>


    <!-- =========== update form ================= -->

    <form action="/dbmscp/investment.php" method="post" id="form2" name="updateform" onsubmit="return validateForm(name)">
      <h3>Update Data</h3>
      
      <div class="row g-3">
      <div class="form-group dropdown col-md-3">
        <label for="updatecol">Update</label>
        <div class="form-floating">
          <select class="form-select" name="updatecol" id="floatingSelect" aria-label="Floating label select example">
            <option selected> </option>
            <option value="amount">Amount</option>
            <option value="type" >Type</option>
            <option value="description" >Description</option>
          </select>
      <!-- <label for="floatingSelect">Works with selects</label> -->
        </div>
      </div>

      <div class="form-group col-md-3">
        <label for="updateto">To</label>
        <input type="number" name="updateto" class="form-control" id="amount" aria-describedby="emailHelp" required>
      </div>
      
      <div class="form-group dropdown col-md-3">
        <label for="wherecol">Where</label>
        <div class="form-floating">
          <select class="form-select" name="wherecol" id="floatingSelect" aria-label="Floating label select example">
            <option selected> </option>
            <option value="investment_id">Investment_id</option>
            <option value="amount">Amount</option>
            <option value="type" >Type</option>
            <option value="description" >Description</option>
          </select>
      <!-- <label for="floatingSelect">Works with selects</label> -->
        </div>
      </div>

      <div class="form-group col-md-2">
        <label for="whereis">Is</label>
        <input type="number" name="whereis" class="form-control" id="amount" aria-describedby="emailHelp" required>
      </div>

      <!-- <div class="form-group">
      <label>&nbsp;</label> -->
      <button type="update" name="update" class="btn btn-success col-md-1">Update</button>

      </div>
      
    </form>
    
    <!-- =================== Delete form ================ -->

    <form action="/dbmscp/investment.php" method="post" id="form3" name="deleteform" onsubmit="return validateForm(name)">
      <h3>Delete Data</h3>
      
      <div class="row g-3">
      <div class="form-group dropdown col-md-3">
        <label for="deletecol">Delete</label>
        <div class="form-floating">
          <select class="form-select" name="deletecol" id="floatingSelect" aria-label="Floating label select example">
            <option selected> </option>
            <option value="investment_id">Investment_id</option>
            <option value="amount">Amount</option>
            <option value="type" >Type</option>
            <option value="description" >Description</option>
          </select>
      <!-- <label for="floatingSelect">Works with selects</label> -->
        </div>
      </div>

      <div class="form-group col-md-2">
        <label for="deleteis">Is</label>
        <input type="number" name="deleteis" class="form-control" id="amount" aria-describedby="emailHelp" required>
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

   $sql = "SELECT * FROM investments WHERE `id`=$user_id";
   $result = mysqli_query($conn, $sql);
  
   if(!$result){
    echo '<div class="alert alert-danger alert-dismissible fade show fade-alert" role="alert">
    <strong>Error!</strong> Failed to fetch data from DB PFM.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>';
}
else{
    echo '<div class="alert alert-success alert-dismissible fade show fade-alert" role="alert">
    <strong>Success!</strong> Data fetch successfully from DB PFM.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>';
}
  ?>
  
<table class="table table-bordered"> 
	<tr> 
		<th colspan="6" class="text-center"><h2>Investment Record</h2></th> 
		</tr> 
  <tr class="sticky-header bg-dark text-light">
			  <th> Investment_id </th> 
			  <th> Amount </th>
        <th> Type </th>
			  <th> Description </th>
        <th> Date </th>
        <th> Time </th> 
			  
		</tr> 
		
		<?php 
    while($rows=mysqli_fetch_assoc($result)) 
		{ 
		?> 
		<tr>
    <td class="text-center"><?php echo $rows['investment_id']; ?></td> 
		<td><?php echo $rows['amount']; ?></td>
    <td><?php echo $rows['type']; ?></td>  
		<td><?php echo $rows['description']; ?></td>
    <td><?php echo $rows['date']; ?></td>
    <td><?php echo $rows['time']; ?></td> 
		</tr> 
    <?php 
    } 
    ?> 
</table>
</div>

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


  <script src="./investment.js"></script>
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

  </div> <!-- this division is to seperate nav and other components of page-->
  
  <script src="./js/investment.js"></script>
</body>
</html>