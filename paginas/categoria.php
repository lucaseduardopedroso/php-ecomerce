<main>
    <?php
        //Recuperar o id da categoria
        $id = $page[1] ?? NULL;
        //Verificar se o id está vazio
        if(empty($id)){
            ?>
            <h1>Erro!</h1>
            <h2 class="center">Categoria inválida!</h2>
            <?php
        } else{
            //Selecioanr a categoria com id
            $sql = "select nome from categoria
                    where id = :id limit 1";
            $consultaCategoria = $pdo->prepare($sql);
            $consultaCategoria->bindParam(":id", $id);
            $consultaCategoria->execute();
            $dados = $consultaCategoria->fetch(PDO::FETCH_OBJ);

            $nome = $dados->nome;

            echo "<h1>Categoria: {$nome}</h1>";

            //Selecionar os produtos da categoria
            $sql = "select * from produto
                    where categoria_id = :id order by nome";
            //Preparar para executar
            $consulta = $pdo->prepare($sql);
            //Passar o parametro :id
            $consulta->bindParam(":id", $id);
            //Executar
            $consulta->execute();

            ?>
            <div class="grid">
            <?php
                while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                    //Separar os dados
                    $id = $dados->id;
                    $nome = $dados->nome;
                    $valor = $dados->valor;
                    $imagem1 = $dados->imagem1;

                    //Formatar o valor
                    $valor = number_format($valor, 2, ",", ".");

                    echo "<div class='coluna center'>
                              <img src='produtos/{$imagem1}'>
                              <h2>{$nome}</h2>
                              <p class='valor'>
                                R$ {$valor}
                              </p>
                              <p>
                                <a href='produto/{$id}' class='btn'>
                                    Detalhes
                                </a>
                              </p>
                        </div>";
                }
            ?>
            </div>
            <?php
        }
    ?>
</main>