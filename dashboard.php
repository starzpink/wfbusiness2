<?php
include './conn.php';

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['usuario'])) {
    $_SESSION['msg'] = "É necessário logar antes de acessar.";
    header("Location: login.php");
    exit;
}

$cargo_permitido = [1, 2]; // Cargos permitidos para esta página
if (!in_array($_SESSION['cargo'], $cargo_permitido)) {
    $_SESSION['msg'] = "Você não tem permissão para acessar esta área.";
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cod_usuario'])) {
    http_response_code(401); // Não autorizado
    echo json_encode(['error' => 'Acesso não autorizado.']);
    exit;
}

$cod_usuario = $_SESSION['cod_usuario'];
$cod_emp = isset($_SESSION['cod_emp']) ? $_SESSION['cod_emp'] : null;

if (is_null($cod_emp)) {
    echo "Erro: 'cod_emp' não está definido na sessão.<br>";
}

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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
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
            <div class="dash-caixas">
                <h2 class="dash-subtitulo">Vagas Abertas</h2>
                <div class="dash-info">
                    <p><?php echo "<div style ='font:4rem Arial,tahoma,sans-serif;color:#008080;margin-top:0.6rem'> $vagas_abertas_count </div>"; ?>
                    </p>
                </div>
            </div>
            <div class="dash-caixas">
                <h2 class="dash-subtitulo">Portfolios Recebidos</h2>
                <div class="dash-info">
                    <p><?php echo "<div style ='font:4rem Arial,tahoma,sans-serif;color:#008080;margin-top:0.6rem'> 1 </div>"; ?></p>
                </div>
            </div>
            <div class="dash-caixas">
                <h2 class="dash-subtitulo">Contratados</h2>
                <div class="dash-info">
                    <p><p><?php echo "<div style ='font:4rem Arial,tahoma,sans-serif;color:#008080;margin-top:0.6rem'> 2 </div>"; ?></p></p>
                </div>
            </div>
        </div>
        <div class="dash-meio">
            <div class="dash-graf-vagas">
                <div id="chart_div_vagas"></div>
            </div>
            <div class="dash-graf-modali">
                <div id="chart_div_mod"></div>
            </div>
        </div>
        <div class="tabela">
            <table class="table table-bordered table-style">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="dash-botoes">
            <a href="relatorios/pdfVagasFechadas.php" class="btn btn-primary" target="blank"> Relatório Vagas
                Fechadas</a>
            <a href="relatorios/pdfVagasAbertas.php" class="btn btn-primary" target="blank"> Relatório Vagas Abertas</a>
        </div>
    </div>
</body>

</html>