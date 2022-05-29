<?php
    echo "<h3>Criar Tópico</h3>";
?>

<form method="POST" action="util/sendTopico.php">
    <label>Tópico</label>
    <input type="text" name="topico" id="topico" class="form-control" placeholder="Nome do Tópico">
    <br>
    <input type="submit" name="btn-enviar" id="btn-enviar" class="btn btn-primary" value="Enviar">
</form>