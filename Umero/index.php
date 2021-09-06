<?php
include_once 'db_connect.php';

if(isset($_POST['enviar'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    if(empty($username) || empty($email) || empty($senha)) {
        $erros = "<p style='color: red'>Preencha todos os Campos</p>";
    }else {
        $sql = "SELECT username FROM usuarios WHERE username = '$username'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0) {
            $senha = md5($senha);
            $sql = "SELECT * FROM usuarios WHERE username = '$username' AND email = '$email' AND senha = '$senha'";
            $result_enter = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result_enter) == 1) {
                $row = mysqli_fetch_array($result_enter);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['logado'] = true;
                header("Location: home.php");
            }else {
                $erros = "<p style='color: red'>Email ou Senha Incorretos</p>";
            }
        }else {
            $erros = "<p style='color: red'>Usuário não existe</p>";
        }
    } 
} 
if(isset($_POST['create'])) {
    header("Location: cadastrar.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <title>Login</title>
</head>
<body>
    <form action="" method="POST">
        <?php echo !empty($erros)? $erros : ''?>
        <input type="text" name="username" placeholder="Insira seu username...">
        <input type="email" name="email" placeholder="Insira seu email...">
        <input id="senha" type="password" name="senha" placeholder="Insira sua senha...">
        <button type="submit" name="enviar">Entrar</button>
        <button name="create">Criar Conta</button>
    </form>
    <button onclick="showPassword()">Mostrar</button>
    <script>
        function showPassword() {
            const inp = document.getElementById('senha')
            inp.type == 'text'? inp.type = 'password' : inp.type = 'text'
        }
    </script>
</body>
</html>