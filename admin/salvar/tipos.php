<?php
    //Se não existir a variável page
    if(!isset($page)){
        exit;
    }

    if($_POST){
        //Recuperar os dados digitados
        $id = trim($_POST["id"] ?? NULL);
        $tipo = trim($_POST["tipo"] ?? NULL);

        //Verificar se o nome não está em branco
        if(empty($tipo)){
            mensagemErro(("Preencha o tipo de usuário."));
        }

        //Verificar se o tipo não está cadastrado
        $sql = "select id from tipo
                where tipo = :tipo and id <> :id
                limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":tipo", $tipo);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //Verificar se trouxe algum resultado
        if(!empty($dados->id)){
            mensagemErro("Já existe um tipo cadastrado com este nome.");
        }

        //Verificar se irá inserir ou atualizar
        if(empty($id)){
            $sql = "insert into tipo (tipo) values (:tipo)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":tipo", $tipo);
        } else{
            $sql = "update tipo
                    set tipo = :tipo
                    where id = :id
                    limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":tipo", $tipo);
            $consulta->bindParam(":id", $id);
        }

        if(!$consulta->execute()){
            mensagemErro("Não foi possível salvar os dados.");
        }
        echo "<script>location.href='listar/tipos';</script>";
        exit;
    }

    //Mostrar uma mensagem de erro
    mensagemErro("Requisição inválida");
?>