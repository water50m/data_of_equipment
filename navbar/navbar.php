<?php
session_start();
$status = $_SESSION['user_statud'] 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.rtl.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Document</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary" aria-label="Fifth navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="../view/home.php">Storage</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05"
        aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        </ul>

        <div class="d-flex">
          <div style="margin-right:20px;">
            Welcome <?php echo $_SESSION['user_name'] ?>
          </div>
          <div>
            <button class="btn btn-primary">
              <a href="../module/logout.php" class="nav-link" style="color: white; text-decoration: none;">Logout</a>
            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <nav class="navbar navbar-expand-lg navbar-light bg-body-secondary" aria-lel="Fifth navbar example">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a href="../view/home.php" class="nav-link active" aria-current="page">Home</a>
          </li>

          <!-- user -->
          <li class="nav-item">
            <a href="../view/Equepment.php" class="nav-link">Equipment</a>
          </li>
          <li class="nav-item">
            <a href="../view/ui_withdraw_item.php" class="nav-link">All Withdraw </a>
          </li>
          <li class="nav-item">
            <a href="../view/history.php" class="nav-link">History</a>
          </li>
       

          <!-- admin and hight level user -->
          <?php
          if ($status == 0 or $status == 1  ) {
          ?>
            <li class="nav-item">
              <a href="../view/add_data.php" class="nav-link">Add Equipment</a>
            </li>
            <li class="nav-item">
              <a href="../view/ui_withdraw.php" class="nav-link">Withdraw </a>
            </li>
            <?php
          }
          ?>

          <!-- admin -->
        <?php
          if ($status == 0) {
              ?>
              <li class="nav-item">
                <a href="../view/show_user.php" class="nav-link">User</a>
              </li>
  
          <?php
            }else{
  
            }
          ?>

        </ul>
      </div>
    </div>
  </nav>
</body>

</html>

