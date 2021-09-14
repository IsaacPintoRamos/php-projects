<?php
    require_once 'CLASSES/usuarios.php';
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro</title>
    <link rel="stylesheet" href="_css/estilo.css"></link>
    

</head>
<body>
    <div id="corpo-form-cad">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="30" >
            <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
            <input type="email" name="email" placeholder="Usuário" maxlength="40">
            <input type="password" name="senha" placeholder="Senha" maxlength="15">
            <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
            <input class="btn" type="submit" value="Cadastrar">
            <a href="index.php">Clique aqui após se cadastrar para <strong>Entrar</strong></a>
        </form>
    </div>
    <?php
    //verificar se clicou no botão
   if(isset($_POST['nome']))
    {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confSenha']);
        //verificar se esta preenchido
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
        {
            $u->conectar("projeto_login","localhost","root","");
            if($u->msgErro == "") // se está tudo ok
            {
                if($senha == $confirmarSenha)
                {
                    if($u->cadastrar($nome,$telefone,$email,$senha))
                    {
                        ?>
                        <div id="msg-sucesso">
                            Cadastrado com sucesso! Acesse para entrar!
                        </div>
                        <?php

                       
                    }
                    else
                    {
                        ?>
                        <div class="msg-erro">
                            Email já cadastrado!
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="msg-erro">
                        Senha e Confirmar Senha não correspondem!
                    </div>
                    <?php
                }
                
            }
            else
            {
                ?>
                <div class="msg-erro">
                    <?php echo "Erro: ".$u->msgErro;?>
                </div>
                <?php
                 
            }

        }else
        {
            ?>
            <div class="msg-erro">
                Preencha todos os campos!
            </div>
            <?php
        }
    }

    ?>
</body>
</html>

