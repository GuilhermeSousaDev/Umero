<?php
    include_once 'db_connect.php';

    if(isset($_POST['enviar'])) {   
        $enigma_name = filter($_POST['enigma_name']);
        $enigma_tipo = filter($_POST['enigma_tipo']);
        $enigma_conteudo = filter($_POST['enigma_conteudo']);
        $enigma_resposta = filter($_POST['enigma_resposta']);
        if(empty($enigma_name) || empty($enigma_resposta) || empty($enigma_conteudo)) {
            $erros = "Preencha todos os campos";
        }else {
            $suport = array('jpg','png','jpeg');
            $extension = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
            if(in_array($extension,$suport)) {
                $pasta = 'enigma_imagens/';
                $temporario = $_FILES['imagem']['tmp_name'];
                $newName = uniqid() . ".$extension";
                if(move_uploaded_file($temporario,$pasta.$newName)) {
                    $user_id = $_SESSION['user_id'];
                    $sql = "INSERT INTO enigmas(user_id,enigma_name,enigma_tipo,enigma_conteudo,engima_resposta,enigma_imagem) 
                    VALUES('$user_id','$enigma_name','$enigma_tipo','$enigma_conteudo','$enigma_resposta','$newName')";
                    mysqli_query($conn,$sql);
                    if(mysqli_affected_rows($conn) > 0) {
                        echo "Upload realizado com Sucesso";
                    }else {
                        $erros = "Erro ao fazer upload";
                    }
                }
            }else {
                $erros = "Envie um arquivo jpg, png ou jpeg :)";
            }
        }
    }

    function filter($input) {
        global $conn;
        $data = stripslashes($input);
        $data = trim($data);
        $data = mysqli_escape_string($conn,$data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar - Enigma</title>
</head>
<body>
    <nav>

    </nav>
    <div>
        <h1>Publique um Enigma Indescifrável</h1>
        <form action="" method="POST" enctype="multipart/form-data">
           <p style="color: red;"><?php echo !empty($erros)? $erros : ''?></p>
           <p>Pense em qualquer Nome</p> <input type="text" name="enigma_name" placeholder="Nome">
           <p>Selecione o tipo de enigma</p> <select name="enigma_tipo" id="type">
               <option value="Charada">Charada</option>
               <option value="Mistério">Mistério</option>
               <option value="Lógica">Lógica</option>
               <option value="Conhecimentos">Conhecimentos</option>
               <option value="Matemática">Matemática</option>
           </select>
           <p></p> <textarea name="enigma_conteudo" placeholder="Enigma"></textarea>
           <p>Seu enigma tem uma imagem? Arraste uma, ou escolha clicando aqui</p> <input type="file" name="imagem">
           <p>Agora a resposta do seu enigma</p>
           <p>Escreva uma única palavra como resposta se possível</p><input type="text" name="enigma_resposta" placeholder="Resposta">
           <button type="submit" name="enviar">Publicar</button>
        </form>
    </div>
</body>
</html>