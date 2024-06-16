<?php
include './conn.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    $_SESSION['msg'] = "É necessário logar antes de acessar.";
    header("Location: login.php");
    exit;
}

$cargo_permitido = [1];
if (!in_array($_SESSION['cargo'], $cargo_permitido)) {
    $_SESSION['msg'] = "Você não tem permissão para acessar esta área.";
    header("Location: login.php");
    exit;
}

$cod_usuario = intval($_SESSION['cod_usuario']);

$sql = "SELECT rh.cod_emp, rh.nome_rh, rh.cpf_rh, rh.email_rh, rh.tel_rh, u.email
        FROM rh
        JOIN usuario u ON rh.cod_usuario = u.cod_usuario
        WHERE rh.cod_usuario = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "Erro na preparação da consulta: " . htmlspecialchars($conn->error) . "<br>";
    exit;
}

$stmt->bind_param("i", $cod_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $rh = $result->fetch_assoc();
} else {
    echo "RH não encontrado.";
    exit;
}

$stmt->close();
$conn->close();
?>
<html>
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
        <h1>Perfil do RH</h1>
        <div class="parte1">
            <div class="campo">
                <p><strong>Email do Usuário:</strong> <?php echo htmlspecialchars($rh['email']); ?></p>
            </div>
        </div>
        <div class="parte2">
            <div class="campo">
                <p><strong>Nome:</strong> <?php echo htmlspecialchars($rh['nome_rh']); ?></p>
            </div>
            <div class="campo">
                <p><strong>CPF:</strong> <?php echo htmlspecialchars($rh['cpf_rh']); ?></p>
            </div>
            <div class="campo">
                <p><strong>E-mail:</strong> <?php echo htmlspecialchars($rh['email_rh']); ?></p>
            </div>
            <div class="campo">
                <p><strong>Telefone:</strong> <?php echo htmlspecialchars($rh['tel_rh']); ?></p>
            </div>
            <div class="dash-botoes">
                <a href="editarrh.php?cod_usuario=<?php echo $cod_usuario; ?>" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</body>

</html>