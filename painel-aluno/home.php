<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">

<h1 class="text-center text-3xl mb-6">Bem vindo ao Painel do Aluno</h1>

<!-- Mostra mensagem de erro caso o Aluno não esteja em uma turma -->
<?php if (!verifyClassroom($pdo, $_SESSION['id_usuario'])) : ?>
    <center>
        <div class="alert alert-danger text-center flex justify-around w-2/4">
            <p class="w-2/4">Você não está em uma turma. Por favor, entre em uma turma para acessar o conteúdo.</p>
            <!-- Input para adicionar código da turma -->
            <form action="" method="POST" class="w-2/4 flex items-end mx-6">
                <input type="text" name="codigo_turma" id="turma" class="form-control" placeholder="Código da turma">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>
    </center>
<?php endif; ?>

<!-- Mostra turmas do Aluno -->
<?php if (verifyClassroom($pdo, $_SESSION['id_usuario'])) : ?>
    <div class="flex justify-center">
        <div class="w-2/4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Turmas</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Status</th>
                                <th scope="col">Imagem</th>
                                <th scope="col">Data de cadastro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($turmas as $turma) : ?>
                                <tr>
                                    <th scope="row"><?= $turma['tur_id_pk'] ?></th>
                                    <td><?= $turma['tur_name'] ?></td>
                                    <td><?= $turma['tur_status'] ?></td>
                                    <td><?= $turma['tur_imagem'] ?></td>
                                    <td><?= $turma['data_cadastro'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>