
<?php 
$conn=mysqli_connect("localhost","root","","sei_babi_om_bai");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
