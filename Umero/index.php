<?php
include_once 'db_connect.php';

if(isset($_POST['enviar'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    if(empty($username) || empty($email) || empty($senha)) {
        $erros = "Preencha todos os Campos";
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
                $erros = "Email ou Senha Incorretos";
            }
        }else {
            $erros = "Usuário não existe";
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
    <script src="js/index.js"></script>
    <script src="https://unpkg.com/boxicons@2.0.9/dist/boxicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300&family=ZCOOL+KuaiLe&display=swap" rel="stylesheet">
    <title>Umero</title>
</head>
<body>
    <h1 style="text-align: center; color: white; font-family: 'ZCOOL KuaiLe'; margin-top: 20px;">? Umero Puzzles ?</h1>
    <div class="container">
        <form action="" method="POST">
            <div class="img">
                <h1>Login</h1>
                <img src="undraw_quiz_nlyh.svg">
            </div>
            <div class="form">
                <p style="margin-bottom: 15px;" class="erro"><?php echo !empty($erros)? $erros : ''?></p>
                <input type="text" name="username" placeholder="Nome">
                <input type="email" name="email" placeholder="Email">
                <input id="senha" type="password" name="senha" placeholder="Senha">
                <button type="submit" name="enviar">Entrar</button>
                <button name="create">Criar Conta</button>
            </div>
        </form>
    </div>
    <script>
        function showPassword() {
            const inp = document.getElementById('senha')
            inp.type == 'text'? inp.type = 'password' : inp.type = 'text'
        }
    </script>
</body>
</html>