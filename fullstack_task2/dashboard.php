<?php
$conn = mysqli_connect("localhost","root","","student_dashboard");

$sort = "";
$dept = "";

if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
}

if(isset($_GET['dept'])){
    $dept = $_GET['dept'];
}

$query = "SELECT * FROM students";

if($dept != ""){
    $query .= " WHERE department='$dept'";
}

if($sort == "name"){
    $query .= " ORDER BY name";
}
elseif($sort == "date"){
    $query .= " ORDER BY join_date";
}

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
<style>
table{
border-collapse: collapse;
width:70%;
}
th,td{
border:1px solid black;
padding:8px;
text-align:center;
}
</style>
</head>

<body>

<h2>Student Data Dashboard</h2>

<form method="GET">
Sort By:
<select name="sort">
<option value="">None</option>
<option value="name">Name</option>
<option value="date">Join Date</option>
</select>

Filter Department:
<select name="dept">
<option value="">All</option>
<option value="CSE">CSE</option>
<option value="ECE">ECE</option>
<option value="EEE">EEE</option>
</select>

<input type="submit" value="Apply">
</form>

<br>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Department</th>
<th>Join Date</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['name']."</td>";
echo "<td>".$row['department']."</td>";
echo "<td>".$row['join_date']."</td>";
echo "</tr>";
}
?>

</table>

<br><br>

<h3>Students Count per Department</h3>

<?php
$count_query = "SELECT department, COUNT(*) as total FROM students GROUP BY department";
$count_result = mysqli_query($conn,$count_query);

while($row=mysqli_fetch_assoc($count_result)){
echo $row['department']." : ".$row['total']." students <br>";
}
?>

</body>
</html>