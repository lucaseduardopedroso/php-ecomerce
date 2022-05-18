<?php
    session_start();

    if ( ( $_SESSION["usuario"]["id"] ) && ( $_POST ) )
    {

        //Recuperar os dados
        $valorInicial = trim( $_POST["valorInicial"] ?? NULL);
        $valorFinal = trim( $_POST["valorFinal"] ?? NULL );

        include "../config.php";

        $valorInicial = formatarValor($valorInicial);
        $valorFinal = formatarValor($valorFinal);

        $sql = "select p.id, p.nome produto,
            p.valor, p.imagem1, c.nome categoria 
            from produto p 
            inner join categoria c on 
            (c.id = p.categoria_id)
            where p.valor between :valorInicial and :valorFinal order by p.nome";
        
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":valorInicial", $valorInicial);
        $consulta->bindParam(":valorFinal", $valorFinal);
        $consulta->execute();

        while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
            $valor = number_format($dados->valor,2,",",".");
            ?>
            <tr>
                <td><?=$dados->id?></td>
                <td><img src="../produtos/<?=$dados->imagem1?>" width="120px"></td>
                <td><?=$dados->produto?></td>
                <td><?=$valor?></td>
                <td><?=$dados->categoria?></td>
            </tr>
            <?php
        }

    }