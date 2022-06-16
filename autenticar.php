<?php 
require_once("conexao.php");
@session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = $pdo->prepare("SELECT * FROM usuarios where email = :email and senha = :senha");
$query->bindValue(":senha", $senha);
$query->bindValue(":email", $email);
$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	
	$_SESSION['id_usuario'] = $res[0]['id'];
	$_SESSION['nome_usuario'] = $res[0]['nome'];
	$_SESSION['cpf_usuario'] = $res[0]['cpf'];
	$_SESSION['nivel_usuario'] = $res[0]['nivel'];

	$nivel = $res[0]['nivel'];

	//TODO : REFATORAR


	
	switch ($nivel) {
		case 'professor':
			echo "<script language='javascript'> window.location='painel-professor' </script>";
		break;
		case 'aluno':
			echo "<script language='javascript'> window.location='painel-aluno' </script>";
		break;
		default:
			echo "<script language='javascript'> window.location='index.php' </script>";
	}


}else{
	echo "<script language='javascript'> window.alert('Usuário ou Senha Incorreta!') </script>";
	echo "<script language='javascript'> window.location='index.php' </script>";	
}


?>