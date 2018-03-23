<?php
	function sendmail($to,$name,$msg){

			//Create a new PHPMailer instance
			$mail = new PHPMailer;
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			// use
			// $mail->Host = gethostbyname('smtp.gmail.com');
			// if your network does not support SMTP over IPv6
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "franky16081996@gmail.com";
			//Password to use for SMTP authentication
			$mail->Password = "fr@nkyis@c@";
			//Set who the message is to be sent to
			$mail->addAddress($to,$name);
			//Set the subject line
			$mail->Subject = 'Forgot Password';
			//Read an HTML message body from an external file, convert referenced images to embedded,
			// //convert HTML into a basic plain-text alternative body
			$mail->msgHTML($msg);
			// //Attach an image file
			// $mail->addAttachment('images/phpmailer_mini.png');
			//send the message, check for errors
			if (!$mail->send()) {
			    return false;
			} else {
			    return true;
			}

		}
?>