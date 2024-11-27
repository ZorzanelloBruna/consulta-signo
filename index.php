<?php include('layouts/header.php');
$tema = isset($_POST['tema']) ? $_POST['tema'] : 'claro'; // Valor padrão é 'claro'
// Define a classe de tema com base na escolha do usuário, incluindo a opção de fundo azul
if ($tema === 'escuro') {
    $classeTema = 'bg-dark text-light';
} elseif ($tema === 'azul') {
    $classeTema = 'bg-primary text-light'; // Fundo azul com texto claro
} else {
    $classeTema = 'bg-light text-dark'; // Padrão claro
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de signo</title>
</head>
<style>
        body {
            background-image: url('assets/imgs/fundo_de_tela.jpg');
            background-size: cover; /* Faz a imagem cobrir toda a tela */
            background-repeat: no-repeat; /* Impede a repetição da imagem */
            background-position: center; /* Centraliza a imagem */
            height: 100vh; /* Define a altura do body como 100% da altura da janela */
            margin: 0; /* Remove a margem padrão do body */
            color: white
        }
    </style>
    <div class="container mt-5 d-flex flex-column align-items-center">
        <h1 style="margin-left: 0;"><strong>Descubra seu signo</strong></h1>
        <div class="mt-3 w-50 d-flex flex-column align-items-center">
        <form id="signo-form" method="POST" action="show_zodiac_sign.php">
            <div class="mb-3">
                <label for="data_nascimento" 
                       class="form-label fs-5"
                       style="margin-top: 20px; margin-left: 5px;">
                       <strong>Informe sua data de Nascimento</strong>
                </label>
                <input 
                    type="date" 
                    id="data_nascimento" 
                    name="data_nascimento" 
                    class="form-control"
                    style="margin-top: 20px;"
                    required>
            </div>
            <button 
                type="submit" 
                class="btn btn-primary" 
                style="margin-left: 100px; margin-top: 20px;">
                <strong>Consultar</strong>
            </button>
        </form>
        </div>
    </div>
</body>
</html>