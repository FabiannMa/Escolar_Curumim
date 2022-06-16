<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">

<h1 class="text-center text-3xl mb-6">Bem vindo ao Painel do Aluno</h1>

<!-- formulário para entrar em turma -->
<form action="utils/associateUserTurma.php" method="post" class="w-full flex justify-end">
    <div class="flex items-center">
        <label for="codigo_turma" class="text-xl mr-2">Entrar em<br> uma turma:</label>
    
        <input type="text" name="codigo_turma" id="codigo_turma" class="p-2 border h-10 border-gray-400 rounded-lg" placeholder="Código da turma">
        <button type="submit" class="bg-blue-500 h-10 w-10 flex items-center justify-center hover:bg-blue-700 text-white font-bold rounded-lg">
            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z" />
            </svg>
            
        </button>
    </div>
</form> 

<!-- Mostra mensagem de erro caso o Aluno não esteja em uma turma -->
<?php if (!verifyClassroom($pdo, $_SESSION['id_usuario'])) : ?>
    <center>
        <div class="alert alert-danger text-center flex justify-around w-2/4">
            <p class="w-2/4">Você não está em uma turma. Por favor, entre em uma turma para acessar o conteúdo.</p>
            <!-- Input para adicionar código da turma -->
            <form action="utils/associateUserTurma.php" method="POST" class="w-2/4 flex items-end mx-6">
                <input type="text" name="codigo_turma" id="turma" class="form-control" placeholder="Código da turma">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>
    </center>
<?php endif; ?>

<!-- Mostra turmas do Aluno -->
<?php if (verifyClassroom($pdo, $_SESSION['id_usuario'])) : ?>
    <?php
    // Recupera turmas do Aluno
    $sql = "SELECT turmas.tur_id_pk, turmas.tur_name, turmas.tur_status, turmas.tur_imagem, turmas.tur_hash_code, turmas.data_cadastro FROM turmas INNER JOIN turma_usuario ON turmas.tur_id_pk = turma_usuario.tur_id_fk WHERE turma_usuario.usu_id_fk = " . $_SESSION['id_usuario'] . ";";
    $query = $pdo->query($sql);
    $turmas = $query->fetchAll(PDO::FETCH_ASSOC);

    ?>

 
    <!--- Grid de turmas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($turmas as $turma) : ?>
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="flex justify-between">
                    <div class="flex justify-between items-center">
                        <img src="<?php
                                    // TODO: ADICIONAR IMAGEM DE TURMA
                                    // echo $turma['tur_imagem'];
                                    echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRj1y4LpdrJ4UjhRJUmY5xIrQY3G470CWhYIw&usqp=CAU";
                                    ?>" alt="<?php echo $turma['tur_name']; ?>" class="h-24 w-24 rounded-xl">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-green-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                < path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <h3 class="text-2xl font-bold"><?php echo $turma['tur_name']; ?></h3>
                        <div class="flex items-center">
                            <?php if ($turma['tur_status'] == 1) : ?>
                                <svg class="h-6 w-6 text-green-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            <?php else : ?>
                                <svg class="h-6 w-6 text-red-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6 ">
                    <p class="text-gray-700 text-sm">Código: <?php echo $turma['tur_hash_code']; ?></p>
                    <p class="text-gray-700 text-sm">Entrou em: <?php echo $turma['data_cadastro']; ?></p>
                </div>
                <!-- mostra quantidade de conteúdos da turma -->
                <div class="flex justify-between items-center mt-6">
                    <p class="text-gray-700 text-sm">Conteúdos: <?php echo getConteudosTurma($pdo, $turma["tur_id_pk"]) ?></p>
                    <a href="turma/?id=<?php echo $turma['tur_id_pk']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Acessar
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>