<?php
//Função para mostrar janela de erro com SweetAlert2
function mensagemErro($msg){
    ?>
    <script>
        Swal.fire({
            icon:  'error',
            title: 'Oops...',
            text: '<?=$msg?>',
        }).then((result) => {
            history.back();
        })
    </script>
    <?php
    exit;
} //Fim da função
?>