<?php
include './conn.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cargo = $_SESSION['cargo'];
$cod_usuario = $_SESSION['cod_usuario'];
if ($cargo === '1' || $cargo === '2') {
    $cod_emp = $_SESSION['cod_emp'];
}

$nome_emp = '';
$nome_rh = '';

if ($cargo == 1) {
    $QueryEmp = "SELECT e.nome_emp, r.nome_rh 
                 FROM empresa e 
                 INNER JOIN rh r ON e.cod_emp = r.cod_emp 
                 WHERE r.cod_usuario = ?";
    $stmt = $conn->prepare($QueryEmp);
    $stmt->bind_param("i", $cod_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_emp = $row['nome_emp'];
        $nome_rh = $row['nome_rh'];
    }
} elseif ($cargo == 2) {
    $QueryEmp = "SELECT nome_emp FROM empresa WHERE cod_usuario = ?";
    $stmt = $conn->prepare($QueryEmp);
    $stmt->bind_param("i", $cod_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_emp = $row['nome_emp'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
</head>

<body>
    <?php if ($cargo == 0) { ?>
        <nav class="sidebar">
            <header>
                <div class="sb-header">
                    <span class="sb-nome"><?php //echo htmlspecialchars($nome_adm); ?></span>
                </div>
            </header>
            <div class="sb-menu">
                <ul class="sb-menu-opcoes">
                    <li class="sb-opcao">
                        <a href="administracao.php">
                            <i class="bx bx-user"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <a href="administracao.php?classe=Areaat">
                        <li class="sb-opcao">
                            <i class="bx bxs-dashboard"></i>
                            <span>Área de Atuação</span>
                        </li>
                    </a>
                    <li class="sb-opcao">
                        <a href="administracao.php?classe=Empresa">
                            <i class="bx bx-notepad"></i>
                            <span>Empresas</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="administracao.php?classe=Localtrabalho">
                            <i class="bx bx-log-out"></i>
                            <span>Locais de trabalho</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="administracao.php?classe=Modalidade">
                            <i class="bx bx-log-out"></i>
                            <span>Modalidades</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="administracao.php?classe=Tipovaga">
                            <i class="bx bx-log-out"></i>
                            <span>Tipos de Vagas</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="logout.php">
                            <i class="bx bx-log-out"></i>
                            <span>Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php } elseif ($cargo == 1) { ?>
        <nav class="sidebar">
            <header>
                <div class="sb-header">
                    <span class="sb-nome"><?php echo htmlspecialchars($nome_emp); ?></span>
                    <span class="sb-nomerh"><?php echo htmlspecialchars($nome_rh); ?></span>
                </div>
            </header>
            <div class="sb-menu">
                <ul class="sb-menu-opcoes">
                    <li class="sb-opcao">
                        <a href="perfilrh.php">
                            <i class="bx bx-user"></i>
                            <span>Perfil</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="dashboard.php">
                            <i class="bx bxs-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="perfilempresa.php">
                            <i class="bx bx-building"></i>
                            <span>Empresa</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="vagas.php">
                            <i class="bx bx-notepad"></i>
                            <span>Vagas</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="logout.php">
                            <i class="bx bx-log-out"></i>
                            <span>Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php } elseif ($cargo == 2) { ?>
        <nav class="sidebar">
            <header>
                <div class="sb-header">
                    <span class="sb-nome"><?php echo htmlspecialchars($nome_emp); ?></span>
                </div>
            </header>
            <div class="sb-menu">
                <ul class="sb-menu-opcoes">
                    <li class="sb-opcao">
                        <a href="perfilempresa.php">
                            <i class="bx bx-building"></i>
                            <span>Empresa</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="dashboard.php">
                            <i class="bx bxs-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="rh.php">
                            <i class="bx bx-group"></i>
                            <span>Equipe RH</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="vagas.php">
                            <i class="bx bx-notepad"></i>
                            <span>Vagas</span>
                        </a>
                    </li>
                    <li class="sb-opcao">
                        <a href="logout.php">
                            <i class="bx bx-log-out"></i>
                            <span>Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php } ?>





</body>


</html>