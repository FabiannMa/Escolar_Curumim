<?php
@session_start();
require_once("../conexao.php");
//variaveis para o menu
$pag = @$_GET["pag"];
$menu1 = "menu1";
$menu2 = "menu2";
$menu3 = "menu3";
$menu4 = "menu4";
$menu5 = "menu5";
$menu6 = "enviarAtividade";



//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * FROM usuarios where id = '$_SESSION[id_usuario]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = @$res[0]['nome'];
$cpf_usu = @$res[0]['cpf'];
$email_usu = @$res[0]['email'];
$idUsuario = @$res[0]['id'];

if (@$_SESSION['nivel_usuario'] != 'professor' || @$_SESSION['id_usuario'] == null) {
    echo "<script language='javascript'> window.location='../index.php' </script>";
    @session_destroy();
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
    
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
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


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                <div class="sidebar-brand-text mx-3">PROFESSOR</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                GERENCIAR
            </div>



            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>MATERIAL DE AULA</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Geometria Básica:</h6>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu1 ?>">Ângulos</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu2 ?>">Formas Básicas</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu2 ?>">Triângulos Retângulos</a>

                        <h6 class="collapse-header">Funções Trigonométricas:</h6>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu1 ?>">Círculo Trigonométrico</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu2 ?>">Radianos</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu2 ?>">Seno, Coseno e Tangente</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-home"></i>
                    <span>CORREÇÃO DAS TAREFAS</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tarefas</h6>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu3 ?>">Trabalho I</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu4 ?>">Atividade em Equipe</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu5 ?>">Avaliação</a>

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!--  <div class="sidebar-heading">
                    MENSAGEM
                </div> -->



            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?pag=<?php echo $menu6 ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <!-- <span><b>NOTIFICAÇÕES</b></span></a> -->
                    <span><b>ENVIAR CONTEUDO</b></span></a>
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
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>





                        <!-- Nav Item - User Information -->
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

                   




                            <!-- Finalizado aqui testes -->

                            <?php if (@$pag == null) {
                                @include_once("graficos.php");
                            } else if (@$pag == $menu1) {
                                @include_once(@$menu1 . ".php");
                            } else if (@$pag == $menu2) {
                                @include_once(@$menu2 . ".php");
                            } else if (@$pag == $menu3) {
                                include_once(@$menu3 . ".php");
                            } else if (@$pag == $menu4) {
                                @include_once(@$menu4 . ".php");
                            } else if (@$pag == $menu5) {
                                @include_once(@$menu5 . ".php");
                            } else if (@$pag == $menu6) {
                                @include_once(@$menu6 . ".php");
                            } else {
                                @include_once("home.php");
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

</body>

</html>