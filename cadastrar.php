<?php
  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//trazendo documento para pagina antes de instanciar//
   require_once  'usuarios.php';
   $u = new Usuario;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div id="corpo-form">
        <h1>Cadastre-se</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" maxlenght="30">
            <input type="tel"  name="telefone" placeholder="Telefone" maxlenght="30">
            <input type="email" name="email" placeholder="Usuário" maxlenght="40">
            <input type="text" name="senha" placeholder="Senha" maxlenght="15">
            <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlenght="15">
            <input type="submit" value="Cadastrar">
        </form>
       
    </div>
    <?php
    //verificar se clicou no botao cadastrar//
    if(isset($_POST['nome']))
    {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confSenha']);
        //verificando se esta tudo preenchido//
        if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
        {
            $u->conectar("projeto_login", "localhost", "root", "joao");//variavel u acessando o metodo conectar//

            if ($u->msgErro == "") // se essa variaavel estiver vazia deu tudo ok sem erro//
            {
                if($senha == $confirmarSenha)
                {
                    if($u->cadastrar($nome, $telefone, $email, $senha)) //enviando para cadastrar usuario//
                    {   
                        echo "Cadastrado com sucesso! Acesse para entrar!";

                    }
                    else
                    {
                        echo "Email ja cadastrado";
                    }
                }
                else
                {
                    echo "As senhas não correspondem ";
                }
           
            }
            else
            {
                echo "Erro: ".$u->msgErro;
            }

        }
        else
        {
            echo "Preencha todos os campos!";
        }

    } 








   ?>

   
</body>
</html>