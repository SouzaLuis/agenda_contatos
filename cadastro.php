<?php
require_once 'classes/usuario.php';
$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Vexpenses - Cadastro Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body{
            /* padding-top: 5vh; */
            background-image: url(imagens/agenda.png);
            background-size: 50px;
            background-color: #81BEF7;
        }
        form{
            background: #FFF;
        }
        .form-container{
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px;
        }
        .bg{

            width: 60px;
            height: 60px;
            position: absolute;
            top:-15px;
            left: 40%;
            border-radius: 50%;
        }
        div#msg-sucesso{
        width: 400px;
        margin: 10px auto;
        padding: 10px;
        background-color: rgba(50,205,50,.3);
        border: 1px solid rgb(34,139,34);
        border-radius: 13px;
        color: #000;
        }
        div.msg-erro{
            width: 400px;
            margin: 10px auto;
            padding: 10px;
            background-color: rgba(250,128,114,.3);
            border: 1px solid rgb(165,42,42);
            border-radius: 13px;
            color: #000;
        }
        </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <section class="col-12 colsm-6 col-md-4">
                <form method="POST" class="form-container">
                    <div class="form-group"> <input type="text" class="form-control" name="nome" placeholder="Nome Completo " maxlength="80"> </div>
                    <div class="form-group"> <input type="text" class="form-control" maxlength="10" id="cep" name="cep" placeholder="00000-000"> </div>
                    <div class="form-group"> <input type="text" class="form-control" id="logradouro" name="logradouro" maxlength="50" placeholder="Rua"> </div>
                    <div class="form-group"> <input type="text" class="form-control" name="numero" maxlength="10" placeholder="Número"> </div>
                    <div class="form-group"> <input type="text" class="form-control" id="bairro" name="bairro" maxlength="50" placeholder="Bairro">  </div>
                    <div class="form-group">  <input type="text" class="form-control" id="localidade" name="cidade" maxlength="80" placeholder="Cidade"> </div>
                    <div class="form-group">  <input type="text" class="form-control" id="uf" name="uf" maxlength="2" placeholder="Estado"> </div>
                    <div class="form-group"> <input type="text" class="form-control" name="telefone" placeholder="Telefone" maxlength="30"> </div>
                    <div class="form-group"> <input type="email" class="form-control" name="email" placeholder="Email" maxlength="50"> </div>
                    <div class="form-group"> <input type="password" class="form-control" name="senha" placeholder="Senha" maxlength="15"> </div>
                    <div class="form-group"> <input type="password" class="form-control" name="confSenha" placeholder="Confirmar Senha" maxlength="15"> </div>
                    <div class="form-group"> <input type="submit" class="btn btn-primary btn-block" value="Cadastrar" /> </div>
                    <button class="btn btn-primary btn-block"><a style="text-decoration:none; color: white" href="index.php">Acessar</a></button>
                    <?php
                        //verificar se clicou no botão
                        if(isset($_POST['nome']))
                        {
                            $nome = addslashes($_POST['nome']);
                            $cep = addslashes($_POST['cep']);
                            $logradouro = addslashes($_POST['logradouro']);
                            $numero = addslashes($_POST['numero']);
                            $bairro = addslashes($_POST['bairro']);
                            $cidade = addslashes($_POST['cidade']);
                            $uf = addslashes($_POST['uf']);
                            $telefone = addslashes($_POST['telefone']);
                            $email = addslashes($_POST['email']);
                            $senha = addslashes($_POST['senha']);
                            $confirmarSenha = addslashes($_POST['confSenha']);

                            //verificar se está vazio
                            if(!empty($nome) && !empty($cep)  &&!empty($logradouro) && !empty($numero) && !empty($bairro) && !empty($cidade) && !empty($uf) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
                            {
                                $u->conectar("vexpenses","localhost","root","");
                                if($u->msgErro == ""){
                                    if($senha == $confirmarSenha){
                                        if($u->cadastrar($nome,$email,$senha,$cep,$logradouro,$numero,$bairro,$cidade,$uf,$telefone))
                                        {
                                            ?>
                                            <div id="msg-sucesso">
                                            Cadastrado com sucesso! Acesse para acessar todas as funcionalidades
                                            </div>
                                        <?php
                                        }else
                                        {
                                            ?>
                                            <div class="msg-erro">
                                            Email já cadastrado!
                                            </div>
                                            <?php
                                        }
                                    } else{
                                        ?>
                                        <div class="msg-erro">
                                        Senhas não correspondem!
                                        </div>
                                        <?php
                                    }            
                                }else{
                                    ?>
                                        <div class="msg-erro">
                                        <?php echo "Erro:".$u.msgErro; ?>
                                        </div>
                                        <?php
                                }
                            }else{
                                ?>
                                <div class="msg-erro">
                                Preencha todos os campos!
                                </div>
                                <?php
                            }
                        }

                    ?>
                </form>
            </section>
        </div>
    </div>

    <script src="src/endereco/Cadastro_Endereco.js"></script>
</body>
</html>