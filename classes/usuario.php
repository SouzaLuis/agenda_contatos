<?php

Class Usuario
{
    private $pdo;
    public $msgErro = "";
   
    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;

        try{
        $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch(PDOException $e){
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome,$email,$senha,$cep,$logradouro,$numero,$bairro,$cidade,$uf,$telefone)
    {
        global $pdo;
        //verificar se já existe email cadastrado
        $sql = $pdo->prepare("SELECT id FROM usuario WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false;
        }
        else
        { //cadastrar email não cadastrado
            $sql = $pdo->prepare("INSERT INTO usuario (nome, email, senha, cep, rua, numero, bairro, cidade, uf, telefone) VALUES (:n, :e, :s, :c, :l, :num, :b, :c, :u, :t)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->bindValue(":c",$cep);
            $sql->bindValue(":l",$logradouro);
            $sql->bindValue(":num",$numero);
            $sql->bindValue(":b",$bairro);
            $sql->bindValue(":c",$cidade);
            $sql->bindValue(":u",$uf);
            $sql->bindValue(":t",$telefone);
            $sql->execute();
            return true;
        }        
    }

    public function logar($email, $senha)
    {
        global $pdo;
        //verificar se está cadatrado
        $sql = $pdo->prepare("SELECT id FROM usuario WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if($sql->rowCount()>0){ //entrar no sistema
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true;
        }
        else {
            return false;
        }
    }

}

?>