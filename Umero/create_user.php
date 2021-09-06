<?php
include_once 'db_connect.php';

if(isset($_POST)) {
    foreach($_POST as $email) {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            echo "Email Inválido";
        }else {
            $sql = "SELECT email FROM usuarios WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) == 1) {
                echo "Esse email já existe";
            }else {
                echo "Email Válido";
            }
        }
    }
}