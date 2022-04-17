<?php
    if(!isset($page)){
        exit;
    }
    
    $tipo = NULL;

    if(!empty($id)){
        $sql = "select * from tipo where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $id = $dados->id ?? NULL;
        $tipo = $dados->tipo ?? NULL;
    }
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Tipo de Usuário</h2>
        <div class="float-right">
            <a href="listar/tipos" title="Listar Tipos de Usuário" class="btn btn-success">
                Listar Tipos de Usuários
            </a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/tipos" data-parsley-validate="">
            <label for="id">ID:</label>
            <input type="text" readonly name="id" id="id" class="form-control" value="<?=$id?>">
            <label for="nome">Tipo de Usuário:</label>
            <input type="text" name="tipo"" id="tipo" class="form-control" required data-parsley-required-message="Por favor, preencha este campo" value="<?=$tipo?>">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-users"></i> Salvar Dados
            </button>
        </form>
    </div>
</div>