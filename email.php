<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    mail("montieliv@gmail.com", "Comentario de App Web GMAEC" .$email, $message);
?>