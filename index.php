<?php 
    require "config.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitrine da Adidas</title>
    <link rel="shortcut icon" href="imagens/icone.png">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <a href="index.php" title="Home">
            <img src="imagens/logo.png" alt="Adidas">
        </a>

        <nav>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <?php
                //Selecionar todas as categorias
                $sql = "select * from categoria
                        order by nome";
                //Preparar o SQL para execução
                $consulta = $pdo->prepare($sql);
                //Executar
                $consulta->execute();

                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                    //Separar os dados
                    $id=$dados->id;
                    $nome=$dados->nome;
                    ?>
                    <li>
                        <a href="categoria/<?=$id?>">
                            <?=$nome?>
                        </a>
                    </li>
                    <?php
                }

                ?>
                <li>
                    <a href="contato">Contato</a>
                </li>
            </ul>
        </nav>
    </header>
</body>
</html>