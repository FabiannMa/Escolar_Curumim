<div class="flex justify-around">"
    <div class="card p-6 w-full ml-12 my-6">
        <?php
        // Recupera a PK da turma
        $sql = "SELECT tur_id_pk FROM turmas WHERE tur_hash_code = '$id_turma'";
        $result = $pdo->query($sql);
        $turma = $result->fetch();
        $id_turma_pk = $turma['tur_id_pk'];


        echo "
        <div class='flex justify-between'>
        <div>
        <h3>Tópicos Criados</h3>";
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
            echo "<a href='util/removeTopico.php?id=" . $topico['top_id_pk'] . "&tur_id=".$id_turma_pk."' class='btn btn-danger'>Remover</a>";
            echo "</div>";
            

        ?>


    </div>

<?php
        }
        echo "</div>";
        echo "<div>";
        echo "<h3>Tópicos Relacionados</h3>";
        // Recupera todos os tópicos relacionados a turma
        $sql = "SELECT * FROM topicos WHERE top_id_pk IN (SELECT top_id_fk FROM turma_topicos WHERE tur_id_fk = $id_turma_pk)";
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
                echo "<a href='util/removeTopico.php?id=" . $topico['top_id_pk'] . "&tur_id=".$id_turma_pk."' class='btn btn-danger'>Remover</a>";
                echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
?>
<aside class="flex flex-col justify-center">
    <hr class="my-6">
    <h3> Criar tópico </h1>
        <form method="POST" action="util/sendTopico.php" class="flex mt-4 w-full">
            <div class="w-full mb-4">
                <input type="text" name="topico" id="topico" class="form-control" placeholder="Nome do Tópico">
                <input type="hidden" name="turmas" value="<?php echo $id_turma_pk; ?>">
            </div>
            <input type="submit" name="btn-enviar" id="btn-enviar" class="btn-primary rounded-sm h-10 p-2" value="Adicionar">
        </form>
</aside>
<aside class="flex flex-col justify-center">
    <hr class="my-6">
    <h3> Atribuir tópico existente</h3>
    <form method="POST" action="util/atribuirTopico.php" class="flex mt-4 w-full">
        <div class="w-full mb-4">
            <select name="topico" id="topico" class="form-control">
                <?php
                // Recupera todos os tópicos
                $sql = "SELECT * FROM topicos";
                $result = $pdo->query($sql);
                $topicos = $result->fetchAll();
                
                // Verifica relação entre tópico e turma
                foreach ($topicos as $topico) {
                    $sql = "SELECT * FROM turma_topicos WHERE top_id_fk = " . $topico['top_id_pk'] . " AND tur_id_fk = " . $id_turma_pk;
                    $result = $pdo->query($sql);
                    $relacao = $result->fetch();
                    if ($relacao == false) {
                        echo "<option value='" . $topico['top_id_pk'] . "'>" . $topico['top_name'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <input type="hidden" name="id_turma" value="<?php echo $id_turma_pk; ?>">
        <input type="submit" name="btn-enviar" id="btn-enviar" class="btn-primary rounded-sm h-10 p-2" value="Atribuir">
    </form>
</aside>

</div>