<?php
include_once 'db_connect.php';

if(isset($_POST['enviar'])) {
    $username = filter($_POST['username']);
    $email = filter($_POST['email']);
    $senha = filter($_POST['senha']);
    if(empty($username) || empty($email) || empty($senha)) {
        $erros = "<p style='color: red'>Preencha todos os Campos</p>";
    }else {
        $sql = "SELECT email FROM usuarios WHERE email = '$email'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 1) {
            $erros = "<p style='color: red'>Esse email já existe</p>";
        }else {
            $sql = "INSERT INTO usuarios(username,email,senha) VALUES('$username','$email','$senha')";
            $result = mysqli_query($conn,$sql);
            if(mysqli_affected_rows($conn) > 0) {
                echo "Cadastrado com Sucesso";
            }else {
                echo "Erro ao Cadastrar";
            }
        }
    }
}
function filter($input) {
    global $conn;
    $data = trim($input);
    $data = stripslashes($data);
    $data = mysqli_escape_string($conn,$data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST['login'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <title>Cadastrar</title>
</head>
<body>
    <form action="" method="POST" oninput="ajax()">
        <?php echo !empty($erros)? $erros : ''?>
        <p class="res"></p>
        <input type="text" name="username" placeholder="Username...">
        <input id="email" type="email" name="email" placeholder="Email...">
        <input type="password" name="senha" placeholder="Senha...">
        <button type="submit" name="enviar">Criar</button>
        <button name="login">Login</button>
    </form>
    <script>
        function ajax() {
            const xhttp = new XMLHttpRequest()
            xhttp.onload = () => {
                const res = document.querySelector('.res')
                res.innerHTML = xhttp.responseText
            }
            const email = document.getElementById('email').value
            xhttp.open("POST","create_user.php")
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            xhttp.send('email=' + email)
        }
    </script>
</body>
</html>