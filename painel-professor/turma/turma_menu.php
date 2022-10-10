<head>


<link rel="stylesheet" href="../../Packages/Trumbowyg/dist/ui/trumbowyg.min.css">

</head>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Topicos Cadastrados</h3>
        </div>



        <?php


        $id = $_SESSION['id_turma'];
        $tur_hash_code = $id;
        $sql = "SELECT * FROM turmas WHERE tur_hash_code = '$id'";
        $query = $pdo->query($sql);
        $dados = $query->fetch();

        $turma = $dados['tur_id_pk'];

        $sql = "SELECT * FROM turma_topicos WHERE tur_id_fk = '$turma'";
        $query = $pdo->query($sql);
        $dados = $query->fetchAll();

        foreach ($dados as $key => $value) {
            $topico = $value['top_id_fk'];
            $sql = "SELECT * FROM topicos WHERE top_id_pk = '$topico'";
            $query = $pdo->query($sql);
            $dados = $query->fetch();
            $nome = $dados['top_name'];
            $id = $dados['top_id_pk'];

        ?>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body flex flex-row justify-between">
                        <h5 class="card-title"><?php echo $nome; ?></h5>
                        <a href="painel-professor/turma/util/removeTopico.php?id=<?php echo $id;?>&tur_id=<?php echo $turma ?>" class="btn btn-danger">Remover</a>
                    </div>
                </div>
            </div>


        <?php
        }

        ?>

    </div>

    <!-- divider -->
    <hr class="mb-4">
    <!-- /divider -->
    <!-- Melhores Alunos -->
    <div class="mural flex">

        <div class="forum col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Fórum</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="card">
                            
                            <form action="util/addForum.php" method="POST">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Adicionar Postagem</label>
                                        
                                        <!-- Trumb text area -->
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="message"></textarea>
                                    </div>
                                    <input type="hidden" name="tur_id_fk" value="<?php echo $turma; ?>">
                                    <input type="hidden" name="profile_pic" value="<?php echo $photoProf ?>">
                                    <input type="hidden" name="nome" value="<?php echo $nome_usu ?>">
                                    <input type="hidden" name="id_turma" value="<?php echo $tur_hash_code; ?>">
                                    <button type="submit" class="btn btn-primary">Postar</button>
                                </div>

                                <div class="card-body">
                                   
                                    <!-- Mostra postagens ordenadas por data -->
                                    <?php
                                    $sql = "SELECT * FROM forum_message WHERE tur_id_fk = '$turma' ORDER BY data_cadastro DESC";
                                    $query = $pdo->query($sql);
                                    $dados = $query->fetchAll();

                                    foreach ($dados as $key => $value) {
                                        $id = $value['id'];
                                        $message = $value['message'];
                                        $profile_pic = $value['profile_pic'];
                                        $nome = $value['name'];
                                        $data_cadastro = $value['data_cadastro'];

                                        // formata a data
                                        $data_cadastro = date('d/m/Y H:i:s', strtotime($data_cadastro));

                                        $data = explode(" ", $data_cadastro);
                                        $data = $data[0];
                                        $hora = explode(" ", $data_cadastro);
                                        $hora = $hora[1];

                                        // compara com a data atual
                                        $data_atual = date('d/m/Y');
                                        $hora_atual = date('H:i:s');

                                        if ($data == $data_atual) {
                                            $data = "Hoje";
                                        }elseif ($data == date('d/m/Y', strtotime('-1 days'))) {
                                            $data = "Ontem";
                                        }



                                    ?>
                                        <div class="card" style="margin:10px;">
                                            <div class="card-body flex flex-row justify-between">
                                                <div class="flex flex-row justify-center">
                                                    <img src="../../img/profilepics/<?php echo $profile_pic; ?>" alt="" class="rounded-circle" style="
                                                    margin-right: 10px;
                                                    object-fit: cover;
                                                    width: 50px;
                                                    height: 50px;
                                                    ">
                                                    <div class="flex flex-column justify-center ml-3">
                                                        <h5 class="card-title"><?php echo $nome; ?></h5>
                                                        <p class="card-text"><?php echo $data; ?> às <?php echo $hora; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- divider -->
                                            <hr class="mb-4">
                                            <div class="card-body">
                                                <p class="card-text"><?php echo $message; ?></p>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-default col-md-6">
            <div class="panel-heading">
                <h3 class="panel-title">Melhores Alunos</h3>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Pontuação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM turma_usuario WHERE tur_id_fk = '$turma'";
                    $query = $pdo->query($sql);
                    $dados = $query->fetchAll();

                    $melhores = array();
                    foreach ($dados as $key => $value) {
                        $usuario = $value['usu_id_fk'];
                        $sql = "SELECT * FROM usuarios WHERE id = '$usuario'";
                        $query = $pdo->query($sql);
                        $dados = $query->fetch();
                        $nome = $dados['nome'];
                        $foto = $dados['foto'];
                        $id = $dados['usu_id_pk'];

                        $sql = "SELECT sum(pontuacao) as pontuacao FROM desempenho_por_topico WHERE id_usuario = '$usuario'";
                        $query = $pdo->query($sql);
                        $dados = $query->fetch();
                        $pontuacao = $dados['pontuacao'];
                        $melhores[] = array('nome' => $nome, 'pontuacao' => $pontuacao, 'foto' => $foto);
                    }

                    // Ordena o array pela pontuação
                    usort($melhores, function ($a, $b) {
                        return $b['pontuacao'] <=> $a['pontuacao'];
                    });

                    // Pega os 5 primeiros
                    $melhores = array_slice($melhores, 0, 5);

                    foreach ($melhores as $key => $value) {
                        $nome = $value['nome'];
                        $pontuacao = $value['pontuacao'] / 4;
                        $foto = $value['foto'];
                        if ($pontuacao > 5) {
                            $pontuacao = 5;
                        }
                    ?>
                        <tr>
                            <td class="flex" style="align-items: center;">
                                <img src="../../img/profilepics/<?php echo $foto ?>" alt="<?php echo $nome ?>" class="avatar-sm rounded-circle mr-2" style="width: 40px; height: 40px;">


                                <?php echo $nome; ?>
                            </td>
                            <td>
                                <i class="fas fa-star"></i>
                                <?php echo $pontuacao; ?>
                            </td>
                        </tr>


                    <?php
                    }
                    ?>


                </tbody>
            </table>
        </div>

    </div>
</div>
<script src="../../Packages/Trumbowyg/dist/trumbowyg.min.js"></script>

<script src="../../Packages/trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js"></script>


<script>

    // Trumbowyg
    $('#exampleFormControlTextarea1').trumbowyg({
        btns: [
                ['viewHTML'],
                ['undo', 'redo'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'], // Only supported in Blink browsers
                ['unorderedList', 'orderedList'],
                ['upload', 'insertImage', 'link'],
                ['superscript', 'subscript'],
                ['formatting', 'strong', 'em', ],
            
            ],
            lang: 'pt_br',
            plugins: {
                // Add imagur parameters to upload plugin for demo purposes
                upload: {
                    serverPath: 'util/imgUpload.php',
                    fileFieldName: 'image',
                    headers: {
                        'Authorization': 'Client-ID xxxxxxxxxxxx'
                    },
                    urlPropertyName: 'file'
                }
            }

    });
</script>