<?php
if(!empty($_POST["register-user"])) {
	foreach($_POST as $key=>$value) {
		if(empty($_POST[$key])) {
		$error_message = "All Fields are required";
		break;
		}
	}	
if(!isset($error_message)) {
		if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		$error_message = "Invalid Email Address";
		}
	}
if(!isset($error_message)) {
	if(!isset($_POST["gender"])) {
	$error_message = " All Fields are required";
	}
	}
if(!isset($error_message)) {
		require_once("dbcontroller.php");
		require_once ('vendor/autoload.php');
		$db_handle = new DBController();



			//$resul  = mysqli_query("select id from registered_users LIMIT 1,1");
		//$rowcount = mysqli_num_rows("select * from registered_users");

	
		$id = $rowcount + 1; 
		$email = $_POST["email"];
		$DOB = $_POST["dob"];
		$contact = $_POST["contact"];
		$unique_id = "cnjdkfndj".$id.$contact;
	
		
		$query = "INSERT INTO registered_users (Name,school,course,contact,dob, gender,email,unique_id) VALUES
		('" . $_POST["Name"] . "', '" . $_POST["school"] . "', '" . $_POST["course"] . "', '" . md5($_POST["contact"]) . "', '" . $_POST["dob"] . "', '" . $_POST["gender"] . "','" . $_POST["email"] . "','".$unique_id."')";
		$result = $db_handle->insertQuery($query);

		if(!empty($result)) {
			$error_message = "";
			$success_message = "You have registered successfully!";	
			unset($_POST);
		} else {
			$error_message = "Problem in registration. Try Again!";	
		}
	

$from = new SendGrid\Email("FROM_NAME", "nehakansal1005@gmail.com");
$subject = "You are successfully registered with us";
$to = new SendGrid\Email("TO_NAME", $email);
$content = new SendGrid\Content("text/html", 
	" <p>Here would be the content<p>
	your unique id : {$unique_id} "
);

/*Response*/

$mail = new SendGrid\Mail($from, $subject, $to, $content);
$apiKey = ('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');
$sg = new \SendGrid($apiKey);
$response = $sg->client->mail()->send()->post($mail);

	



/*SendGrid Library*/


/*Post Data*/

/*Content*/
}
}
?>
<pre>
    <?php
    var_dump($response);
    ?>
</pre>


<!--Print the response-->
