<?php
require_once 'classes/usuario.php';
$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Agenda Vexpenses - Login</title>
    <style>
         body{
            padding-top: 5vh;
            background-image: url(imagens/agenda.png);
            background-size: 50px;
            background-color: #81BEF7;
        }
       form{
            background: #FFF;
        }
        .form-container{
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 10px 0px;
        }
        .bg{
            width: 60px;
            height: 60px;
            position: absolute;
            top:-35px;
            left: 40%;
            border-radius: 50%;
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
				<h2 class="text-center mt-4">Login</h2>

				<div class="form-group">
					<input type="email"  class="form-control" name="email" placeholder="Insira aqui seu e-mail">
				</div>
				
				<div class="form-group">
                    <label for="">Senha:</label>
					<input type="password" class="form-control" name="senha" placeholder="Insira aqui sua senha">
				</div>
				
				
				<div class="form-group"> <input type="submit" class="btn btn-primary btn-block" value="Entrar" /> </div>
                <button class="btn btn-primary btn-block"><a style="text-decoration:none; color: white" href="cadastro.php">Cadastrar-me</a></button>
                <?php

                if(isset($_POST['email']))
                {
                    $email = addslashes($_POST['email']);
                    $senha = addslashes($_POST['senha']);
                    if(!empty($email) && !empty($senha))
                    {
                        $u->conectar("vexpenses","localhost","root","");
                        if($u->msgErro == ""){
                        if($u->logar($email,$senha)){
                            header("location: inicio.php");
                        }
                        else
                        {
                            ?>
                        <div class="msg-erro">
                            E-mail e/ou senha estão incorretos!
                        </div>
                        <?php
                        }
                        }
                        else
                        {
                            ?>
                        <div class="msg-erro">
                        <?php echo "Erro: ".$u->msgErro ?>
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
            </form>
		</section>
	</div>
</div>





<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>