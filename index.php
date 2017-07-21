<?php require_once("classes/Crud.php"); ?>
<!DOCTYPE html>
<html>
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="GALERIA AV3" />
    <meta name="robots" content="index, follow" />
    <meta name="author" content=", Raysse Cutrim " />
    <script src="ajax/jquery.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!--<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />-->
    
    <meta charset="UTF-8">
    <title>Galeria </title>
</head>

<body>
    <?php
    include_once 'upload.php';
    ?>
 
    <div class="container"> 



        <h1> GALERIA DE FOTOS </h1>
        <form action="" method="post" enctype="multipart/form-data">
            <br><br>
            Nome da Foto: <br>
            <input type="text" name="nome_foto" placeholder="Digite o Nome da foto"> <br>

            E-mail: <br>
            <input type="text" name="email" placeholder="Digite seu E-mail"><br>

            <br>

            Escolha sua foto: <br>
            <input type="file" name="img">
            <br><br>
            <input type="reset" value="Limpar">

            <input type="submit" name="Enviar">  
            
        </form>
            
           
            <table width="100%">
                <span style="margin-left:5xp;"> FOTOS POSTADAS: </span>
                <span style="height:1px; width:100%; display:block; margin-bottom:30px"></span>
            
       <?php
           $sqlRead = "SELECT * FROM fotos ORDER BY id_foto DESC";
           try{
               $sqlReady = DB::getInstance()->prepare($sqlRead);
               $sqlReady->execute();
           } catch (PDOException $e){
               echo $e->getMessage();
           }
           while ($rs = $sqlReady->fetch(PDO::FETCH_OBJ)){
        ?>
               
        <div class="imagem">
            <img src="Imagens/<?php echo $rs->imagem?>" width="150" />
            <div
                <div style="padding-top: 10px"></div>
                <a href="deleta.php?id_foto=<?php echo $rs->id_foto ?>"><button>Deletar Imagem</button></a>  
        </div>
           
       <?php
           }
      ?>
       
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/jQuery.js"></script>
</body>
</html>