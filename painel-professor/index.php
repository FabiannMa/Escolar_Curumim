<?php
@session_start();
require_once("../conexao.php");
//variaveis para o menu
$pag = @$_GET["pag"];




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


// recupera as mensagens do usuário
$sql = "SELECT * FROM mensagens WHERE id_usu_destinatario = $idUsuario";
$result = $pdo->query($sql);
$mensagens = $result->fetchAll();

$qtd = count($mensagens);

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
    <!-- link rell tailwindcss -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <link rel="stylesheet" href="../css/messageArea.css">

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="../img/ico.ico" type="image/x-icon">
    <link rel="icon" href="../img/ico.ico" type="image/x-icon">


</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper" style="height: 100vh">

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
                Acesso Rápido

            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Turmas</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Minhas Turmas:</h6>
                        <?php
                        $query = $pdo->query("SELECT * FROM turmas where tur_id_professor = '$_SESSION[id_usuario]'");
                        $res2 = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($res2 as $row) {
                            echo "<a class='collapse-item' href='turma/?id_turma=$row[tur_hash_code]'>$row[tur_name]</a>";
                        }
                        ?>


                    </div>
                </div>
            </li>



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
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" onclick="closeMessage()">
                                <i class="fas fa-envelope fa-fw"></i>

                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                             
                            </div>
                        </li>
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

                        <!-- Mensagens recebidas -->

                        <!-- Nav Item - Messages -->
                        <!-- Dropdown - Messages -->




                        <div class="topbar-divider d-none d-sm-block"></div>





                        <!-- Nav Item - User Information -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nome_usu ?></span>
                                    <img class="img-profile rounded-circle" src="../img/profilepics/<?php echo $photoProf; ?>" style=" object-fit: cover;">

                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                   

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
                <div class="container-fluid row ">






                    <!-- Finalizado aqui testes -->


                    <div style="width:85vw; margin-left:1vw;margin-right:2vw;">
                        <div class="d-sm-flex align-items-start justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Turmas Criadas</h1>
                            <div class="flex-col">

                                <a class="btn btn-primary btn-icon-split w-full">
                                    <span class="icon text-white-50" onclick="verifyAdd('adTurm')" style="cursor:pointer">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span> <input type="text" class="text w-full" placeholder="Criar Turma" id="adTurm"></span>
                                </a>

                            </div>
                        </div>
                        <div class="row">
                            <!-- Mostrar turmas do Professor -->
                            <?php
                            require_once "./util/classroomMethods.php";
                            if (verifyClassroom($pdo, $_SESSION['id_usuario'])) : ?>
                                <?php foreach (getClassrooms($pdo, $_SESSION['id_usuario']) as $classroom) : ?>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <a href="turma/?id_turma=<?php echo $classroom['tur_hash_code']; ?>">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">

                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                <?php echo $classroom['tur_name']; ?>
                                                            </div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                <?php echo $classroom['tur_hash_code']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <center class="w-full">
                                    <div class="alert alert-danger text-center flex justify-around w-2/4">
                                        <p class="w-full">Você ainda não criou nenhuma turma. Clique no botão ao lado para adicionar uma nova turma.</p>
                                        <!-- Input para adicionar código da turma -->
                                        <!-- TODO : REFATORAR -->
                                        <div class="w-2/4 flex items-end mx-6">
                                            <input type="text" name="codigo_turma" id="turma" class="form-control" placeholder="Nome da Turma">
                                            <button type="submit" class="btn btn-primary" onclick="verifyAdd('turma')">Criar</button>
                                        </div>
                                    </div>

                                </center>

                            <?php endif; ?>




                        </div>



                    </div>

                    <div class=" align-items-start justify-content-between mb-4" id="messageAreaHide">
                        <div class="h3 mb-0 text-gray-800 flex justify-between">Mensagens Recebidas
                            <a class="btn btn-secondary btn-icon-split" style="background-color:  rgb(225 29 72)" onclick="closeMessage()">
                                <span class="icon text-white-50" style="cursor:pointer">
                                    <!-- Icon close -->
                                    <i class="fas fa-times"></i>
                                </span>

                            </a>

                        </div>


                        <!-- Button Close -->

                        <div class="flex-col">
                            <!-- Lista lateral -->


                            <div class="messageBase">
                                <div class="MessageLeftFaces">
                                    <?php
                                    $listaDeUsuarios = [];

                                    if ($qtd > 0) {
                                     
                                    foreach ($mensagens as $mensagem) {
                                        // Recupera dados do usuário que enviou a mensagem
                                        $idRemetente  = $mensagem['id_usu_fk'];
                                        $sql = "SELECT * FROM usuarios WHERE id = $idRemetente ";
                                        $result = $pdo->query($sql);
                                        $usuario = $result->fetch();

                                        // Verifica se o usuário já foi adicionado na lista
                                        if (!in_array($usuario['nome'], $listaDeUsuarios)) {
                                            array_push($listaDeUsuarios, $usuario['nome']);
                                    ?>


                                            <div class="insideFaces" onclick="setId(<?php echo $usuario['id'] ?>)">
                                                <img src="../img/profilepics/<?php echo $usuario['foto']; ?>" class="rounded-circle" style="object-fit: cover;">
                                                <h5> <?php echo $usuario['nome']; ?> </h5>
                                            </div>



                                        <?php
                                        }
                                        ?>



                                    <?php } ?>
                                </div>


                                <?php

                                $indexUser = 0;
                                foreach ($listaDeUsuarios as $usuario) {
                                    $sql = "SELECT * FROM usuarios WHERE nome = '$usuario' ";
                                    $result = $pdo->query($sql);
                                    $usuariofull = $result->fetch();



                                ?>
                                    <div class="MessageAreaPlot" id="plot<?php echo $usuariofull['id'] ?>">
                                        <div class=" headerMessage">
                                            <h5> <?php echo $usuario ?> </h5>
                                            <img src="../img/profilepics/<?php echo $usuariofull['foto']; ?>" class="rounded-circle" style="object-fit: cover;">
                                        </div>

                                        <?php

                                        $sql = "SELECT * FROM mensagens WHERE id_usu_fk = $usuariofull[id] ";
                                        $result = $pdo->query($sql);
                                        $mensagens = $result->fetchAll();

                                        $sql = "SELECT * FROM mensagens WHERE id_usu_destinatario = $usuariofull[id]  and id_usu_fk = $idUsuario";
                                        $result = $pdo->query($sql);
                                        $mensagensEnviadas = $result->fetchAll();

                                        // Mescla as mensagens enviadas e recebidas
                                        $mensagens = array_merge($mensagens, $mensagensEnviadas);
                                        // Ordena as mensagens por data
                                        usort($mensagens, function ($a, $b) {
                                            return $a['data_cadastro'] <=> $b['data_cadastro'];
                                        });

                                       
                                        
                                        foreach ($mensagens as $mensagem) {
                                            $qtd_encontrada++;
                                            if ($mensagem['id_usu_fk'] == $usuariofull['id']) {
                                                

                                        ?>
                                                <div class="MessageArea">
                                                    <div class="MessageHeader">

                                                        <div class="MessageHeaderDate">
                                                            <h4><?php echo $mensagem['data_cadastro'] ?></h4>
                                                        </div>
                                                    </div>
                                                    <div class="MessageContent">
                                                        <p><?php echo $mensagem['mensagem'] ?></p>
                                                    </div>
                                                </div>
                                            <?php
                                            } else {
                                            ?>

                                                <div class="MessageArea Remete">
                                                    <div class="MessageHeader">
                                                        <div class="MessageHeaderDate" style="color: #c0c0c5;">
                                                            <h4><?php echo $mensagem['data_cadastro'] ?></h4>
                                                        </div>
                                                    </div>
                                                    <div class="MessageContent">
                                                        <p><?php echo $mensagem['mensagem'] ?></p>
                                                    </div>
                                                </div>

                                        <?php
                                            }
                                        }
                                
                                        ?>

                                        <div class="formSendMessage">

                                            <input type="text" name="messageBox" placeholder="Digite sua mensagem..." class="form-control" id="messageBox">
                                            <input type="hidden" name="id_usu" value="<?php echo $id_usu; ?>">
                                            <input type="hidden" name="id_prof" value="<?php echo $_SESSION['id_usuario']; ?>">
                                            <input type="submit" value="Enviar" class="btn btn-primary" onclick="reloadPage(<?php echo $usuariofull['id'] ?>)">
                                        </div>
                                    </div>
                                <?php }
                                    } else {
                                        ?>
                                    <div class="alert nomMessage" style="
                                    /* Backgroung yellow */
                                    background: #F9F871;
                                    border: 1px solid #e3e6f0;
                                    border-radius: 0.35rem;
                                    padding: 1rem;
                                    margin: 1rem;
                                    text-align: center; 
                                    ">
                                        <h3 style="
                                            font-size: 1.5rem;
                                            color: #6c757d !important;">Nenhuma mensagem encontrada</h3>
                                    </div>

                                <?php
                                    } ?>
                                ?>
                            </div>



                        </div>
                    </div>



                    <!-- Content Row -->
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


        <script>
            var area = document.getElementById("messageAreaHide");
            var listOfChats = document.getElementsByClassName("MessageAreaPlot");
            // get first element
            var firstElement = listOfChats[0];
            var firstElementId = firstElement.id;
            var firstElementIdNumber = firstElementId.replace(/[^0-9]/g, '');

            var indexEncontrado = 0;

            function setId(id) {
                var listOfChats = document.getElementsByClassName("MessageAreaPlot");
                for (var i = 0; i < listOfChats.length; i++) {
                    if (listOfChats[i].id == "plot" + id) {
                        listOfChats[i].style.display = "flex";
                        indexEncontrado = i;
                    } else {
                        listOfChats[i].style.display = "none";
                    }
                }
            }
            setId(firstElementIdNumber);


            function verifyAdd(strId) {
                var x = document.getElementById(strId);
                // Verifica se o nome foi digitado
                if (x.value == "") {
                    alert("Por favor, digite o nome da turma");
                } else {
                    // redireciona para a página de criação de turma
                    window.location.href = "./util/createClassroom.php?nome=" + x.value;
                }

            }

            function reloadPage(id) {
                var message = document.getElementsByName("messageBox")[indexEncontrado].value;
                var idUsurario = id;
                var idProfessor = document.getElementsByName("id_prof")[0].value;

                // cria formulário
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "./util/message.php");
                form.setAttribute("id", "form-message");

                // set target to blank
                form.setAttribute("target", "_blank");
                // cria input hidden
                var input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "message");
                input.setAttribute("value", message);
                form.appendChild(input);

                var inputIdUsurario = document.createElement("input");
                inputIdUsurario.setAttribute("type", "hidden");
                inputIdUsurario.setAttribute("name", "idUsuario");
                inputIdUsurario.setAttribute("value", idUsurario);
                form.appendChild(inputIdUsurario);
                var inputIdProfessor = document.createElement("input");
                inputIdProfessor.setAttribute("type", "hidden");
                inputIdProfessor.setAttribute("name", "idProfessor");
                inputIdProfessor.setAttribute("value", idProfessor);
                form.appendChild(inputIdProfessor);
                document.body.appendChild(form);
                // submit form

                form.submit();


                // reload page
                window.location.reload();

            }

            function closeMessage(){
                
                if (area.style.display === "none") {
                    area.style.display = "block";
                } else {
                    area.style.display = "none";
                }
            }
        </script>

</body>

</html>