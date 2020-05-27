<?php

class Usuario
{
   // metod para conectar no banco de dados//
   private $pdo;
   public $msgErro = "";

   public function conectar($nome, $host, $usuario, $senha)
   {
    global $pdo;

         $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
   }
     //metod para cadastrar usuario//
   public function cadastrar($nome, $telefone, $email, $senha)
   {
     global $pdo;

     $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
     $sql->bindValue(":e",$email);
     $sql->execute();

     if($sql->rowCount() > 0)
     
     {
         return false;//essa funcao vai retornar falsa caso o usuario ja esteja cadstrado//
     }
     else
     
     {
         //caso nao cadastrar executa-se essa funcao//
        $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
        $sql->bindValue(":n",$nome);
        $sql->bindValue(":t",$telefone);
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        return true;

     }

   }
     //metodo para logar//
   public function logar($email, $senha)
   {

    global $pdo;
       //verificando se ja esta cadastrado //
    $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
    $sql->bindValue(":e", $email);
    $sql->bindValue(":s",md5($senha));
    $sql->execute();


    if($sql->rowCount() > 0)

    {    //entrar no sistema sessao//
        $dado = $sql->fetch();
        session_start();
        $_SESSION['id_usuario'] = $dado['id_usuario'];
        return true;//login executado com sucesso//

    }
    else
    {
        return false;//nao foi possivel logar//

    }


   }
}

?>