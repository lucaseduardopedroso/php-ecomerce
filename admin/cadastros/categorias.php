<?php
    //Verifica se o usuário está autenticado
    if(!isset($page)){
        exit;
    }
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Categoria</h2> 
        <div class="float-right">
            <a href="listar/categorias" title="Listar Categorias" class="btn btn-success">
                Listar Categorias
            </a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/categorias">
            <label for="id">ID da Categoria:</label>
            <input type="text" readonly name="id" id="id" class="form-control">
            <label for="nome">Nome da Categoria:</label>
            <input type="text" name="nome" id="nome" class="form-control" required data-parsley-required-message="Por favor, preencha este campo">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar Dados
            </button>
        </form>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome da Categoria:</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    //Selecionar todas categorias
                    $sql = "select * from categoria
                            order by nome";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <tr>
                            <td><?=$dados->id?></td>
                            <td><?=$dados->nome?></td>
                            <td width="100px">
                                <a href="cadastros/categorias/<?=$dados->id?>" title="Editar Registro" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:excluir(<?=$dados->id?>)" title="Excluir Dados" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    } //Fim do while
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
            if (result.isConfirmed) {
               location.href="excluir/categoria/"+id;
            }
        })
    }
</script>