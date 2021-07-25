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
    
    if($status_contato) {
        $status_envio = "sucesso";
        redireciona("confirma-contato/$status_envio/".codifica("Recebemos seu contato e você receberá uma resposta logo mais!"));
    } else {
        $status_envio = "erro";
        redireciona("confirma-contato/$status_envio/".codifica("Não foi possível enviar a mensagem. Tente novamente!"));
    }

}else{
    redireciona("../index.php");
}

?>