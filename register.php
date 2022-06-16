<?php
$name=$_POST['fname'];
$password=$_POST['password'];
$repassword=$_POST['repassword'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];

{
	$host ="localhost";
	$dbusername="root";
	$dbpassword="";
	$dbname="registration";

//connection
$conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
if(mysqli_connect_error()){
	die('Connect Error ('. mysqli_connect_errno().')' .mysqli_connect_error());
}
else{
	$SELECT ="SELECT email From reg Where email=? Limit 1 ";
	$INSERT = "INSERT Into surveydetails(name,password,repassword,email,mobile) values(?,?,?,?,?)";

	//prepare statement

	$stmt=$conn->prepare($SELECT);
	$stmt->bind_param("s",$email);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->store_result();
	$rnum=$stmt->num_rows;


	if($rnum==0){
		$stmt->close();
		$stmt = $conn->prepare($INSERT);
		$stmt->bind_param("sssss",$name,$password,$repassword,$email,$mobile);
		$stmt->execute();
		echo "new record inserted";

	}else{
		echo "already registered";
	} 
	$stmt->close();
	$conn->close();
}
} die();

?>