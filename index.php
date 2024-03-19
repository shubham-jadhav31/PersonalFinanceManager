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

    <title>Home page</title>
    <style>
      .other_than_nav {
        margin-top: 65px;
      }
      #nav_currentpage {
        border-bottom: 2px solid white; /* Adjust the size and color as needed */
      }
      .active {
        margin: 0px 5px;
      }
      .intro_words {
        font-size: 30px;
      }
      .intro_p {
        font-size: 20px;
        font-weight: 450;
      }
      img{
        border-radius: 0.25rem;
      }
      .about-heading , .erdiagram{
        margin-left: 70px;
        margin-top: 30px;
      }

      .rounded-container{
        height: 500px;
        width: 1000px;
        padding: 40px;
        margin-left: 100px;
        margin-top: 30px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
      }

      .flex-container {
          display: flex;
          justify-content: space-between;
          align-items: center;
          flex-wrap: wrap;
          max-width: 1200px;
          margin: 0 auto;
          
      }

      .box {
          height: 200px;
          background-color: #fff;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
          padding: 20px;
          margin: 10px;
          flex: 1;
          border-radius: 5px;
          border: 1px solid black;
      }
      .larger-box {
          
      }

      h2 {
          font-size: 1.5rem;
          margin-bottom: 10px;
      }

      p {
          font-size: 1rem;
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
        <a class="nav-link" href="./index.php" id="nav_currentpage">Home <span class="sr-only">(current)</span></a>
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
<div class="container mt-4">
  <h3 class="intro_words"><?php echo "Hey ". $_SESSION['username']?> !</h3>
  <p class="intro_p">Welcome to our Personal Finance Manager website!</br> We've created this platform with a singular goal in mind: to empower you in your journey toward financial success. Our website is designed for individuals like you who are seeking a more organized, efficient, and insightful approach to managing their finances.
    </br>
  So, go ahead, explore, and make the most of it. Your financial success is our ultimate reward. We hope you find it not only useful but also enjoyable to use. Welcome to a new chapter in your financial journey!</p>





  <hr>

  <div class="flex-container">
    <div class="box">
        <h2>Transaction Tracking</h2>
        <p>Keep a close watch on your day-to-day expenses and income, effortlessly monitoring your financial flows to understand where your money goes.</p>
    </div>
    <div class="box">
        <h2>Debt Management</h2>
        <p>Say goodbye to debt burdens by creating a plan to eliminate debts and regain financial peace.</p>
    </div>
    <div class="box">
        <h2>Budgeting</h2>
        <p>Get your financial goals in check by creating personalized budgets, tracking your spending, and staying on top of your financial aspirations.</p>
    </div>
  </div>
  <div class="flex-container">
    <div class="box">
    <h2>Investment Insights</h2>
    <p>Explore investment options, make informed decisions, and build a robust investment portfolio with our valuable resources and tools.</p>
    </div>
    <div class="box">
        <h2>Expense Analysis</h2>
        <p>Dive into your expenses, categorize them, and get a clear picture of your spending habits - the first step towards smarter spending.</p>
    </div>
    <div class="box">
        <h2>Income Monitoring</h2>
        <p>Know your financial health by closely tracking your income streams, maximizing your earnings, and understanding their contribution to your overall financial well-being.</p>
    </div>
    </div>
    
  <hr>

  <h2 class="erdiagram">ER Diagram </h2>
  <div class="rounded-container erdiagram">
    <img src="./images/ER_diagram (3).jpg" class="rounded-3" height="400" alt="ER Diagram">
  </div>

  <h2 class="about-heading">About us</h2>

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
  </body>
</html>