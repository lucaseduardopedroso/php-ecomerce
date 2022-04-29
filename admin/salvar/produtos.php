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
        }

    }
    
?>