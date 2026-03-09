<?php

$conn = mysqli_connect("localhost","root","","login_system");

$username=$_POST['username'];
$password=$_POST['password'];

$query="SELECT * FROM users WHERE username='$username' AND password='$password'";

$result=mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0)
{
header("Location: success.php");
}
else
{
echo "<script>
alert('Invalid Username or Password');
window.location='login.html';
</script>";
}

?>