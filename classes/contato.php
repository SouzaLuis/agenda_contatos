<?php

Class Contato
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

    public function cadastrar($nome,$cep,$logradouro,$numero,$bairro,$cidade,$uf,$telefone,$id_usuario)
    {
        global $pdo;
        $sql = $pdo->prepare("INSERT INTO agenda (nome, cep, rua, numero, bairro, cidade, uf, telefone, id_usuario) VALUES (:n, :c, :l, :num, :b, :c, :u, :t, :id)");
        $sql->bindValue(":n",$nome);
        $sql->bindValue(":c",$cep);
        $sql->bindValue(":l",$logradouro);
        $sql->bindValue(":num",$numero);
        $sql->bindValue(":b",$bairro);
        $sql->bindValue(":c",$cidade);
        $sql->bindValue(":u",$uf);
        $sql->bindValue(":t",$telefone);
        $sql->bindValue(":id",$id_usuario);
        $sql->execute();
        return true;
    } 
}      

?>