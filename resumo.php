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
    <title>Resumo Contato</title>
    <style>
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
    <header>
        <nav class="navbar" style="background-color:#2675ff">
            <button class="btn btn-outline-primary btn-lg" style="background:#FFFFFF; margin-right: 10px; width:200px"><a style="text-decoration:none; color: #2675ff" href="inicio.php">Retornar</a></button>
            <h1 class="navbar mx-auto text-white">Agenda Vexpenses</h1>
            <button class="btn btn-outline-primary btn-lg" style="background:#FFFFFF; margin-right: 10px; width:200px"><a style="text-decoration:none; color: #2675ff" href="sair.php">Sair</a></button>
        </nav>
    </header>
    <br>
    <div class="text-center">
        <button style="background:#FFFFFF; margin-left: 10px; width:300px; color: #2675ff" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target=".cadastrarEndereco">Adicionar Endereço</button>
        <button style="background:#FFFFFF; margin-left: 10px; width:300px; color: #2675ff" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target=".cadastrarNumero">Adicionar Número</button>
    </div>
    <div class="container">
        <div class="text-center">
            <form method="POST">
                <div class="row">
                    <?php
                    $conexao = mysqli_connect('localhost', 'root', '','vexpenses');
                    $id_contato = $_GET['id'];
                    $query = 'SELECT * FROM agenda p WHERE p.id = '.$id_contato.' ORDER BY id ASC';
                    $result = mysqli_query($conexao, $query);
                    if($result):
                        if(mysqli_num_rows($result)>0):
                            $contato = mysqli_fetch_assoc($result);
                            ?>
                            <div>
                                <h4 class="text-left" style="margin-top:15px">Dados Principais:</h4>
                                <h6 class="text-left" style="margin-top:15px">Nome:</h6>
                                <input type="text" class="form-control" name="nome" value="<?php echo $contato['nome']; ?>" maxlength="80">
                                <h6 class="text-left" style="margin-top:15px">Rua:</h6>
                                <input type="text" class="form-control" id="rua_edit" name="rua_edit" value="<?php echo $contato['rua']; ?>" maxlength="50">
                                <h6 class="text-left" style="margin-top:15px">Número:</h6>
                                <input type="text" class="form-control" name="num_edit" value="<?php echo $contato['numero']; ?>" maxlength="50">
                                <h6 class="text-left" style="margin-top:15px">Bairro:</h6>
                                <input type="text" class="form-control" id="bairro_edit" name="bairro_edit" value="<?php echo $contato['bairro']; ?>" maxlength="50">
                                <h6 class="text-left" style="margin-top:15px">Cidade:</h6>
                                <input type="text" class="form-control" id="cidade_edit" name="cidade_edit" value="<?php echo $contato['cidade']; ?>" maxlength="50">
                                <h6 class="text-left" style="margin-top:15px">UF:</h6>
                                <input type="text" class="form-control" id="uf_edit" name="uf_edit" value="<?php echo $contato['uf']; ?>" maxlength="50">
                                <input type="hidden" name="id_contato" value="<?php echo $id_contato;?>">
                                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario;?>">
                                <br>
                                <div class="form-group"> <input type="submit" class="btn btn-primary" value="Salvar" /></div>
                            </div>
                            <?php
                        endif;
                    endif;
                    ?>
                </div>
            </form>
            <?php
                //verificar se clicou no botão
                if(isset($_POST['nome']))
                {
                    $nome = addslashes($_POST['nome']);
                    $rua = addslashes($_POST['rua_edit']);
                    $numero = addslashes($_POST['num_edit']);
                    $bairro = addslashes($_POST['bairro_edit']);
                    $cidade = addslashes($_POST['cidade_edit']);
                    $uf = addslashes($_POST['uf_edit']);
                    $id_contato = addslashes($_POST['id_contato']);
                    $id_usuario = addslashes($_POST['id_usuario']);

                    //verificar se está vazio
                    if(!empty($nome) && !empty($rua) && !empty($numero) && !empty($bairro && !empty($cidade) && !empty($uf) && !empty($id_contato) && !empty($id_usuario))){
                        $u->conectar("vexpenses","localhost","root","");
                        if($u->msgErro == ""){
                            if($u->editar($nome,$rua,$numero,$bairro,$cidade,$uf,$id_contato,$id_usuario))
                            {
                                 ?>
                                <div id="msg-sucesso">
                                Editado com sucesso!
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
            <!-- Endereços secundários -->
            <h4 class="text-left" style="margin-top:15px">Endereços Secundários:</h4>
            <table class="table">
                <thead style="background-color:#2675ff; color: #FFFFFF">
                    <tr>
                        <th scope="col">Rua</th>
                        <th scope="col">Número</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">UF</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                $query_end = 'SELECT * FROM endereco_secundario e WHERE e.id_user = '.$id_contato.' ORDER BY id ASC';
                $result_end = mysqli_query($conexao, $query_end);
                if($result_end):
                    if(mysqli_num_rows($result_end)>0):
                        while($endereco = mysqli_fetch_assoc($result_end)):
                            ?>
                            <tbody>
                                <tr style="align-itemns:center">
                                    <td><?php echo $endereco['rua'];?></td>
                                    <td><?php echo $endereco['numero'];?></td>
                                    <td><?php echo $endereco['bairro'];?></td>
                                    <td><?php echo $endereco['cidade'];?></td>
                                    <td><?php echo $endereco['uf'];?></td>
                                    <form method="POST">
                                        <input type="hidden" name="id_endereco" value="<?php echo $endereco['id']; ?>">
                                        <input type="hidden" name="id_contato" value="<?php echo $endereco['id_user']; ?>">
                                        <td><input type="submit" style="background:#FFFFFF; width:100px; color: #2675ff" class="btn btn-primary" value="Apagar"></td>
                                    </form>
                                </tr>
                            </tbody>
                            =<?php
                        endwhile;
                    endif;
                endif;
                //verificar se clicou no botão
                if(isset($_POST['id_endereco']))
                {
                    $id = addslashes($_POST['id_endereco']);
                    $id_contato = addslashes($_POST['id_contato']);
    
                    $u->conectar("vexpenses","localhost","root","");
                    if($u->msgErro == ""){
                        if($u->deletar_endereco($id,$id_contato))
                        {
                        }            
                    }
                }
                ?>
            </table>
            <!-- Deletar números secundários -->
            <h4 class="text-left" style="margin-top:15px">Números Secundários:</h4>
            <table class="table">
                <thead style="background-color:#2675ff; color: #FFFFFF">
                    <tr>
                        <th scope="col">Telefone</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                $query_num = 'SELECT * FROM telefone_secundario e WHERE e.usuario_id = '.$id_contato.' ORDER BY id ASC';
                $result_num = mysqli_query($conexao, $query_num);
                if($result_num):
                    if(mysqli_num_rows($result_num)>0):
                        while($numero = mysqli_fetch_assoc($result_num)):
                            ?>
                            <tbody>
                                <tr style="align-itemns:center">
                                    <td><?php echo $numero['telefone'];?></td>
                                    <form method="POST">
                                        <input type="hidden" name="id_numero" value="<?php echo $numero['id']; ?>">
                                        <input type="hidden" name="id_contato" value="<?php echo $numero['usuario_id']; ?>">
                                        <td><input type="submit" style="background:#FFFFFF; width:100px; color: #2675ff" class="btn btn-primary" value="Apagar"></td>
                                    </form>
                                </tr>
                            </tbody>
                            <?php
                        endwhile;
                    endif;
                endif;
                //verificar se clicou no botão
                if(isset($_POST['id_numero']))
                {
                    $id = addslashes($_POST['id_numero']);
                    $id_contato = addslashes($_POST['id_contato']);

                    $u->conectar("vexpenses","localhost","root","");
                    if($u->msgErro == ""){
                        if($u->deletar_numero($id,$id_contato))
                        {
                        }            
                    }
                }
                ?>
            </table>
            <br>
                </div>
            </div>
        </div>
    <!-- Modal para adicionar endereços secundários -->
    <div class="modal fade cadastrarEndereco" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #2675ff; color: #FFFFFF">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group"> <input type="text" class="form-control" maxlength="10" id="cep" name="cep" placeholder="00000-000"> </div>
                        <div class="form-group"> <input type="text" class="form-control" id="logradouro" name="logradouro" maxlength="50" placeholder="Rua"> </div>
                        <div class="form-group"> <input type="text" class="form-control" name="numero" maxlength="10" placeholder="Número"> </div>
                        <div class="form-group"> <input type="text" class="form-control" id="bairro" name="bairro" maxlength="50" placeholder="Bairro">  </div>
                        <div class="form-group">  <input type="text" class="form-control" id="localidade" name="cidade" maxlength="80" placeholder="Cidade"> </div>
                        <div class="form-group">  <input type="text" class="form-control" id="uf" name="uf" maxlength="2" placeholder="Estado"> </div>
                        <input type="hidden" name="id_contato" value="<?php echo $id_contato;?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <div class="form-group"> <input type="submit" class="btn btn-primary" value="Salvar" /></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        //verificar se clicou no botão
        if(isset($_POST['cep']))
        {
            $cep = addslashes($_POST['cep']);
            $logradouro = addslashes($_POST['logradouro']);
            $numero = addslashes($_POST['numero']);
            $bairro = addslashes($_POST['bairro']);
            $cidade = addslashes($_POST['cidade']);
            $uf = addslashes($_POST['uf']);
            $id_contato = addslashes($_POST['id_contato']);

            //verificar se está vazio
            if(!empty($id_contato) && !empty($id_usuario))
            {
                $u->conectar("vexpenses","localhost","root","");
                if($u->msgErro == ""){
                    if(!empty($id_usuario)){
                        if($u->cadastrar_endereco($cep,$logradouro,$numero,$bairro,$cidade,$uf,$id_contato))
                        {
                            ?>
                            <div id="msg-sucesso">
                            Cadastrado com sucesso!
                            </div>
                            <?php
                        }
                    } else{
                        ?>
                        <div class="msg-erro">
                        Sua sessão expirou!
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

    <!-- Modal para cadastrar número secundário -->
    <div class="modal fade cadastrarNumero" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #2675ff; color: #FFFFFF">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Número</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group"> <input type="text" class="form-control" maxlength="30" id="telefone" name="telefone" placeholder="Número"> </div>
                        <input type="hidden" name="id_contato" value="<?php echo $id_contato;?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <div class="form-group"> <input type="submit" class="btn btn-primary" value="Salvar" /></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        //verificar se clicou no botão
        if(isset($_POST['telefone']))
        {
            $telefone = addslashes($_POST['telefone']);
            $id_contato = addslashes($_POST['id_contato']);

            //verificar se está vazio
            if(!empty($id_contato))
            {
                $u->conectar("vexpenses","localhost","root","");
                if($u->msgErro == ""){
                    if(!empty($telefone)){
                        if($u->cadastrar_numero($telefone,$id_contato))
                        {
                            ?>
                            <div id="msg-sucesso">
                            Cadastrado com sucesso!
                            </div>
                            <?php
                        }
                    } else{
                        ?>
                        <div class="msg-erro">
                        Sua sessão expirou!
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

    <script src="src/endereco/Cadastro_Endereco.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>