<?php
require_once("../../conexao.php");

// Verificar se o usuário está logado antes de mostrar o conteúdo
require_once("../utils/verifyAuth.php");



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
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">

    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="../img/ico.ico" type="image/x-icon">
    <link rel="icon" href="../../img/ico.ico" type="image/x-icon">

    <!-- tailwind css-->

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
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
                Turmas
            </div>


            <?php

            // Mostra turmas do usuário na barra de menu

            if (true) {
                echo '<li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse', $topicoFormatado, '" aria-expanded="true" aria-controls="collapse', $topicoFormatado, '">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>AlO SOM</span>
                    </a>
                    ';
            }







            

            echo '</li>';



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
                    <img class="mt-2" src="../../img/logo1.png" width="160">



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo "bizu" ?></span>
                                <img class="img-profile rounded-circle" src="../../img/sem-foto.jpg">

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

                    <!-- Card da pagina -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <?php echo "Turmas 2002" ?>
                            </h6>
                        </div>
                        <div class="card-body">
                            <!-- Menu de Opções em cards -->
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        <?php echo "Turma 2002" ?>
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo "Conteúdos" ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        <?php echo "Turma 2002" ?>
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo "Fórum" ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        <?php echo "Turma 2002" ?>
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                <?php echo "Provas" ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        <?php echo "Turma 2002" ?>
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo "Desempenho" ?>

                                                        <!-- Desempenho em porcentagem -->
                                                        <div class="progress progress-sm mr-2">
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 1%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                    <!-- /.container-fluid -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Conteúdos
                            </h6>
                        </div>
                        <div class="card-body">
                            <!-- Menu de Opções em cards -->
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <!-- mostra conteudos da turma -->
                                    <?php

                                    // Recupera os conteudos da turma
                                    $sql = "SELECT * FROM postagens WHERE top_id_fk IN (SELECT top_id_fk FROM turma_topicos WHERE tur_id_fk = $_GET[id])";
                                    $query = $pdo->query($sql);
                                    $conteudos = $query->fetchAll();
                                    $index = 0;
                                    // Mostra os conteudos

                                    echo '<div class="accordion" id="accordionExample" style="width:80vw;"> ';
                                    foreach ($conteudos as $conteudo) {
                                    ?>
                                        <div class="accordion-item bg-white border border-gray-200">
                                            <h2 class="accordion-header mb-0" id="heading<?php echo $index ?>">
                                                <button class=" accordion-button relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left bg-white border-0 rounded-none transition focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index ?>" aria-expanded="<?php if ($index == 0) { echo "true";} else { echo "false"; } ?> aria-controls=" collapse<?php echo $index; ?>">
                                                    <?php
                                                    echo $conteudo['pos_titulo'];
                                                    ?>
                                                </button>
                                            </h2>
                                            <div id="collapse<?php echo $index ?>" class="accordion-collapse collapse <?php if ($index == 0) {echo "show";} ?>" aria-labelledby="heading<?php echo $index ?>" data-parent="#accordionExample">
                                                <div class="accordion-body py-4 px-5">
                                                    <?php
                                                    echo $conteudo['pos_texto'];
                                                    ?>
                                                </div>
                                            </div>


                                        <?php
                                        $index++;
                                    }
                                        ?>



                                        </div>
                                </div>

                            </div>
                            <!-- End of Main Content -->



                        </div>
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
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

</html>