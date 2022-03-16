<div class="banner">
    <?php
        //Selecionar dados do banner
        $sql = "select * from banner
                order by rand() limit 1";
        
        //Preparar o SQL para executar
        $consulta = $pdo->prepare($sql);
        //Executar o SQL
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //Separar o dado necessário
        $banner = $dados->banner;
    ?>

    <img src="imagens/<?=$banner?>" alt="Banner">
</div>

<main>
    <h1>Produtos em Destaque</h1>
    <div class="grid">
        <?php 
            //Selecionar os produtos da vitrine
            $sql = "select * from produto
                    order by rand() limit 6";

            //Preparar o SQL para executar
            $consulta = $pdo->prepare($sql);
            //Executa o SQL
            $consulta->execute();

            //Separar os dados
            while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                $id = $dados->id;
                $nome = $dados->nome;
                $valor = $dados->valor;
                $imagem1 = $dados->imagem1;

                //Formata o valor para exibição
                $valor = number_format($valor,2,",",".");
                ?>
                <div class="coluna center">
                    <img src="produtos/<?=$imagem1?>">
                    <h2><?=$nome?></h2>
                    <p class="valor">
                        R$ <?=$valor?>
                    </p>
                    <p>
                        <a href="produto/<?=$id?>" class="btn"><i class="fa-solid fa-magnifying-glass"></i> Detalhes</a>
                    </p>
                </div>

                <?php
            } //Fim do while
        ?>
    </div>
</main>