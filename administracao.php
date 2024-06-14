<?php
include './conn.php';
$classe = isset($_GET["classe"]) ? $_GET["classe"] : "";

session_start();

if (!isset($_SESSION['usuario'])) {
    $_SESSION['msg'] = "É necessário logar antes de acessar.";
    header("Location: login.php");
    exit;
}

$cargo_permitido = [0];
if (!in_array($_SESSION['cargo'], $cargo_permitido)) {
    $_SESSION['msg'] = "Você não tem permissão para acessar esta área.";
    header("Location: login.php");
    exit;
}

$sql_areaat = "SELECT COUNT(*) AS total FROM areaat";
$stmt = $conn->prepare($sql_areaat);

if ($stmt === false) {
    echo "Erro na preparação da consulta: " . htmlspecialchars($conn->error) . "<br>";
    exit;
}

$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$areaat_count = $row['total'] ?? 0;

$sql_empresa = "SELECT COUNT(*) AS total FROM empresa";
$stmt = $conn->prepare($sql_empresa);

if ($stmt === false) {
    echo "Erro na preparação da consulta: " . htmlspecialchars($conn->error) . "<br>";
    exit;
}

$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$empresa_count = $row['total'] ?? 0;

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Área do Administrador</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="javascript/javascript<?php echo $classe; ?>.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="javascript/javascriptChart.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sbstyle.css">
</head>

<body class="v-body">
    <?php include 'sidebar.php';
    if (!empty($classe)) { ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Cadastro de <?php echo $classe; ?></h2>
                    </div>
                    <div class="pull-right">
                        <?php if ($classe != "Empresa") { ?>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
                                Criar <?php echo $classe; ?>
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-style">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>

            <ul id="pagination" class="pagination-sm"></ul>

            <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Criar <?php echo $classe; ?></h4>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" action="insert/insert<?php echo $classe; ?>.php" method="POST">

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar <?php echo $classe; ?></h4>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" action="update/update<?php echo $classe; ?>.php" method="POST">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="view-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Visualizar <?php echo $classe; ?></h4>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" action="select<?php echo $classe; ?>.php" method="POST">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="v-principal">
            <h1>Dashboard</h1>
            <div class="dash-top">
                <div class="dash-caixas">
                    <h2 class="dash-subtitulo">Áreas de Atuação</h2>
                    <div class="dash-info">
                        <p><?php echo "<div style ='font:4rem Arial,tahoma,sans-serif;color:#008080'>$areaat_count</div>"; ?>
                        </p>
                    </div>
                </div>
                <div class="dash-caixas">
                    <h2 class="dash-subtitulo">Empresas</h2>
                    <div class="dash-info">
                        <p><?php echo "<div style ='font:4rem Arial,tahoma,sans-serif;color:#008080'>$empresa_count</div>"; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="dash-meio">
                <div class="dash-graf-areaat">
                    <div id="chart_div_areaat"></div>
                    <div id="png_areaat"></div>
                </div>
                <div class="dash-graf-local">
                    <div id="chart_div_local"></div>
                    <div id="png_local"></div>
                </div>
                <div class="dash-graf-cad-emp">
                    <div id="chart_div_coluna"></div>
                    <div id="png_coluna"></div>
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
                <a href="relatorios/pdfCadEmp.php" class="btn btn-primary" target="blank"> Relatório CadEmp</a>
            </div>
        </div>
    <?php } ?>
</body>

</html>