<?php
include './conn.php';
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se o usuário está logado e se a sessão 'cod_emp' está definida
if (!isset($_SESSION['cod_usuario'])) {
    http_response_code(401); // Não autorizado
    echo json_encode(['error' => 'Acesso não autorizado.']);
    exit;
}

$cod_usuario = $_SESSION['cod_usuario'];
$cod_emp = isset($_SESSION['cod_emp']) ? $_SESSION['cod_emp'] : null;

// Debugging: Verificação das variáveis de sessão
if (is_null($cod_emp)) {
    echo "Erro: 'cod_emp' não está definido na sessão.<br>";
}

// Consulta para contar as vagas abertas
$sql = "SELECT COUNT(*) AS total FROM vaga WHERE cod_emp = ? AND situacao_vaga = 'Aberta'";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "Erro na preparação da consulta: " . htmlspecialchars($conn->error) . "<br>";
    exit;
}

$stmt->bind_param("i", $cod_emp);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$vagas_abertas_count = $row['total'] ?? 0;

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sbstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <script src="javascript/javascriptVagadash.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="javascript/javascriptChart.js"></script>

    <title>Dashboard</title>
</head>

<body class="v-body">
    <nav class="nav-sidebar">
        <?php include 'sidebar.php'; ?>
    </nav>
    <div class="v-principal">
        <h1>Dashboard</h1>
        <div class="dash-top">
            <div class="dash-vagas-abertas">
                <p>Vagas Abertas: <?php echo $vagas_abertas_count; ?></p>
            </div>
            <div class="dash-portfolios-recebidos">
                <p>Portfolios Recebidos: </p>
            </div>
            <div class="dash-contratados">
                <p>Contratados: </p>
            </div>
        </div>
        <div class="dash-meio">
            <div class="dash-graf-vagas">
                <div id="chart_div_vagas"></div>
                <div id="png_vagas"></div>
            </div>
            <div class="dash-graf-modali">
                <div id="chart_div_mod"></div>
                <div id="png_mod"></div>
            </div>
            <div class="tabela">
                <table class="table table-bordered table-style">
                    <thead style="background-color: #EEE8AA;">
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="dash-ano">
                <div class="echo">
                    <div>Cargo: <?php echo $_SESSION['cargo']; ?></div>
                    <div>Cod_Emp: <?php echo $_SESSION['cod_emp']; ?></div>
                </div>
            </div>
        </div>
        <br>
        <div class="relatorios">
            <li><a href="relatorios/pdfVagasFechadas.php" target="blank"> Relatório Vagas Fechadas</a></li>
            <li><a href="relatorios/pdfVagasAbertas.php" target="blank"> Relatório Vagas Abertas</a></li>
        </div>

</body>

</html>