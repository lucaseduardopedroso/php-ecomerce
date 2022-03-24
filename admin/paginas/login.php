<?php
    //Validação dos dados
    if($_POST){
        //Recuperar login e senha
        $login = trim($_POST["login"] ?? NULL);
        $senha = trim($_POST["senha"] ?? NULL);

        //Validar login e senha
        if((empty($login)) or (empty($senha))){
            //Mostrar erro na tela com SweetAlert2
            ?>
            <script>
                Swal.fire({
                    icon:  'error',
                    title: 'Oops...',
                    text: 'Preencha os campos login e senha',
                }).then((result) => {
                    history.back();
                )}
            </script>
            <?php
        }
    }
?>
<div class="login">
    <h1 class="text-center">Efetuar Login</h1>
    <form name="formLogin" method="post" data-parsley-validate="">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" class="form-control" required data-parsley-required-message="Por favor, preencha a este campo.">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" class="form-control" required data-parsley-required-message="Por favor, preencha a este campo.">
        <br>
        <button type="submit" class="btn btn-success w-100">Efetuar Login</button>
    </form>
</div>