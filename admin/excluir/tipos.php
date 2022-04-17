<?php
    //Se não existir a variável page
    if(!isset($page)) exit;
    
    //SQL para exclusão
    $sql = "delete from tipo
            where id = :id limit 1";
    $consultatipo = $pdo->prepare($sql);
    $consultatipo->bindParam(":id", $id);

    //Verificar se consegue executar
    if($consultatipo->execute()){
        //Encaminhar para tela de listagem
        echo "<script>location.href='listar/tipos';</script>";
        exit;
    } else {
        mensagemErro("Não foi possível excluir.");
    }
?>