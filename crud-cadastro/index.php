<?php
// ---------------------TERCEIRA PARTE------------------------
// BUSCA O ARQUIVO
    require_once 'classe-pessoa.php';
    $p = new Pessoa("crudpdo","localhost","root",""); // CRIAR A VARIAVEL P E TRAZER A CLASS PESSOA COM OS 4 PARAMETROS: DBNAME, HOST, USUÁRIO E SENHA
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="_css/estilo.css">

</head>
<body>
    <!---------------------SEXTA PARTE----------------------->
    <?php
        if(isset($_POST['nome'])) // SE EXISTE O ARRAY POST, VOCÊ COLOCAR UM NAME
        // VERIFICA SE ALGUÉM CLICOU NO BOTÃO CADASTRAR OU EDiTAR
        {
            //---------------DÉCIMA QUARTA PARTE----------------------
            // PARTE EDITAR

            if(isset($_GET['id_up']) && !empty($_GET['id_up']))
            // SE A VARIAVEL ID_UP ESTIVER VAZIO IRA ATUALIZAR
            {   
                {
                    $id_upd = addslashes($_GET['id_up']);
                    // SE O NOME EXISTE, SERA COLETADOS AS INFORMAÇÕES E GUARDADAS DENTRO DE VARIAVÉIS, ENTÃO SERÁ NECESSÁRIO CRIAR AS VARIAVÉIS
                    $nome = addslashes($_POST['nome']);// ADDSLASHES É UM METÓDO DE SEGURANÇA
                    $telefone = addslashes($_POST['telefone']);// ADDSLASHES É UM METÓDO DE SEGURANÇA
                    $email = addslashes($_POST['email']);// ADDSLASHES É UM METÓDO DE SEGURANÇA
                
                    if (!empty($nome) && !empty($telefone) && !empty($email)) // VERIFICAR SE OS CAMPOS NÃO ESTÃO VÁZIO, SE ESTIVER ENVIAR UMA MENSAGEM MANDANDO PREENCHER
                    { 
                        // EDITAR - VARIAVEL P FOI CRIA EM CIMA NO REQUIRE ONCE
                        $p->atualizarDados($id_upd, $nome, $telefone, $email);
                    
                        
                    } else
                    {
                        echo "Preencha todos os campos!";
                    }
                }
                //VOLTA AQUI

            }
        
            //----------------------------CADASTRAR----------------------------// SE NÃO VAI CADASTRAR
            else
            {
                {
                    // SE O NOME EXISTE, SERA COLETADOS AS INFORMAÇÕES E GUARDADAS DENTRO DE VARIAVÉIS, ENTÃO SERÁ NECESSÁRIO CRIAR AS VARIAVÉIS
                    $nome = addslashes($_POST['nome']);// ADDSLASHES É UM METÓDO DE SEGURANÇA
                    $telefone = addslashes($_POST['telefone']);// ADDSLASHES É UM METÓDO DE SEGURANÇA
                    $email = addslashes($_POST['email']);// ADDSLASHES É UM METÓDO DE SEGURANÇA
                
                    if (!empty($nome) && !empty($telefone) && !empty($email)) // VERIFICAR SE OS CAMPOS NÃO ESTÃO VÁZIO, SE ESTIVER ENVIAR UMA MENSAGEM MANDANDO PREENCHER
                    { 
                        // CADASTRAR - VARIAVEL P FOI CRIA EM CIMA NO REQUIRE ONCE
                        if(!$p->cadastrarPessoa($nome, $telefone, $email))
                        {
                            // SE RETORNAR FALSO É PORQUE O EMAIL JÁ FOI CADASTRADO
                            echo "E-mail já cadastro!";
                        }
                        else
                        {
                            echo "Pessoa cadastrada com sucesso!";
                        }
                      
                        
                    } else
                    {
                        echo "Preencha todos os campos!";
                    }
                }

            }
            
        }
        
        
    ?>

    <!------DÉCIMA PRIMEIRA PARTE----------->
    <?php
        if(isset($_GET['id_up'])) //SE EXISTE ALGO NA VARIÁVEL ID_UP - E VAI VERIFICAR SE ALGUEM CLICOU NO BOTÃO EDITAR
        {
            $id_update = addslashes($_GET['id_up']); // A VARIÁVEL ID_UP VAI ARMAZENAR A INFORMAÇÃO
            $res = $p->buscarDadosPessoa($id_update); //VAI BUSCAR A FUNÇÃO BUSCARDADOSPESSOA, ONDE SERÁ RETORNADO TODOS OS DADOS DO REGISTRO SELECIONADO - E VAI RECEBER O ID_UP
            // OBS: A VARIAVEL RES VAI RECEBER O RETORNO DOS DADOS
        }


    ?>

    <section id="esquerda">
        <form method="POST"> <!--NECESSÁRIO O METHOD POST PARA PASSAR AS INFORMAÇÕES PARA O PHP-->
            <h2>CADASTRAR</h2>
              <!-------DÉCIMA SEGUNDA PARTE------->
            <!--value="<?php if(isset($res)){echo $res['nome'];}?>-->
            <!--ESSA FUNÇÃO VAI ACIONAR O BOTÃO EDITTAR AO SER CLICADO-->

            <label for="nome">NOME COMPLETO</label>
            <input type="text" name="nome" id="nome"
            value="<?php if(isset($res)){echo $res['nome'];}?>">
            <!--ESSA FUNÇÃO VAI ACIONAR O BOTÃO EDITTAR AO SER CLICADO-->
          
            
            <label for="telefone">TELEFONE</label>
            <input type="text" name="telefone" id="telefone" 
            value="<?php if(isset($res)){echo $res['telefone'];}?>">
            <!--ESSA FUNÇÃO VAI ACIONAR O BOTÃO EDITTAR AO SER CLICADO-->

            <label for="email">E-MAIL</label>
            <input type="email" name="email" id="email" 
            value="<?php if(isset($res)){echo $res['email'];}?>">
            <!--ESSA FUNÇÃO VAI ACIONAR O BOTÃO EDITTAR AO SER CLICADO-->
            

            <input type="submit"
             value="<?php if(isset($res)){ echo "ATUALIAZR";}else{ echo "CADASTRAR";}?>">
             <!--VAI ALTERAR O BOTÃO CADASTRAR PARA ATUlIZAR-->
    
        <!--------OBS: LIGAR O ID COM O FOR DO LABEL--------->
        </form>
    </section>

    <section id="direita">
    <table>
        <tr id="titulo">
            <td>NOME</td>
            <td>TELFONE</td>
            <td colspan="2">E-MAIL</td>

            <!--COLSPAN VAI FAZER COM QUE A COLUNA E-MAIL OCUPE DUAS COLUNAS-->
        </tr>
        <!-------------------QUARTA PARTE-------------------->
        <?php
            $dados = $p->buscarDados(); // VARIAVEL P VAI BUSCAR O METODO BUSCARDADOS() DA PAGE CLASSE-PESSOAS.PHP
            if (count($dados)> 0) // VERIFICA SE $DADOS NÃO ESTA VAZIA
            {
                //FOR: VAI COMEÇAR DA POSIÇÃO 0 ONDE ESTA A PRIMEIRA PESSOA E VAI ATÉ A ULTIMA
                for ($i=0; $i < count($dados); $i++) {

                    echo "<tr>"; // LINHA ABRE ANTES E FECHA DEPOIS DO FOREACH

                    foreach ($dados[$i] as $key => $value) {
                        //[$I] ESTÁ ASSIM PORQUE A VARIAVEL DADOS É UMA MATRIZ
                        if ($key != "id") // NÃO VAI MOSTRAR A COLUNA ID
                        {
                                echo "<td>$value</td>"; // EXIBIR OS DADOS
                        }
                        
                    }
                    // TD FICA ANTES DO FECHAMENTO TR
                    ?>
                        <td>
                            <!-------------DÉCIMA PARTE---------------->
                            <!--FAZ PARTE DO BOTÃO EDITAR-->
                             <!--ESSE FUNÇÃO ABAIXO<?php echo $dados[$i]['id'];?> VAI EXIBIR O ID PARA A FUNÇÃO EDITAR FUNCIONAR-->
                            <a href="index.php?id_up=<?php echo $dados[$i]['id'];?>">EDITAR</a>


                            <!----------------SETÍMA PARTE------------------>
                            <!--ESSE FUNÇÃO ABAIXO<?php echo $dados[$i]['id'];?> VAI EXIBIR O ID PARA A FUNÇÃO DELETE FUNCIONAR-->

                            <!--ESSA VARIÁVEL DADOS É A DA QUARTA PARTE-->
                            <a href="index.php?id=<?php echo $dados[$i]['id'];?>;">EXCLUIR</a>

                        </td>
                    <?php
                    
                    echo "</tr>"; //FECHA DEPOIS DO FOREACH
                    // NECESSÁRIO PARA CRIAR A TABELA
                }
            }
            else // SE O BANCO DE DADOS ESTIVER VÁZIO, MOSTRA ESSA MENSAGEM
                {
                    echo "Ainda não há pessoas cadastradas!";
                }
        ?>
             
        </table>
    </section>
    
</body>
</html>

<!----------------OITAVA PARTE------------------>
<!--FAZ PARTE DE EXCLUSÃO AINDA-->

<?php
    if(isset($_GET['id']))
    {
        $id_pessoa = addslashes($_GET['id']); // SE A VARIÁVEL ID EXISTIR, SERÁ GUARDADA NESSA VARIAVEL
        $p->excluirPessoa($id_pessoa); // VAI FAZER A EXCLUSÃO - ATRÁVES DO $ID_PESSOA
        header("location: index.php"); // VAI ATUALIZAR A PÁGINA APÓS A EXCLUSÃO    
    }
?>