<?php
    if(!isset($page)) exit;
?>

<div class="card">
    <div class="card-header">
        <h2>Relatório de Usuários</h2>
    </div>
    <div class="card-body">
        <form name="formBusca">
            <div class="row">
                <div class="col-12 col-md-10">
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome ou login">
                </div>
                <div class="col-12 col-md-2">
                    <button type="button" id="submit" class="btn btn-success">Buscar</button>
                </div>
            </div>
        </form>

        <p class="text-center">Resultados da Busca</p>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Login</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<script>
    $("#submit").click(function(){
        //Carregar a imagem do carregamento na tabela
        $("tbody").html("<tr><td colspan='4' class='text-center'><img src='images/loading.gif'> Aguarde, carregando... </td></tr>");
    
        //Recuperar o nome digitado
        var nome= $("#nome").val();

        //Enviar os dados para o rel-usuarios.php
        $.post("rel-usuarios.php", {nome:nome}, function(dados){
            $("tbody").html(dados);
        })
    })
</script>