<?php
$connect = mysqli_connect("localhost", "root", "", "bodima");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM boarding_post 
	WHERE category LIKE '%".$search."%'
	OR girlsBoys LIKE '%".$search."%' 
	OR person_count LIKE '%".$search."%' 
	OR cost_per_person LIKE '%".$search."%' 
	OR lane LIKE '%".$search."%'
	OR city LIKE '%".$search."%'
	OR district LIKE '%".$search."%'
	OR description LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM boarding_post ORDER BY B_post_id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>No</th>
							<th>Address</th>
							<th>City</th>
							<th>girls/boys</th>
							<th>cost per person</th>
							<th>description</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["B_post_id"].'</td>
				<td>'.$row["lane"].', '.$row["city"].'</td>
				<td>'.$row["city"].'</td>
				<td>'.$row["girlsBoys"].'</td>
				<td>'.$row["cost_per_person"].'</td>
				<td>'.$row["description"].'</td>
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'Search with another keyword';
}
?>