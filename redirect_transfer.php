<?php
include 'connection.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from new_account where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from new_account where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
      $_SESSION['status4']="Wrong value";
      $_SESSION['status_code']="error";
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['amount']) 
    {
        
      $_SESSION['status3']="Wrong value";
      $_SESSION['status_code']="error";
    }
    


    // constraint to check zero values
    else if($amount == 0){

      $_SESSION['status2']="Wrong value";
      $_SESSION['status_code']="error";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['amount'] - $amount;
                $sql = "UPDATE new_account set amount=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['amount'] + $amount;
                $sql = "UPDATE new_account set amount=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO trans_history(`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                  $_SESSION['status1']="Added Succesfully";
                  $_SESSION['status_code']="success";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Transfer Money</title>
    <link rel="shortcut icon" type="image" href="images/logo.png">
    <!-- Bootstrap CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>

<body>
 
<?php
  include 'navigation_bar.php';
?>

	<div class="container">
        <h2 class="text-center pt-4" style="color : black;">Please Choose Account  <a href="#" class="btn btn-info btn-lg" style="background-color: #1c2939;">
          <span class="glyphicon glyphicon-user"></span> 
        </a></h2>
            <?php
                include 'connection.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  new_account where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
        <div class="row py-6">
    <div class="col-lg-10 mx-auto">
      <div class="card rounded shadow border-0">
        <div class="card-body p-5 bg-white rounded">
          <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered">
              <thead style="background-color: #1c2939; color:white;">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>E-Mail</th>
                  <th>Balance</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $rows['id'] ?></td>
                  <td><?php echo $rows['name']?></td>
                  <td><?php echo $rows['email']?></td>
                  <td><?php echo $rows['amount']?></td>
				</tr>
              </tbody>
            </table>
            <br><br>
            <table style="width:100%" class="table table-striped table-bordered">
                <tr>
                <td><label style="color : black;"><b>Transfer To:</b></label></td>
                </tr>
                <tr>
                    <td>
                                <select name="to" class="form-control" style="font-size:13px;" required>
                        <option value="" disabled selected >Please Select</option>
                        <?php
                            include 'config.php';
                            $sid=$_GET['id'];
                            $sql = "SELECT * FROM new_account where id!=$sid";
                            $result=mysqli_query($conn,$sql);
                            if(!$result)
                            {
                                echo "Error ".$sql."<br>".mysqli_error($conn);
                            }
                            while($rows = mysqli_fetch_assoc($result)) {
                        ?>
                            <option class="table" style="font-size:13px;" value="<?php echo $rows['id'];?>" >
                            
                                <?php echo $rows['name'] ;?> (Balance: 
                                <?php echo $rows['amount'] ;?> ) 
                        
                            </option>
                        <?php 
                            } 
                        ?>
                        <div>
                    </select>
                </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:center"><label style="color : black;"><b>Amount:</b></label><input type="number" class="form-control" name="amount" style="width:100px; height:30px; margin : 0 auto; font-size:13px;" required></td>
                </tr>
            </table>
            <div class="text-center" >
            <button class="btn btn-primary btn-lg" name="submit" type="submit" id="myBtn" >Transfer</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
        </div>
    <?php
  include 'footer.php'; ?>
</body>
</html>