<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("location: index.php");
        exit;
    }
    $id_usuario = $_SESSION['id'];
    require_once 'classes/contato.php';
    $u = new Contato;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <title>Agenda Vexpenses - Início</title>
    <style>
        #botao:hover{
            background: #2675ff;
            border-color: #FFFFFF;
            color: #2675ff;
        }
        
    </style>
</head>
<body>
    <header>
        <nav class="navbar" style="background-color:#2675ff">
            <button style="background:#FFFFFF; margin-left: 10px; width:200px; color: #2675ff" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Adicionar Contato</button>
            <h1 class="navbar mx-auto text-white">Agenda Vexpenses</h1>
            <button class="btn btn-outline-primary btn-lg" style="background:#FFFFFF; margin-right: 10px; width:200px"><a style="text-decoration:none; color: #2675ff" href="sair.php">Sair</a></button>
        </nav>
    </header>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #2675ff; color: #FFFFFF">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group"> <input type="text" class="form-control" name="nome" placeholder="Nome Completo " maxlength="80"> </div>
                        <div class="form-group"> <input type="text" class="form-control" name="telefone" placeholder="Telefone" maxlength="30"> </div>
                        <div class="form-group"> <input type="text" class="form-control" maxlength="10" id="cep" name="cep" placeholder="00000-000"> </div>
                        <div class="form-group"> <input type="text" class="form-control" id="logradouro" name="logradouro" maxlength="50" placeholder="Rua"> </div>
                        <div class="form-group"> <input type="text" class="form-control" name="numero" maxlength="10" placeholder="Número"> </div>
                        <div class="form-group"> <input type="text" class="form-control" id="bairro" name="bairro" maxlength="50" placeholder="Bairro">  </div>
                        <div class="form-group">  <input type="text" class="form-control" id="localidade" name="cidade" maxlength="80" placeholder="Cidade"> </div>
                        <div class="form-group">  <input type="text" class="form-control" id="uf" name="uf" maxlength="2" placeholder="Estado"> </div>
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <div class="form-group"> <input type="submit" class="btn btn-primary" value="Salvar" /></div>
                    </div>
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
                            $id_usuario = addslashes($_POST['id_usuario']);


                            //verificar se está vazio
                            if(!empty($nome) && !empty($telefone) && !empty($id_usuario))
                            {
                                $u->conectar("vexpenses","localhost","root","");
                                if($u->msgErro == ""){                            
                                    if($u->cadastrar($nome,$cep,$logradouro,$numero,$bairro,$cidade,$uf,$telefone,$id_usuario))
                                    {
                                        ?>
                                        <div id="msg-sucesso">
                                        Cadastrado com sucesso! Acesse para acessar todas as funcionalidades
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
                                Preencha todos os campos obrigatórios!
                                </div>
                                <?php
                            }
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <script src="src/endereco/Cadastro_Endereco.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>