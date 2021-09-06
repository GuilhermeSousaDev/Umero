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
    <script src="https://unpkg.com/boxicons@2.0.9/dist/boxicons.js"></script>
    <title>Random Enigmas</title>
</head>
<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }        
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 600px;
        }
        .container_icons {
            position: absolute;
             right: 0; 
             bottom: 0; 
             margin-bottom: 110px; 
             margin-right: 110px;
        }
        .enigma_con {
            width: 300px;
        }
        .bx-icon {
            transform: scale(2.5);
            cursor: pointer;
        }
        #img {
            width: 200px; 
            height: 200px;
        }
    </style>
    <nav>
        <h2>Umero</h2>
    </nav>
    <div class="container">
        <div class="enigma_con">
            <p class="verific"></p>
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
            color='#151516'></box-icon>
        </a>
    </div>

    <script>
       function verificResponse() { 
           const form = document.getElementById('form')
           const btnTry = document.getElementById('btntry')
           const btnEnviar = document.getElementById('btnenviar')
           const response = document.querySelector('.verific')
           const resCorrect = document.querySelector('.resCorrect')
           const responseUser = document.querySelector('.value_resposta').value
           const responseCorrect = document.querySelector('.resposta').value
            if(responseUser === responseCorrect) {
                response.innerHTML = `Resposta Correta`
                btnEnviar.style.display = 'none'
                form.style.display = 'block'
                resCorrect.innerHTML = `Resposta correta: ${responseCorrect}`
           }else {
                response.innerHTML = `Resposta Errada`
                btnTry.style.display = 'block' 
                btnEnviar.style.display = 'none'            
           }
        }
        function retry() {
            document.getElementById('btntry').style.display = 'none'
            document.getElementById('btnenviar').style.display = 'block'
            const responseUser = document.querySelector('.value_resposta')
            responseUser.focus()
            responseUser.value = ''
        }
        function setEffectIconTada() {
            const bx_icon = document.querySelector('.bx-icon')
            bx_icon.setAttribute('animation','tada')
            bx_icon.addEventListener('mouseout', () => {
                bx_icon.setAttribute('animation','')
            })
        }
    </script>
</body>
</html>