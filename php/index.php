<?php  

function verfie($email,$body,$subject){ 
     require_once 'mail.php';   
     $mail->setFrom('daoudi1999mohamed@gmail.com', 'corner'); 
     $mail->addAddress("$email"); 
     $mail->Subject = $subject;
     $mail->Body    ="$body"; 
     $mail->send(); 
    }   
 ?>