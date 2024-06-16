<?php
include './conn.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    $_SESSION['msg'] = "É necessário logar antes de acessar.";
    header("Location: login.php");
    exit;
}

$cargo_permitido = [1,2];
if (!in_array($_SESSION['cargo'], $cargo_permitido)) {
    $_SESSION['msg'] = "Você não tem permissão para acessar esta área.";
    header("Location: login.php");
    exit;
}

if ($cargo = $_SESSION['cargo'] == 1) {
    $cod_emp = intval($_SESSION['cod_emp']);
    $sql = "SELECT e.nome_emp, e.cod_local, e.areaat_emp, e.desc_emp, e.email_emp, e.site_emp, e.tel_emp, e.cnpj_emp
        FROM empresa e
        JOIN rh ON e.cod_emp = rh.cod_emp
        WHERE e.cod_emp = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Erro na preparação da consulta: " . htmlspecialchars($conn->error) . "<br>";
        exit;
    }

    $stmt->bind_param("i", $cod_emp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $empresa = $result->fetch_assoc();
    } else {
        echo "Empresa não encontrada.";
        exit;
    }

    $stmt->close();
    $conn->close();

} else {
    $cod_usuario = intval($_SESSION['cod_usuario']);
    $sql = "SELECT e.nome_emp, e.cod_local, e.areaat_emp, e.desc_emp, e.email_emp, e.site_emp, e.tel_emp, e.cnpj_emp, u.email
        FROM empresa e
        JOIN usuario u ON e.cod_usuario = u.cod_usuario
        WHERE e.cod_usuario = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Erro na preparação da consulta: " . htmlspecialchars($conn->error) . "<br>";
        exit;
    }

    $stmt->bind_param("i", $cod_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $empresa = $result->fetch_assoc();
    } else {
        echo "Empresa não encontrada.";
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil da empresa</title>
    <meta name="description" content="Gerencie sua empresa no Workfolio For Business">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sbstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="v-body">
    <nav class="nav-sidebar">
        <?php include 'sidebar.php'; ?>
    </nav>
    <div class="v-principal">
        <h1>Perfil da Empresa</h1>
        <?php if ($cargo = $_SESSION['cargo'] != 1) { ?>
            <div class="parte1">
                <div class="campo">
                    <p><strong>Email do Usuário:</strong> <?php echo htmlspecialchars($empresa['email']); ?></p>
                </div>
            </div>
        <?php } ?>
        <div class="parte2">
            <div class="campo">
                <p><strong>Nome:</strong> <?php echo htmlspecialchars($empresa['nome_emp']); ?></p>
            </div>
            <div class="campo">
                <p><strong>Local:</strong> <?php echo htmlspecialchars($empresa['cod_local']); ?></p>
            </div>
            <div class="campo">
                <p><strong>Área:</strong> <?php echo htmlspecialchars($empresa['areaat_emp']); ?></p>
            </div>
            <div class="campo">
                <p><strong>Descrição:</strong> <?php echo htmlspecialchars($empresa['desc_emp']); ?></p>
            </div>
            <div class="campo">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($empresa['email_emp']); ?></p>
            </div>
            <div class="campo">
                <p><strong>Site:</strong> <?php echo htmlspecialchars($empresa['site_emp']); ?></p>
            </div>
            <div class="campo">
                <p><strong>Telefone:</strong> <?php echo htmlspecialchars($empresa['tel_emp']); ?></p>
            </div>
            <div class="campo">
                <p><strong>CNPJ:</strong> <?php echo htmlspecialchars($empresa['cnpj_emp']); ?></p>
            </div>
        </div>
        <?php if ($cargo = $_SESSION['cargo'] != 1) { ?>
            <div class="dash-botoes">
                <a href="editarEmpresa.php?cod_usuario=<?php echo $cod_usuario; ?>" class="btn btn-primary">Editar</a>
            </div>
        <?php } ?>
    </div>
</body>

</html>