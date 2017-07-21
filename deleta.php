<?php
require_once 'classes/Crud.php';

     $id_foto = $_GET['id_foto'];
     $sqlRead = "SELECT *FROM fotos WHERE id_foto=:id_foto";
     try{
         $sqlReady = DB::getInstance()->prepare($sqlRead);
         $sqlReady->bindValue(':id_foto',$id_foto, PDO::PARAM_INT);
         $sqlReady->execute();
         
     } catch (PDOException $e){
         echo $e->getMessage();
     }
     while ($rs = $sqlReady->fetch(PDO::FETCH_OBJ)){
         $nome = $rs->imagem;
     }
     
     $sqlDel = "DELETE FROM fotos WHERE id_foto=:id_foto";
     try{
         $del = DB::getInstance()->prepare($sqlDel);
         $del->bindValue(':id_foto',$id_foto, PDO::PARAM_INT);
         if($del->execute()){
             $foi = true;
             unlink("Imagens/$nome");
         }else{
             $foi = false;
         }
     } catch (PDOException $e){
         echo $e->getMessage();
     }
     header("Location:index.php");
     
     
     

