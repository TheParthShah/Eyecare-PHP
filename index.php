<?php

	require('config/connect.php');
	require('config/password.php');
	db_connect();
	setcookie("login", NULL, -1);
	setcookie("menuactivate");
	$errorcheck = "0";

	if($_POST) {
		$errorcheck = "0";
		$username = strip_tags(substr($_POST['username'],0,32));
		$password = strip_tags(substr($_POST['password'],0,32));

		$query_user="SELECT UserId, Password FROM usermaster WHERE UserName='".$username."' LIMIT 1";
		$rows = db_query($query_user);

		if ($rows === false) {
			$error = db_error();		// Send the error to an administrator, log to a file, etc.
			session_destroy();
			$errorcheck = "1";
		}
		else {
			foreach ($rows as $key => $list) {
				$user_id = $list["UserId"];
				$user_pass = $list["Password"];
			}

			$cleanpw = crypt(md5($password),md5($username));

			echo "<br>cleanpw is $cleanpw | user_pass is $user_pass <br />";

			if($cleanpw == $user_pass) {
				$timelogin=date("Y-m-d H:i:s");
				$errorcheck = 0;
			}
			else {
				session_destroy();
				$errorcheck = "1";
			}
		}

		if($errorcheck == "0") {

			$_SESSION['usersid']=$user_id;
			$_SESSION['logged_in'] = true; //set you've logged in
			$_SESSION['last_activity'] = time(); //your last activity was now, having logged in.
			$_SESSION['expire_time'] = 6000; //expire time in seconds: e.g. 600 = 10 minutes

		//	loginquery = "INSERT INTO loggedin (DisplayName) VALUES ($username)";
			//logincode = db_query($loginquery);
			setcookie("login", $user_id, 0); // 0 means that the cookie will expire when the browser closes.

			$destination_url = "template.php";
			header("Location:$destination_url");
			exit;

		}
		else {
			$errorcheck = "1";
		}

   } // end of post if post
?>
<!DOCTYPE html>
<html>

   <head>
      <title>Login Page</title>

      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }

         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }

         .box {
            border:#666666 solid 1px;
         }
      </style>

   </head>

   <body bgcolor = "#FFFFFF">

      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

               <form action="" method="post">

               	<?php if($errorcheck == "1") {

                  echo"<label>Wrong User Name OR Password !</label><br /><br />";

               	} ?>

                  <label>Username  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type="Submit" name="Submit" value="    Login    ">
               </form>

            </div>

         </div>

      </div>

   </body>
</html>
