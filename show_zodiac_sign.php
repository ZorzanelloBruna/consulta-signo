<?php
include('layouts/header.php');

// Recebe a data de nascimento enviada pelo formulário no formato Y-m-d
$data_nascimento = $_POST['data_nascimento'];

// Converte a data do formato Y-m-d para um objeto DateTime
$data_nascimento_formatada = DateTime::createFromFormat('Y-m-d', $data_nascimento);

// Verifica se a data de nascimento é válida
if (!$data_nascimento_formatada) {
    die('Formato de data de nascimento inválido. Por favor, insira a data corretamente.');
}

// Carrega o arquivo XML
$signos = simplexml_load_file("signos.xml");

$signoEncontrado = null;
$imagemSigno = ''; // Inicializa a variável da imagem

// Itera sobre os signos
foreach ($signos->signo as $signo) {
    $dataInicio = DateTime::createFromFormat('d/m/Y', $signo->dataInicio . '/' . $data_nascimento_formatada->format('Y'));
    $dataFim = DateTime::createFromFormat('d/m/Y', $signo->dataFim . '/' . $data_nascimento_formatada->format('Y'));

    if (!$dataInicio || !$dataFim) {
        die('Erro ao criar datas de início e fim para o signo.');
    }

    if ($dataInicio > $dataFim) {
        $dataFim->modify('+1 year');
    }

    if ($data_nascimento_formatada >= $dataInicio && $data_nascimento_formatada <= $dataFim) {
        $signoEncontrado = $signo;
        $imagemSigno = $signo->imagem; // Define a variável da imagem
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Signo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css"> 
</head>
<body class="custom-body-bg">

<div class="container mt-5 text-center">
    <?php if ($signoEncontrado): ?>
        <!-- Exibição do nome do signo -->
        <h1 class="display-3 signo-nome" style="color: white;"><?php echo $signoEncontrado->signoNome; ?></h1>

        <!-- Exibição da descrição do signo -->
        <p class="lead signo-descricao"><?php echo $signoEncontrado->descricao; ?></p>

          <!-- Exibição da imagem do signo -->
        <img src="<?php echo $imagemSigno; ?>" class="img-fluid my-3" alt="Imagem do Signo" style="max-width: 150px;">

        <!-- Botão "Voltar" alinhado à direita -->
        <div class="text-center">
            <a href="index.php" class="btn btn-primary mt-4">Voltar</a>
        </div>

    <?php else: ?>
        <p>Signo não encontrado!</p>
        <a href="index.php" class="btn btn-primary mt-4">Voltar</a>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
