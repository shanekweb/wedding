<?php
#print_r($_POST); exit;
if(!$_POST) exit;
if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");



$name     = $_POST['name'];
$email = $_POST['email'];
$phone   = $_POST['phone'];
$guests   = $_POST['guests'];
$subject  = $_POST['subject'];
$comments = $_POST['comments'];
$verify   = $_POST['verify'];




if(trim($name) == '') {
	echo '<div class="error_message">Attention! You must enter your name.</div>';
	exit();
} if(trim($phone) == '') {
	echo '<div class="error_message">Attention! Total Attending Missing.</div>';
	exit();
}	else if(!is_numeric($phone)) {
	echo '<div class="error_message">Total Attending can only contain digits.</div>';
	exit();
}
if(trim($subject) == '') {
	echo '<div class="error_message">Attention! Will you be attending?</div>';
	exit();
} else if(!isset($verify) || trim($verify) == '') {
	echo '<div class="error_message">Attention! Please enter the verification number.</div>';
	exit();
} else if(trim($verify) != '2') {
	echo '<div class="error_message">Attention! The verification number you entered is incorrect.</div>';
	exit();
}

if(get_magic_quotes_gpc()) {
	$comments = stripslashes($comments);
}



$address = "louiseandshane2014@gmail.com";

$e_subject = 'You\'ve been contacted by ' . $name . '.';




$e_body = "You have been contacted by $name with regards to $subject, their dietary requirements are as follows." . PHP_EOL . PHP_EOL;
$e_content = "\"$comments\"" . PHP_EOL . PHP_EOL;
$e_reply = "$name's additional guests are $guests and total attending is $phone. You can reply to $email";




$msg = wordwrap( $e_body . $e_content . $e_reply, 70, PHP_EOL);

$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;





if(mail($address, $e_subject, $msg, $headers)) {

	echo "<fieldset>";
	echo "<div id='success_page'>";
	echo "<h1>Email Sent Successfully.</h1>";
	echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us.</p>";
	echo "</div>";
	echo "</fieldset>";

} else {

	echo 'ERROR!';

}