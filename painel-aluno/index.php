<?php
@session_start();
require_once("../conexao.php");
require_once("../Classes/formatarString.php");

//variaveis para o menu
$pag = @$_GET["pag"];
$menu1 = "Materiais_de_estudo";
$menu2 = "conteudo";


// Verificar se o usuário está logado antes de mostrar o conteúdo
if (@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'aluno') {
    echo "<script language='javascript'> window.location='../index.php' </script>";
    @session_destroy();
}



//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * FROM usuarios where id = '$_SESSION[id_usuario]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = @$res[0]['nome'];
$cpf_usu = @$res[0]['cpf'];
$email_usu = @$res[0]['email'];
$idUsuario = @$res[0]['id'];

// query tópicos
$query = $pdo->query("SELECT * FROM topicos");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

// Array com os nomes dos tópicos
$topicos = array();
for ($i = 0; $i < $total_reg; $i++) {
    $topicos[$i] = $res[$i]['top_name'];
    $status[$i] = $res[$i]['top_status'];
    $topicos_id[$i] = $res[$i]['top_id_pk'];
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Fabiann Barbosa">

    <title>Curumim Trigonometria</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="../img/ico.ico" type="image/x-icon">
    <link rel="icon" href="../img/ico.ico" type="image/x-icon">
</head>

<body id="page-top">
    </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">ALUNO</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Conteúdos
            </div>


            <?php

            // foreach topicos
            for ($i = 0; $i < $total_reg; $i++) {

                $topicoFormatado = removerAcentos(strtolower(str_replace(" ", "_", $topicos[$i])));
                $query = $pdo->query("SELECT * FROM postagens WHERE top_id_fk = '$topicos_id[$i]'");
                // console log para verificar se o topico está sendo carregado
                echo "<script>console.log('$topicos[$i]');  console.log('$topicos_id[$i]');</script>";

                if ($status[$i] == 1) {
                    echo '<li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse', $topicoFormatado, '" aria-expanded="true" aria-controls="collapse', $topicoFormatado, '">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>' . $topicos[$i] . '</span>
                    </a>
                    ';
                }
                if ($status[$i] == 0) {
                    echo '<li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse', $topicoFormatado, '" aria-expanded="true" aria-controls="collapse', $topicoFormatado, '">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>' . $topicos[$i] . '</span>
                    </a>
                    ';
                }




                echo '<div id="collapse', $topicoFormatado, '" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">';
                echo '<div class="bg-white py-2 collapse-inner rounded">';
                echo '<h6 class="collapse-header">Sub-Conteúdos:</h6>';



                $res2 = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg2 = @count($res2);

                for ($j = 0; $j < $total_reg2; $j++) {
                    $postagemFormatada = removerAcentos(strtolower(str_replace(" ", "_", $res2[$j]['pos_titulo'])));
                    echo '<a class="collapse-item" href="index.php?pag=conteudo&id=', $res2[$j]['pos_id_pk'], '">', $res2[$j]['pos_titulo'], '</a>';
                }
                echo '</div>';
                echo '</div>';






                // <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                //     <div class="bg-white py-2 collapse-inner rounded">
                //         <h6 class="collapse-header">Ângulos I:</h6>
                //         <a class="collapse-item" href="index.php?pag=">Materiais de estudo</a>
                //         <a class="collapse-item" href="index.php?pag=">Estudos complementares</a>
                //         <a class="collapse-item" href="index.php?pag=">Atividades</a>
                //         <a class="collapse-item" href="index.php?pag=">Revisão do Assunto</a>
                //         <a class="collapse-item" href="index.php?pag=">Desafio</a>
                //     </div>
                // </div> 

                echo '</li>';
            }


            ?>



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                TESTE SEUS CONHECIMENTOS
            </div>



            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?pag=<?php echo $menu6 ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span><b>QUIZ CURUMIM</b></span></a>
            </li>

            <!-- Nav Item - Tables -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <img class="mt-2" src="../img/logo1.png" width="160">



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nome_usu ?></span>
                                <img class="img-profile rounded-circle" src="../img/sem-foto.jpg">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#ModalPerfil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                    Editar Perfil
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php if (@$pag == null) {
                        @include_once("home.php");
                    } else if (@$pag == "conteudo") {
                        @include_once("../painel-aluno/conteudo/index.php");
                    } else {
                        @include_once("home.php");
                    } ?>
                    



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>




    <!--  Modal Perfil-->
    <div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>



                <form id="form-perfil" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input value="<?php echo $nome ?>" type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                                </div>

                                <div class="form-group">
                                    <label>CPF</label>
                                    <input value="<?php echo $cpf ?>" type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input value="<?php echo $email ?>" type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label>Senha</label>
                                    <input value="" type="password" class="form-control" id="text" name="senha" placeholder="Senha">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="col-md-12 form-group">
                                    <label>Foto</label>
                                    <input value="<?php echo $img ?>" type="file" class="form-control-file" id="imagem" name="imagem" onchange="carregarImg();">

                                </div>
                                <div class="col-md-12 mb-2">
                                    <img src="../img/profiles/<?php echo $img ?>" alt="Carregue sua Imagem" id="target" width="100%">
                                </div>
                            </div>
                        </div>



                        <small>
                            <div id="mensagem" class="mr-4">

                            </div>
                        </small>



                    </div>
                    <div class="modal-footer">



                        <input value="<?php echo $idUsuario ?>" type="hidden" name="txtid" id="txtid">
                        <input value="<?php echo $cpf ?>" type="hidden" name="antigo" id="antigo">

                        <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Salvar</button>
                    </div>
                </form>


            </div>
        </div>
    </div>


    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <div class="modal">
        <!-- Place at bottom of page -->
    </div>
</body>


<style>
    df-messenger {
        --df-messenger-bot-message: #C0C0C0;
        --df-messenger-button-titlebar-color: #007fff;
        --df-messenger-chat-background-color: #f0f0f0;
        --df-messenger-font-color: blue;
        --df-messenger-send-icon: #509ed8;
        --df-messenger-user-message: #C0C0C0;
    }
</style>



<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1">


</script>
<df-messenger intent="WELCOME" chat-title="Curumim Assistente" chat-icon="https://imgur.com/tx1neHH.png" agent-id="99180b3c-bb9f-48e7-9282-f6a81556ae57" language-code="pt-br"></df-messenger>

</html>