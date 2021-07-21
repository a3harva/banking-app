<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Transfer History</title>
    <link rel="shortcut icon" type="image" href="images/logo.png">
    <!-- Bootstrap CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
   <?php include 'navigation_bar.php' ?>

   <div class="container py-5">
  <header class="text-center text-white">
    <h1 class="display-4">Transfer History <a href="#" class="btn btn-info btn-lg" style="background-color: #1c2939;">
          <span class="glyphicon glyphicon-repeat"></span> 
        </a></h1>
  </header>
   <div class="row py-6">
    <div class="col-lg-10 mx-auto">
      <div class="card rounded shadow border-0">
        <div class="card-body p-5 bg-white rounded">
          <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered">
              <thead style="background-color: #1c2939; color:white;">
                <tr>
                  <th>Serial No.</th>
                  <th>Sender</th>
                  <th>Receiver</th>
                  <th>Amount</th>
                  <th>Date/Time</th>
                </tr>
              </thead>
              <tbody>
			  <?php

            include 'connection.php';

            $sql ="select * from trans_history";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
         ?>
                <tr>
                  <td><?php echo $rows['id'] ?></td>
                  <td><?php echo $rows['sender']?></td>
                  <td><?php echo $rows['receiver']?></td>
                  <td><?php echo $rows['amount']?></td>
                  <td><?php echo $rows['datetime']?></td>
				</tr>
				<?php
            }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
        </div>

   <?php include 'footer.php' ?>
</body>
</html>