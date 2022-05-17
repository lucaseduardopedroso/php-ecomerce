<?php
    //Verificar se variável page existe
    if(!isset($page)){
        exit;
    }
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Listar Usuários:</h2>
        <div class="float-right">
            <a href="cadastros/tipos" title="Cadastrar Novo Tipo" class="btn btn-success">
                Cadastrar Usuário
            </a>
        </div>
    </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nome</td>
                        <td>E-mail</td>
                        <td>Login</td>
                        <td>Status</td>
                        <td>Opções</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //Selecionar todos os usuários
                        $sql = "select * from usuario
                                order by nome";
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();

                        while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                            <tr>
                                <td><?=$dados->id?></td>
                                <td><?=$dados->nome?></td>
                                <td><?=$dados->email?></td>
                                <td><?=$dados->login?></td>
                                <td width="50px">
                                    <?php
                                    if($dados->ativo === "S"){
                                    ?>
                                    <a href="salvar/ativo/<?=$dados->id?>" title="Ativar Status" class="btn btn-success">
                                        <i class="fas fa-toggle-on"></i>
                                    </a>
                                    <?php
                                    } else{
                                        ?>
                                        <a href="salvar/ativo/<?=$dados->id?>" title="Desativar Status" class="btn btn-danger">
                                        <i class="fas fa-toggle-off"></i>
                                    </a>
                                    <?php } ?>
                                <td width="100px">
                                    <a href="cadastros/usuarios/<?=$dados->id?>" title="Editar Registro" class="btn btn-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:excluir(<?=$dados->id?>)" title="Excluir Dados" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
</div>

<script>
    $(".table").dataTable();

    function excluir(id){
        Swal.fire({
            title: 'Você deseja realmente excluir este item?',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if(result.isConfirmed){
                location.href="excluir/tipos/"+id;
            }
        })
    }
</script>