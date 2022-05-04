<?php
    //Se não existir a variável page
    if(!isset($page)){
        exit;
    }

    if($_POST){
        /* print_r($_POST);
        print_r($_FILES); */

        //Recuperar os dados enviados
        $id = trim($_POST['id'] ?? NULL);
        foreach($_POST as $key => $value){
            //echo "<p>$key - $value</p>";

            //Cria a variavel com o nome do campo e preenche com o valor passado (ou null).
            $$key = trim($value ?? NULL);
        }

        //Preparar os nomes dos arquivos
        $imagem1 = $_FILES["imagem1"]["name"] ?? NULL;
        $imagem2 = $_FILES["imagem2"]["name"] ?? NULL;

        //Validar os campos
        if(empty($valor)){
            mensagemErro("Preencha o valor.");
        } else if(empty($categoria_id)){
                mensagemErro("Selecione uma categoria.");
        } else if(empty($id) and empty($imagem1)){
            mensagemErro("Selecione a primeira imagem.");
        } else if(empty($id) and empty($imagem2)){
            mensagemErro("Selecione a segunda imagem.");
        }

        if(!empty($imagem1)){
            $imagem1 = time()."_{$imagem1}";
            //Copiar a imagem para o servidor
            if(!move_uploaded_file($_FILES["imagem1"]["tmp_name"], "../produtos/{$imagem1}")){
                mensagemErro("Erro ao copiar arquivo para o servidor");
            }
        }

        if(!empty($imagem2)){
            $imagem2 = time()."_{$imagem2}";
            //Copiar a imagem para o servidor
            if(!move_uploaded_file($_FILES["imagem2"]["tmp_name"], "../produtos/{$imagem2}")){
                mensagemErro("Erro ao copiar arquivo para o servidor");
            }
        }

        $valor = str_replace(".","", $valor);
        $valor = str_replace(",",".", $valor);

        //Inserir ou atualizar dados
        if(empty($id)){
            $sql = "insert into produto (nome, categoria_id, valor, descricao, imagem1, imagem2)
                    values (:nome, :categoria_id, :valor, :descricao, :imagem1, :imagem2)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":categoria_id", $categoria_id);
            $consulta->bindParam(":valor", $valor);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":imagem1", $imagem1);
            $consulta->bindParam(":imagem2", $imagem2);
        } else{
            $sql = "select imagem1, imagem2 from produto
                    where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":id", $id);
            $consulta->execute();

            $dados = $consulta->fetch(PDO::FETCH_OBJ);

            if(empty($imagem1)) $imagem1 = $dados->imagem1;
            if(empty($imagem2)) $imagem2 = $dados->imagem2;

            $sql = "update produto set nome = :nome, categoria_id = :categoria_id, valor = :valor, 
                    descricao = :descricao, imagem1 = :imagem1, imagem2 = :imagem2
                    where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":categoria_id", $categoria_id);
            $consulta->bindParam(":valor", $valor);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":imagem1", $imagem1);
            $consulta->bindParam(":imagem2", $imagem2);
        }

        if($consulta->execute()){
            //Enviar a tela para listagem
            echo "<script>location.href='listar/produtos';</script>";
        } else{
            mensagemErro("Erro ao salvar dados");
        }

    }
    
?>