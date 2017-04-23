<?php
	$connect = mysqli_connect("localhost","root","","demobtl1");
	if (!$connect) {
		echo "LỖi";
	}
	mysqli_set_charset($connect,"utf8");
	
	

	if (isset($_POST['submit'])) {
		$pattern = '/^-\'=;#[0-9A-Za-z]{4,10}/';
		if (preg_match($pattern, $_POST['password']) && preg_match($pattern, $_POST['username'])) {
			$name = $_POST['username'];
			$pass = $_POST['password'];
		}
		else {
			echo "<script>alert('username,password mustn\'t special symbols or blank');window.location='http://localhost/demoBtl1b.php';</script>";
			return;
		}
		

		$sql = "SELECT * FROM `account` WHERE username = '$name' AND password = '$pass';";
		$result = mysqli_query($connect,$sql);

		if (mysqli_num_rows($result) > 0) {
			$arr = mysqli_fetch_array($result,MYSQLI_NUM);
			echo "Welcom to <span>{$arr[0]}</span>";
			echo "<br><br>";
		}

		$sql_1 = "SELECT * FROM `profile_user` WHERE username = '$arr[0]';";
		$result1 = mysqli_query($connect,$sql_1);
		if (mysqli_num_rows($result1) > 0) {
			$arr_profile = mysqli_fetch_array($result1,MYSQLI_NUM);
		}

		echo 
		"
			<form>
				<table class='thongtin' border='1'>
					<tr>
						<td colspan='2'>Thông tin User</td>
					</tr>
					<tr>
						<td>Tên</td>
						<td>$arr_profile[1]</td>
					</tr>
					<tr>
						<td>Tuổi</td>
						<td>$arr_profile[2]</td>
					</tr>
					<tr>
						<td>Cmnd</td>
						<td>$arr_profile[3]</td>
					</tr>
					<tr>
						<td>Số điện thoại</td>
						<td>$arr_profile[4]</td>
					</tr>
					<tr>
						<td>Số thẻ tín dụng</td>
						<td>$arr_profile[5]</td>
					</tr>
					<tr>
						<td>Mật khẩu thẻ tín dụng</td>
						<td>$arr_profile[6]</td>
					</tr>
				</table>
				<br><br>
				<input type='submit' name='logout' value='Logout' onclick='logout'>
			</form>

		";

		echo 
		"
			<script>
				function logout() {
					window.location.reload();
				}
			</script>
		";
	}
	else {
		echo "
		<form action='demoBtl1b.php' method='post'>
			<table>
				<tr>
					<td colspan='2' align='center'><b>LOGIN</b></td>
				</tr>
				<tr>
					<td>User name:</td>
					<td>
						<input type='text' name='username'>
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td>
						<input type='text' name='password'>
					</td>
				</tr>
				<tr>
				<td></td>
					<td>
						<input type='submit' name='submit' value='Login'>
					</td>
				</tr>
			</table>
		</form>
		";
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		.thongtin {
			text-align: center;
			border-collapse: collapse;
		}

		span {
			color: red;
		}
	</style>
</head>
<body>
</body>
</html>