<?php
    if(!isset($page)) exit;

    //Selecionar as imagens
    $sql = "select imagem1, imagem2 from produto
            where id = :id limit 1";
    $consultaImagem = $pdo->prepare($sql);
    $consultaImagem->bindParam(":id", $id);
    $consultaImagem->execute();

    $dados = $consultaImagem->fetch(PDO::FETCH_OBJ);

    $imagem1 = "../produtos/{$dados->imagem1}";
    $imagem2 = "../produtos/{$dados->imagem2}";

    $sql = "delete from produto
            where id = :id limit 1";
    $consultaProdutos = $pdo->prepare($sql);
    $consultaProdutos->bindParam(":id", $id);

    //Verificar se consegue executar
    if($consultaProdutos->execute()){
        //Excluir os arquivos
        if(file_exists($imagem1)){
            unlink($imagem1);
        }

        if(file_exists($imagem2)){
            unlink($imagem2);
        }

        echo "<script>location.href='listar/produtos';</script>";
    } else{
        mensagemErro("Não foi possível excluir.");
    }
?>