<?php
include_once 'db_connect.php';
if(!isset($_SESSION['logado'])) {
    header("Location: index.php");
}

$sql = "SELECT * FROM enigmas ORDER BY RAND()";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/home.css">
    <script src="js/homee.js"></script>
    <script src="https://unpkg.com/boxicons@2.0.9/dist/boxicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300&family=ZCOOL+KuaiLe&display=swap" rel="stylesheet">
    <title>Umero</title>
</head>
<body style="height: 1000px;">
<style>
    #btnenviar {
        width: 100px;
        display: block;
        margin: auto;
        margin-bottom: 10px;
        background: #007bff;
        color: white;
        cursor: pointer;
        font-weight: 400;
        text-align: center;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        font-family: 'ZCOOL KuaiLe';
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>
    <nav>
        <span>?</span>     
        <h2>Umero</h2>
    </nav>
    <div class="container">
        <div class="enigma_con">
            <h1><?php echo $row['enigma_name']?></h1>
            <img id="img" src="enigma_imagens/<?php echo $row['enigma_imagem']? $row['enigma_imagem'] : ''?>" alt="<?php echo 'Sem Imagem'?>">
            <br>
            <h4><?php echo $row['enigma_conteudo']?></h4>
            <input type="text" placeholder="Insira a Resposta" class="value_resposta">
            <br>
            <input type="hidden" value="<?php echo $row['engima_resposta']?>" class="resposta">
            <p>Tipo: <?php echo $row['enigma_tipo']? $row['enigma_tipo'] : 'Tipo não especificado'?></p>
            <br>
            <button id="btnenviar" onclick="verificResponse()">Enviar</button>
            <p style="color: #28a745;" class="verific"></p>
            <p class="resCorrect"></p>
            <button onclick="retry()" id="btntry" style="display: none;">Tentar Novamente</button>
            <form id="form" style="display: none;">
                <button>Próxima</button>
            </form>
        </div>
    </div>
    <div class="container_icons">
        <a href="public_enigma.php">
            <box-icon
            onmouseover="setEffectIconTada()"
            class="bx-icon"
            name='message-alt-add'
            color='#fff'></box-icon>
        </a>
    </div>

    <script>
       
    </script>
</body>
</html>