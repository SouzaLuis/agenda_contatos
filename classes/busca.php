<?php
    if(!isset($GET['contato'])){
        header("Location: inicio.php");
        exit;
    }

    $busca = $_POST['contato'];

    $name = 'vexpenses';
    $host = 'localhost';
    $usuario = 'root';
    $senha = '';

    $conexao = new PDO("mysql:dbname=".$name.";host=".$host,$usuario,$senha);
    $resultado = $conexao->prepare('SELECT * FROM `agenda` WHERE `nome` LIKE :nome');
    $resultado->bindParam(':nome', $nome, PDO::PARAM_STR);
    $resultado->execute();

    $resultados = $resultado->fetchAll(PDO::FETCH_ASSOC);

    print_r($resultados);
?>