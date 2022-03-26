<?php
    //Validação dos dados
    if($_POST){
        //Recuperar login e senha
        $login = trim($_POST["login"] ?? NULL);
        $senha = trim($_POST["senha"] ?? NULL);

        //Validar login e senha
        if((empty($login)) or (empty($senha))){
            //Mostrar erro na tela com SweetAlert2
            mensagemErro("Preencha os campos login e senha.");
        } 
        
        //Selecionar os dados do banco
        $sql = "select id, nome, login, senha
                from usuario
                where login = :login AND ativo = 'S' limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":login", $login);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //Verificar se trouxe resultado
        if(!isset($dados->id)){
            mensagemErro("Usuário não encontrado ou inativado.");
        //Verificar se a senha confere com a senha em banco de dados
        } else if (!password_verify($senha, $dados->senha)){
            mensagemErro("Senha incorreta.");
        }

        //Guardar informações na sessão
        $_SESSION["usuario"] = array("id" => $dados->id, "nome" => $dados->nome, "login" => $dados->login);
        //Redirecionar para página home
        echo "<script>location.href='paginas/home'</script>";
        exit;
    } // Fim do POST
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