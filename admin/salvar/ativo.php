<?php
    //Se não existir a variável page
    if(!isset($page)){
        exit;
    }

    //Verificar se a categoria já não está cadastrada
        $sql = "select * from usuario
                where id = :id
                limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //Verificar se trouxe algum resultado
        if($dados->ativo === 'S'){
            $ativo = 'N';
        } else {
            $ativo = 'S';
        }
            
            $sql = "update usuario 
                    set ativo = :ativo 
                    where id = :id 
                    limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":id", $id);

        if(!$consulta->execute()){
            mensagemErro("Não foi possível salvar os dados.");
        }
        echo "<script>location.href='listar/usuarios';</script>";
        exit;
?>