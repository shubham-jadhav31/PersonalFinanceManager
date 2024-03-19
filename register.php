<?php
require_once "config.php";

$username = $password = $confirm_password = $address = $city = $state = "";
$username_err = $password_err = $confirm_password_err = $address_err = $city_err = $state_err = "";


if ($_SERVER['REQUEST_METHOD'] == "POST"){

  // Check if username is empty
  if(empty(trim($_POST["username"]))){
      $username_err = "Username cannot be blank";
  }
  else{
      $sql = "SELECT id FROM users WHERE username = ?";
      $stmt = mysqli_prepare($conn, $sql);
      if($stmt)
      {
          mysqli_stmt_bind_param($stmt, "s", $param_username);

          // Set the value of param username
          $param_username = trim($_POST['username']);

          // Try to execute this statement
          if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_store_result($stmt);
              if(mysqli_stmt_num_rows($stmt) == 1)
              {
                  $username_err = "This username is already taken"; 
              }
              else{
                  $username = trim($_POST['username']);
              }
          }
          else{
              echo "Something went wrong";
          }
      }
  }

  mysqli_stmt_close($stmt);

 
  // Check for password
  if(empty(trim($_POST['password']))){
      $password_err = "Password cannot be blank";
  }
  elseif(strlen(trim($_POST['password'])) < 5){
      $password_err = "Password cannot be less than 5 characters";
  }
  else{
      $password = trim($_POST['password']);
  }

  // Check for confirm password field
  if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
      $password_err = "Passwords should match";
  }

  // Check for Address
  if (empty(trim($_POST['address']))) {
    $address_err = "Address cannot be blank";
  } else {
      $address = trim($_POST['address']);
  }

  // Check for City
  if (empty(trim($_POST['city']))) {
      $city_err = "City cannot be blank";
  } else {
      $city = trim($_POST['city']);
  }

  // Check for State
  if (empty(trim($_POST['state']))) {
      $state_err = "State cannot be blank";
  } else {
      $state = trim($_POST['state']);
  }


  // If there were no errors, go ahead and insert into the database
  if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
  {
      $sql = "INSERT INTO users (username, password, address, city, state) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      if ($stmt) {
          mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_address, $param_city, $param_state);

          // Set these parameters
          $param_username = $username;
          $param_password = password_hash($password, PASSWORD_DEFAULT);
          $param_address = $address;
          $param_city = $city;
          $param_state = $state;

          // Try to execute the query
          if (mysqli_stmt_execute($stmt))
          {
              header("location: login.php");
          }
          else{
              echo "Something went wrong... cannot redirect!";
          }
      }
      mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
  }

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PHP login system!</title>
    <style>
        .other_than_nav {
        margin-top: 60px;
        }

        .rounded-container {
          width: 1300px; /* Set the width of your container */
          height: 600px; /* Set the height of your container */
          background-color: #f0f0f0; /* Set the background color */
          border-radius: 5px; /* Adjust the border-radius to control the roundness of corners */
          padding: 20px; /* Add padding for content inside the container */
          display: flex;
          margin: 80px 60px 80px 70px;
        }
        .subcontainer1 {
          flex: 3;
        }
        #banner1 {
          width: 700px;
          margin-top: 30px;
          margin-left: 15px;
          border-radius: 15px;
        }
        .subcontainer2 {
          margin-top: 40px;
          padding-left: 20px;
          margin-bottom: 120px;
          flex: 2;
          border-left: 1px solid white;
        }
        .form-group {
          width: 250px;
        }
        #submitbtn {
          height: 30px;
          margin-top: 10px;
          margin-left: 0px;
        }
        .btn-custom {
          height: 35px;
        }
        .loginbtn {
          margin-left: 40px;
          margin-top: 10px;
        }
    </style>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#"> PFM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
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
        <a class="nav-link" href="./budget.php">Budgets <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./investment.php">Investment <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./bin.php">Bin <span class="sr-only"></span></a>
      </li>
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
  </nav>

  <!-- Content inside page -->
<div class="other_than_nav">
<div class = "rounded-container bg-dark text-white">
  <div class="subcontainer1">
  <img src="./images/pfm_banner2.png" id="banner1">
  </div>

  <div class="subcontainer2">
  <h3>Please Register Here:</h3>
  <hr>
  <form action="" method="post">
      <div class="form-group">
        <label for="inputEmail4">Username</label>
        <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Email">
      </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" name ="password" id="inputPassword4" placeholder="Password">
      </div>
    <div class="form-group col-md-6">
        <label for="inputPassword4">Confirm Password</label>
        <input type="password" class="form-control" name ="confirm_password" id="inputPassword" placeholder="Confirm Password">
      </div>
    </div>
    <div class="form-group">
      <label for="inputAddress2">Address 2</label>
      <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputCity">City</label>
        <input type="text" class="form-control" id="inputCity">
      </div>
      <div class="form-group col-md-6">
        <label for="inputState">State</label>
        <select id="inputState" class="form-control">
        <option selected></option>
        <option value="Andhra Pradesh">Andhra Pradesh</option>
        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
        <option value="Assam">Assam</option>
        <option value="Bihar">Bihar</option>
        <option value="Chhattisgarh">Chhattisgarh</option>
        <option value="Goa">Goa</option>
        <option value="Gujarat">Gujarat</option>
        <option value="Haryana">Haryana</option>
        <option value="Himachal Pradesh">Himachal Pradesh</option>
        <option value="Jharkhand">Jharkhand</option>
        <option value="Karnataka">Karnataka</option>
        <option value="Kerala">Kerala</option>
        <option value="Madhya Pradesh">Madhya Pradesh</option>
        <option value="Maharashtra">Maharashtra</option>
        <option value="Manipur">Manipur</option>
        <option value="Meghalaya">Meghalaya</option>
        <option value="Mizoram">Mizoram</option>
        <option value="Nagaland">Nagaland</option>
        <option value="Odisha">Odisha</option>
        <option value="Punjab">Punjab</option>
        <option value="Rajasthan">Rajasthan</option>
        <option value="Sikkim">Sikkim</option>
        <option value="Tamil Nadu">Tamil Nadu</option>
        <option value="Telangana">Telangana</option>
        <option value="Tripura">Tripura</option>
        <option value="Uttar Pradesh">Uttar Pradesh</option>
        <option value="Uttarakhand">Uttarakhand</option>
        <option value="West Bengal">West Bengal</option>
        </select>
      </div>
    </div>
    <!-- <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck">
        <label class="form-check-label" for="gridCheck">
          Check me out
        </label>
      </div>
    </div> -->
    
    <div class="form-row" id="submitbtn">
      <button type="submit" class="btn btn-primary btn-custom">Regsiter</button>
        <div class="loginbtn">
          <p>Already register<a href="./login.php" style="color: grey;"> Login </a></p>
        </div>
    </div>
  </form>
</div>

</div>
</div> <!-- here other than nav ends -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
