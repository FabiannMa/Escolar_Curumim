<?php
echo "<h3>Criar Tópico</h3>";
?>

<form method="POST" action="util/sendTopico.php">
    <label>Tópico</label>
    <input type="text" name="topico" id="topico" class="form-control" placeholder="Nome do Tópico">
    <br>
    <input type="submit" name="btn-enviar" id="btn-enviar" class="btn btn-primary" value="Enviar">
</form>

<div class="flex justify-around">"
<div class="card p-6 w-2/5 ml-12 my-6">
<?php
echo "<br><h3>Tópicos Criados</h3>";
// Recupera todos os tópicos
$sql = "SELECT * FROM topicos";
$result = $pdo->query($sql);
$topicos = $result->fetchAll();
foreach ($topicos as $topico) {
    echo "<div class='card'>";
    echo "<div class='card-body flex flex-row justify-between'>";
    echo '<div class="flex items-center">';
    echo "<h5 class='card-title mx-4'>" . $topico['top_name'] . "</h5>";
    echo "<p class='card-title'>  Status: " . $topico['top_status'] . "</p>";
    echo "</div>";
    // Remover tópico
    echo "<a href='util/removeTopico.php?id=" . $topico['top_id_pk'] . "' class='btn btn-danger'>Remover</a>";
    echo "</div>";
    echo "</div>";
}
?>
</div>

<!-- // Lista as turmas criadas -->
<div class="card p-6 w-full mx-12 my-6">
<?php
echo "<br><h3>Turmas Criadas</h3>";
// Recupera todas as turmas
$sql = "SELECT * FROM turmas";
$result = $pdo->query($sql);
$turmas = $result->fetchAll();
foreach ($turmas as $turma) {
    echo "<div class='card'>";
    echo "<div class='card-body flex flex-row justify-between'>";
    echo '<div class="flex items-center">';
    echo "<h5 class='card-title mx-4'>" . $turma['tur_name'] . "</h5>";
    echo "<p class='card-title'>  Status: " . $turma['tur_status'] . "</p>";
    echo "</div>";
    // Remover turma
    echo "<a href='util/removeTurma.php?id=" . $turma['tur_id_pk'] . "' class='btn btn-danger'>Remover</a>";
    echo "</div>";
    echo "</div>";
}

// Caso não exista nenhuma turma criada, exibe mensagem
if (count($turmas) == 0) {
    echo "<h5>Nenhuma turma criada</h5>";
}


?>
</div>

</div>

<?php
// Enviar Postagem
echo '<div class="flex justify-around">
        <div>
            <h3 class="mt-6">Enviar Conteúdo</h3>';
?>
<form action="util/sendConteudo.php" method="POST" class="card" style="width:35vw">
    <div class="form-group card-body">
        <label for="exampleFormControlTextarea1">Título</label>
        <input type="text" class="form-control" id="exampleFormControlTextarea1" name="title" rows="1">
    </div>
    <div class="form-group card-body">
        <label for="exampleFormControlTextarea2">Conteúdo</label>
        <textarea class="form-control" id="exampleFormControlTextarea2" name="content" rows="3"></textarea>
    </div>

    <div class="form-group card-body flex flex-col w-1/3">
        <label for="exampleFormControlTextarea1">Tópico</label>
        <select class="form-control" name="top">
            <?php
            foreach ($topicos as $topico) {
                echo "<option value='" . $topico['top_id_pk'] . "'>" . $topico['top_name'] . "</option>";
            }
            ?>
        </select>



    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>

</form>
</div>

<!-- Cria Turmas -->
<?php
echo "<div><h3 class='mt-6'>Criar Turma</h3>";
?>
<form method="GET" action="util/createClassroom.php" class="card" style="width:35vw">
    <div class="form-group card-body">
        <label>Nome da Turma</label>
        <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome da Turma">
        <br>
        <label>Status</label>
        <select name="status" id="status" class="form-control">
            <option value="1">Ativa</option>
            <option value="0">Inativa</option>
        </select>
        <br>
        
        <br>
        <input type="submit" name="btn-enviar" id="btn-enviar" class="btn btn-primary" value="Enviar">
    </div>
</form>
</div>
</div>