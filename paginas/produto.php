<main>
    <?php 
        $id = $page[1] ?? NULL;

        if(empty($id)){
            ?>
            <div class="center">
            <h1>Erro!</h1>
            <p>Produto não encontrado.</p>
            </div>
            <?php
        } else{
            //Selecionar os produtos da categoria
            $sql = "select * from produto
                    where id = :id limit 1";
            //Preparar para executar
            $consulta = $pdo->prepare($sql);
            //Passar o parametro :id
            $consulta->bindParam(":id", $id);
            //Executar
            $consulta->execute();

            //Separar os dados
            $dados = $consulta->fetch(PDO::FETCH_OBJ);
            $nome = $dados->nome;
            $valor = $dados->valor;
            $descricao = $dados->descricao;
            $imagem1 = $dados->imagem1;
            $imagem2 = $dados->imagem2;

            //Formatar o valor
            $valor = number_format($valor, 2, ",", ".");
            ?>

            <h1><?=$nome?></h1>
            <div class="grid-produto">
                <div class="coluna">
                    <a href="produtos/<?=$imagem1?>" title="Imagem 1" data-lightbox="Foto">
                        <img src="produtos/<?=$imagem1?>" alt="Imagem 1">
                    </a>

                    <a href="produtos/<?=$imagem2?>" title="Imagem 2" data-lightbox="Foto">
                        <img src="produtos/<?=$imagem2?>" alt="Imagem 2">
                    </a>
                </div>
                <div class="coluna">
                    <h3>Descrição do Produto:</h3>
                    <p><?=$descricao?></p>
                </div>
            </div>
            <?php
        }
    ?>
</main>