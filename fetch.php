<?php
include 'connection.php';
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM new_account 
	WHERE ID LIKE '%".$search."%'
	OR name LIKE '%".$search."%' 
	OR email LIKE '%".$search."%' 
	OR amount LIKE '%".$search."%' 
	";
}
else
{
	$query = "
	SELECT * FROM new_account ORDER BY ID";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
				<table id="example" style="width:100%" class="table table-striped table-bordered">
				<thead style="background-color: #1c2939; color:white;">
					<tr>
					<th>ID</th>
					<th>Name</th>
					<th>E-Mail</th>
					<th>Balance</th>
					<th>Transfer</th>
					</tr>
				</thead>
				<tbody>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["id"].'</td>
				<td>'.$row["name"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.$row["amount"].'</td>
				<td style="text-align: center"><a href="redirect_transfer.php?id='.$row["id"].'"> <button type="button" class="btn btn-primary btn-lg" style="background-color : #1c2939; color:white;" >Transact</button></a></td>
		';
	}
		
	echo $output;	
}
else
{
	echo 'Account Not Found';
}
?>