<?php

if (isset($_POST['email']) && !empty($_POST['email'])) {

$nome = addslashes($_POST['nome']);
$email = addslashes($_POST['email']);
$mensagem = addslashes($_POST['mensagem']);

$to = "isaacpintoramos5@gmail.com";
$subject = "Formulario de Contato";
$body = "Nome: ".$nome. "\n" .
        "Email: " .$email. "\n".
        "Mensagem: " .$mensagem;

$header = "From:Treminaumm@gmail.com" . "\n" . "Reply-To:" .$email. "\n" . "X=Mailer:PHP/" .phpversion();

if (mail($to, $subject, $body, $header)) {
    echo ("Email enviado com sucesso!");
}
else {
    echo ("Erro ao enviar email. Sem conexão com o servidor");
}
}

?>

