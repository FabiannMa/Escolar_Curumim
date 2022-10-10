<?php
@session_start();
require_once("../../conexao.php");
//variaveis para o menu
$pag = @$_GET["pag"];
$menu_atividade = "AtviMenu";
$topicos = "TopMain";
$questoes = "QuestoesMenuSend";
 
//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * FROM usuarios where id = '$_SESSION[id_usuario]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = @$res[0]['nome'];
$cpf_usu = @$res[0]['cpf'];
$email_usu = @$res[0]['email'];
$idUsuario = @$res[0]['id'];
$photoProf = @$res[0]['foto'];

if (@$_SESSION['nivel_usuario'] != 'professor' || @$_SESSION['id_usuario'] == null) {
    echo "<script language='javascript'> window.location='../index.php' </script>";
    @session_destroy();
}


// Recupera dados da turma 
$id_turma = @$_GET['id_turma'];
$_SESSION['id_turma'] = $id_turma;

$query = $pdo->query("SELECT * FROM turmas where tur_hash_code = '$id_turma'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (@$res[0]['tur_hash_code'] == null) {
    echo "<script language='javascript'> window.location='../index.php' </script>"; 
}
$nome_turma = @$res[0]['tur_name'];


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
    <!-- link rell tailwindcss -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">

    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../Packages/Trumbowyg/dist/ui/trumbowyg.min.css">

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="../../img/ico.ico" type="image/x-icon">
    <link rel="icon" href="../../img/ico.ico" type="image/x-icon">


</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper" style="height: 100vh">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand align-items-center justify-content-center" href="../">

                <div class="sidebar-brand-text mx-3 d-flex flex-col ">
                    <!-- icone de home -->
                    <strong>Menu Do Professor</strong>
                
                    <i class="fas fa-home"></i>
                </div>
                
            </a>



            <br><br>    

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Conteúdos e Atividades

            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>MATERIAL DE AULA</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Questões:</h6>

                        <a class="collapse-item" href="<?php echo $_SERVER['REQUEST_URI']."&pag=".$questoes ?>"> Questões</a>

                    </div>
                </div>
            </li>

           

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gerenciar Turmas
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTurma" aria-expanded="true" aria-controls="collapseTurma">
                    <i class="fas fa-table"></i>
                    <span>Gerenciar Turmas</span></a>
                <div id="collapseTurma" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Turma: <?php echo "nome da turma" ?> </h6>
                        <a class="collapse-item" href="<?php echo $url = $_SERVER['REQUEST_URI']."&pag=". $topicos ?>">Tópicos</a>
                        <a class="collapse-item" href="gerenciar-turmas/lista-matriculas.php?id_turma=<?php echo $id_turma;?>">Alunos matriculados</a>
                   
            
                    </div>

            </li>

          

            <li class="nav-item">
                
                
                <a class="nav-link" href="<?php echo $url = $_SERVER['REQUEST_URI']."&pag=". $menu_atividade ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <!-- <span><b>NOTIFICAÇÕES</b></span></a> -->
                    <span><b>ENVIAR CONTEUDO</b></span  ></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-end justify-content-center" href="
            <?php 
            // pega a url atual
            $url = $_SERVER['REQUEST_URI'];
            // remove tudo depois do id_turma
            $url = substr($url, 0, strpos($url, "&"));
            echo $url;
            ?>
            " style="height: 64vh;">
                <div class="sidebar-brand-text mx-3"><?php echo $nome_turma; ?></div>
            </a>

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
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        
                        <!-- Nav Item - Messages -->
                   
                        <!-- Nav Item - User Information -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nome_usu ?></span>
                                    <img class="img-profile rounded-circle" src="../../img/profilepics/<?php echo $photoProf; ?>">

                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    
                                    <a class="dropdown-item" href="../../logout.php">
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

                    <!-- Page Heading -->




                    <!-- Finalizado aqui testes -->

                    <?php

                    if ($pag == null) {
                        @include_once "turma_menu.php";
                    } elseif ($pag == $menu_atividade) {
                        @include_once "enviarAtividade.php";
                    } elseif ($pag == $topicos) {
                        @include_once "topicos.php";
                    } elseif ($pag == $questoes){
                        @include_once "enviarQuestao.php";
                    }else{
                        @include_once "turma_menu.php";
                    }
                        

                    ?>



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
                                    <img src="../../img/profiles/<?php echo $img ?>" alt="Carregue sua Imagem" id="target" width="100%">
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
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>

</body>

</html>