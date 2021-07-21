<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account Details</title>
    <link rel="shortcut icon" type="image" href="images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
<?php
    include 'connection.php';
    $sql = "SELECT * FROM new_account";
    $result = mysqli_query($conn,$sql);
?>
   <?php include 'navigation_bar.php' ?>
   
   <div class="container py-5">
  <header class="text-center text-white">
    <h1 class="display-4">Accounts <a href="#" class="btn btn-info btn-lg" style="background-color: #1c2939;">
          <span class="glyphicon glyphicon-list-alt"></span></a></h1>
  </header>
  <div class="row py-6">
    <div class="col-lg-10 mx-auto">
      <div class="card rounded shadow border-0">
        <div class="card-body p-5 bg-white rounded">
        <div class="form-group">
				<div class="input-group">
        <a href="#" class="btn btn-info btn-lg" style="background-color: #1c2939;">
          <span class="glyphicon glyphicon-search"></span> Search 
        </a>
					<input type="text" name="search_text" id="search_text" placeholder="Search by Account Details" class="form-control" style="width:100px; height:30px;font-size:13px;"/>
				</div>
			</div>
			<div id="result"></div>
		<div style="clear:both"></div>
        
        </div>
      </div>
    </div>
  </div>
</div>

    <?php include 'footer.php' ?>
</body>
</html>

<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"fetch.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
</script>