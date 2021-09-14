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
    <div id="corpo-form">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="email" placeholder="Usuário" name="email">
            <input type="password" placeholder="Senha" name="senha">
            <input class="btn" type="submit" value="Acessar">
            <a href="cadastrar.php">Ainda não é escrito?<strong> Cadastre-se</strong></a>
        </form>
    </div>

    <?php
    if(isset($_POST['email']))
    {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        if(!empty($email) && !empty($senha))
        {
            $u->conectar("projeto_login","localhost","root","");
            if($u->msgErro == "")
            {
                if($u->login($email,$senha))
            {
                header("location: areaPrivada.php");
            }
            else
            {
                ?>
                <div class="msg-erro">
                    Email e/ou senha estão incorretos!
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