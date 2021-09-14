<?php
//-----------------------PARTE INICIAL------------------------
    Class Pessoa{
        private $pdo; // MANTEM A CLASSE PRIVADA
        public function __construct($dbname, $host, $user, $senha) // ADICIONAR OS 4 PARAMETROS
        {
            //------CONEXÃO COM O BANCO DE DADOS-------------
            try
            {
                $this-> pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
            }
            catch (PDOException $e) {
              // VERIFICA SE TEM ALGUM ERRO RELACIONADO AO BANCO DE DADOS  
              echo "Erro com banco de dados: ".$e->getMessage();
              exit(); // CASO TENHA ERRO, PARAR O CÓDIGO
            }
            catch (Exception $e)
            {
                echo "Erro generico: ".$e->getMessage();
                exit(); // CASO TENHA ERRO, PARAR O CÓDIGO
            } 
        }

        //----------------SEGUNDA PARTE-----------------------
        // VAI BUSCAR TODOS OS DADOS DO BANCO DE DADOS
        public function buscarDados()
        {
            $res = array(); // EVITA ERRO, CASO O BANCO DE DADOS ESTEJA VAZIO
            $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome"); //  A VARIAVEL CMD ESTA RECEBENDO A VARIAVEL PDO QUE ESTA FAZENDO A CONEXÃO COM O BANCO DE DADOS

            $res = $cmd->fetchAll(PDO::FETCH_ASSOC); // VARIAVEL RES, RECEBE A VARIAVEL CMD TRANSFORMADA EM ARRAY. PARA EXIBIR
            return $res; // RETORNA A INFORMAÇÃO CHAMADA NO BANCO DE DADOS
        }

        //------------------- QUINTA PARTE--------------------
        // VAI FAZER O CADASTRO
        public function cadastrarPessoa($nome, $telefone, $email) // NOME, TELEFONE E EMAIL SÃO OS DADOS PEDIDOS PARA FAZER O CADASTRO
        {
            // ANTES DE CADASTRAR VERIFICAR SE A PESSOA JÁ ESTÁ CADASTRADA, SERA VERIFICADO PELO EMAIL
            $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e"); // VAI A BUSCA DO ID DA PESSOA ATRÁVES DO EMAIL, SE VIER ALGUM ID A PESSOA JÁ ESTÁ CADASTRADA

            $cmd->bindValue(":e", $email); // SUBSTITUIÇÃO COM BIND VALUE
            $cmd->execute(); // EXECUTA O COMANDO
            // VAI VERFICAR SE O EMAIL ESTA CADASTRADO, SE SIM NÃO PODE SER CADASTRADO NOVAMENTE
            if($cmd->rowCount()> 0)
            {
                return false; // NÃO É POSSIVÉL CADASTRAR
            } else // SE O EMAIL NÃO FOR ENCONTRADO, VOCÊ PODE FAZER O CADASTRO
            {
            
                // VAI FAZER O CADASTRO
                $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome, telefone, email) VALUES (:n, :t, :e)");

                $cmd->bindValue(":n", $nome); // SUBSTITUIÇÃO COM BIND VALUE
                $cmd->bindValue(":t", $telefone); // SUBSTITUIÇÃO COM BIND VALUE
                $cmd->bindValue(":e", $email); // SUBSTITUIÇÃO COM BIND VALUE

                $cmd->execute(); // EXECUTA O COMANDO
                return true; //DEU CERTO O CADASTRO
            }
        }
        //------------------SEXTA PARTE-----------------------
        // PARTE DE EXCLUSÃO - BOTÃO EXCLUIR
        public function excluirPessoa($id)
        {
            $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id"); // A EXCLUSÃO OCORRERÁ ATRÁVES DO ID
            $cmd->bindValue(":id", $id); // SUBSTITUIÇÃO COM BIND VALUE
            $cmd->execute();// EXECUTA O COMANDO
        }

        //---------------------NONA PARTE--------------------------
        // FAZ PARTE DO BOTÃO EDITAR
        public function buscarDadosPessoa($id) // OS DADOS VÃO SER BUSCADOS PELO ID
        {
            $res = array(); // VAI EVITAR ERROS, CASO NÃO VENHA DADOS DO BANCO DE DADOS
            $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
            $cmd->bindValue(":id", $id); // VAI SUBSTITUIR COM O BIND VALUE
            $cmd->execute(); // EXECUTA O COMANDO
            $res = $cmd->fetch(PDO::FETCH_ASSOC); // A VARIAVEL RES ESTÁ RECEBENDO OS DADOS DA VARIAVEL CMD, E SERÁ USADO O METODO FETCH POIS SERA USADO APENAS UM REGISTRO, NO CASO DE MAIS USAR O FETCHALL
            return $res; //RETORNA OS DADOS DA VARIÁVEL RES
        }

        //---------------------DÉCIMA TERCEIRA PARTE-------------------------
        // VAI ATUALIZAR OS DADOS NO BANCO DE DADOS
        public function atualizarDados($id, $nome, $telefone, $email) // ID 
    
        {
            $cmd = $this->pdo->prepare("UPDATE pessoa SET nome = :n, telefone = :t, email = :e WHERE id = :id"); // VAI FAZER A AUTALIZAÇÃO DOS REGISTROS
        
            $cmd->bindValue(":n", $nome); // SUBSITUIÇÃO COM BINDVALUE
            $cmd->bindValue(":t", $telefone); // SUBSITUIÇÃO COM BINDVALUE
            $cmd->bindValue(":e", $email); // SUBSITUIÇÃO COM BINDVALUE
            $cmd->bindValue(":id", $id); // SUBSITUIÇÃO COM BINDVALUE

            $cmd->execute(); // EXECUTA O COMANDO
        }
    }
?>