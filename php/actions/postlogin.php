<?php
    session_start();
    require_once 'conexaodb.php';


    if(empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location:../../index.php');
    
	exit();
}
 
$email = mysqli_real_escape_string($conn, $_POST['email']);
$senha = mysqli_real_escape_string($conn, $_POST['senha']);
 
$query = "SELECT id_usuario, email, nome, sobre, sobrenome, endereco, cep, bairro, complemento, telefone FROM `usuarios` WHERE email='{$email}' and senha = md5('{$senha}')";
 
$result = mysqli_query($conn, $query);



if($result->num_rows > 0){
    while($rows = $result->fetch_assoc()){
       $nome = $rows['nome'];
       $sobre = $rows['sobre'];
       $sobrenome = $rows['sobrenome'];
       $endereco = $rows['endereco'];
       $cep = $rows['cep'];
       $bairro =$rows['bairro'];
       $complemento = $rows['complemento'];
       $telefone = $rows['telefone'];

    }}
$row = mysqli_num_rows($result);



if($row == 1) {
    $_SESSION['email'] = $email;
    $_SESSION['nome'] = $nome;
    $_SESSION['sobre'] = $sobre;
    $_SESSION['sobrenome'] = $sobrenome;
    $_SESSION['endereco'] = $endereco;
    $_SESSION['cep'] = $cep;
    $_SESSION['bairro'] = $bairro;
    $_SESSION['complemento'] = $complemento;
    $_SESSION['telefone'] = $telefone;
    header('Location: ../../perfil.php');
	exit();
} 

else {
    $_SESSION['nao_autenticado'] = true;
    
    echo "<script>alert('Houve um erro ao salvar...');</script>";

    // header('Location:../../index.php');
    
	exit();
}

?>