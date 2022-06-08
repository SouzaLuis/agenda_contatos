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
    
    public function editar($nome,$rua,$numero,$bairro,$cidade,$uf,$id_contato,$id_usuario)
    {
        global $pdo;
        $sql = $pdo->prepare("UPDATE agenda SET nome = :n, rua = :l, numero = :num, bairro = :b, cidade = :c, uf = :u WHERE id = :id_contato and id_usuario = :id_usuario");
        $sql->bindValue(":n",$nome);
        $sql->bindValue(":l",$rua);
        $sql->bindValue(":num",$numero);
        $sql->bindValue(":b",$bairro);
        $sql->bindValue(":c",$cidade);
        $sql->bindValue(":u",$uf);
        $sql->bindValue(":id_contato",$id_contato);
        $sql->bindValue(":id_usuario",$id_usuario);
        $sql->execute();
        return true;
    }
    public function deletar($id,$id_usuario)
    {
        global $pdo;
        $sql = $pdo->prepare("DELETE from agenda WHERE id = :id and id_usuario = :id_usuario");
        $sql->bindValue(":id",$id);
        $sql->bindValue(":id_usuario",$id_usuario);
        $sql->execute();
        return true;
    }
    //  Endereço Secundário
    public function cadastrar_endereco($cep,$logradouro,$numero,$bairro,$cidade,$uf,$id_contato)
    {
        global $pdo;
        $sql = $pdo->prepare("INSERT INTO endereco_secundario (cep, rua, numero, bairro, cidade, uf, id_user) VALUES (:c, :l, :num, :b, :c, :u, :id)");
        $sql->bindValue(":c",$cep);
        $sql->bindValue(":l",$logradouro);
        $sql->bindValue(":num",$numero);
        $sql->bindValue(":b",$bairro);
        $sql->bindValue(":c",$cidade);
        $sql->bindValue(":u",$uf);
        $sql->bindValue(":id",$id_contato);
        $sql->execute();
        return true;
    }
    public function deletar_endereco($id,$id_contato)
    {
        global $pdo;
        $sql = $pdo->prepare("DELETE from endereco_secundario WHERE id = :id and id_user = :id_contato");
        $sql->bindValue(":id",$id);
        $sql->bindValue(":id_contato",$id_contato);
        $sql->execute();
        return true;
    }
    // Número Secundário
    public function cadastrar_numero($telefone,$id_contato)
    {
        global $pdo;
        $sql = $pdo->prepare("INSERT INTO telefone_secundario (telefone, usuario_id) VALUES (:t, :id)");
        $sql->bindValue(":t",$telefone);
        $sql->bindValue(":id",$id_contato);
        $sql->execute();
        return true;
    }
    public function deletar_numero($id,$id_contato)
    {
        global $pdo;
        $sql = $pdo->prepare("DELETE from telefone_secundario WHERE id = :id and usuario_id = :id_contato");
        $sql->bindValue(":id",$id);
        $sql->bindValue(":id_contato",$id_contato);
        $sql->execute();
        return true;
    }
    
}      

?>