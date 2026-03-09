<?php

//pegando os dados vindos do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];
$data_atual = date('d-m-Y'); //formarto brasileiro "é como eu prefiro"
$hora_atual = date('H:i:s');

//configurações de credenciais
$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'projeto_formulario';

//conexão com o banco de dados
$conn = new mysqli($server, $usuario, $senha, $banco);

//verificador de conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$smtp = $conn->prepare("INSERT INTO mensagens (nome, email, mensagem, data, hora) VALUES (?,?,?,?,?)");
$smtp->bind_param("sssss", $nome, $email, $mensagem, $data_atual, $hora_atual);

if(smtp->execute()) {
    echo "Mensagem enviada com sucesso!";
} else {
    echo "Erro ao enviar mensagem: " . $smtp->error;
}

$smtp->close();
$conn->close();

?>