<?php

    require_once 'classes/DB.php';

    
if(isset($_POST['Enviar'])){
    $nome_foto = $_POST['nome_foto'];
    $email = $_POST['email'];
    //INFO IMAGEM
    $imagem = $_FILES['img'];
    $tmp = $imagem['tmp_name'];
    $nome = $imagem['name'];
    $arr = explode('.',$nome);
    $formato = end($arr);
    
      //DEFINIÇÕES DA IMAGEM
    $pasta = 'Imagens';
    $extensoes = array('jpg','jpeg','png');
    
    //VALIDAÇÃO DOS CAMPOS
    if(empty($nome_foto) || empty($email)){
        echo '<script>alert("Preencha todos os campos!");</script>';
    }elseif(empty($nome)){
        echo '<script>alert("Selecione uma Imagem!");</script>';
    }elseif(!in_array ($formato, $extensoes)){
        echo '<script>alert("Imagem em Formato Inválido!");</script>';
    }else{
        $nome = "GALERIA".'.'.$nome_foto.uniqid().'.'.$formato;
    }
      
    if(move_uploaded_file($_FILES['img']['tmp_name'], "Imagens/".$nome)){
        $sql = "INSERT INTO fotos (nome_foto,email,imagem) VALUES (:nome_foto,:email,:nome)";
        try{
            $read = DB::getInstance()->prepare($sql); 
            $read->bindValue(':nome_foto',$nome_foto, PDO::PARAM_STR);
            $read->bindValue(':email',$email, PDO::PARAM_STR);
            $read->bindValue(':nome',$nome, PDO::PARAM_STR);
            if($read->execute()){
                echo '<script>alert("Imagem Enviada!");</script>';
            }else{
                echo '<script>alert("Falha ao Enviar a Imagem!");</script>';
                //Se não enviar para o banco, não salva na pasta.
                unlink("Imagens/$nome");
            }
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
        }
    }

