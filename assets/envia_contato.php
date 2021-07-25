<?php
include("../site_mod_include.php");

// Inclui o arquivo class.phpmailer.php localizado na pasta class
require_once("ferramenta/PHPmailer/class.phpmailer.php");

if($_POST["acao"] == "envia-form-contato"){

	// Dados formulário
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
	$assunto = "Contato - Site";
	$mensagem = $_POST['mensagem'];

    $status_contato = envia_contato($nome,$email,$telefone,$assunto,$mensagem);
    
    exit;
    if($status_contato) {
        $status_envio = "sucesso";
        redireciona("../index.php?envio=sucesso");
    } else {
        $status_envio = "erro";
        redireciona("../index.php?envio=erro");
    }

}else{
    redireciona("../index.php");
}

?>