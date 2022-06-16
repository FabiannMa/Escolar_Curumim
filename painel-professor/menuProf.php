<!-- link rell tailwindcss -->
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">


<div class="d-sm-flex align-items-start justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Turmas Criadas</h1>
    <div class="flex-col" >  

        <a class="btn btn-primary btn-icon-split w-full" >
            <span class="icon text-white-50" onclick="verifyAdd('adTurm')" style="cursor:pointer">
                <i class="fas fa-plus"></i>
            </span>
            <span> <input type="text" class="text w-full" placeholder="Criar Turma" id="adTurm"></span>
        </a>
       
    </div>
</div>

<!-- Content Row -->
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

<script>
   
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
</script>