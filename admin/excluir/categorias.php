<?php
    //Se não existir a variável page
    if(!isset($page)) exit;

    //Verificar se existe um produto cadastrado
    $sql = "select id from produto
            where categoria_id = :id limit 1";
    //Preparar o SQL para execução com o banco
    $consulta = $pdo->prepare($sql);
    //Passar o parametro
    $consulta->bindParam(":id", $id);
    //Executar o SQL
    $consulta->execute();

    $produto = $consulta->fetch(PDO::FETCH_OBJ);

    //Verificar se existe um produto
    if(!empty($produto->id)){
        mensagemErro("Não foi possível excluir esta categoria, pois existe um produto relacionado a ela.");
    }

    //SQL para exclusão
    $sql = "delete from categoria
            where id = :id limit 1";
    $consultacategoria = $pdo->prepare($sql);
    $consultacategoria->bindParam(":id", $id);

    //Verificar se consegue executar
    if($consultacategoria->execute()){
        //Encaminhar para a tela de listagem
        echo "<script>location.href='listar/categorias';</script>";
        exit;
    } else {
        mensagemErro("Nãoa foi possível excluir.");
    }
?>