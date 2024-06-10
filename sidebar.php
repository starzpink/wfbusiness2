<?php
include './conn.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cargo = $_SESSION['cargo'];
$cod_usuario = $_SESSION['cod_usuario'];

$nome_emp = '';
$nome_rh = '';

$QueryEmp = "SELECT nome_emp FROM empresa WHERE cod_usuario = " . $cod_usuario;
$QueryRh = "SELECT nome_rh FROM rh WHERE cod_usuario = " . $cod_usuario;

$companyResult = $conn->query($QueryEmp);
if ($companyResult->num_rows > 0) {
    $row_emp = $companyResult->fetch_assoc();
    $nome_emp = $row_emp['nome_emp'];
}

$rhResult = $conn->query($QueryRh);
if ($rhResult->num_rows > 0) {
    $row_rh = $rhResult->fetch_assoc();
    $nome_rh = $row_rh['nome_rh'];
}


if ($cargo == 1) {
    ?>
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
                <a href="dashboard.php">
                    <li class="sb-opcao">
                        <i class="bx bxs-dashboard"></i>
                        <span>Dashboard</span>
                    </li>
                </a>
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
                <a href="perfilempresa.php">
                    <li class="sb-opcao">
                        <i class="bx bx-building"></i>
                        <span>Empresa</span>
                    </li>
                </a>
                <a href="dashboard_emp.php">
                    <li class="sb-opcao">
                        <i class="bx bxs-dashboard"></i>
                        <span>Dashboard</span>
                    </li>
                </a>
                <a>
                    <li class="sb-opcao">
                        <a href= "rh.php">
                            <i class="bx bx-group"></i>
                            <span>Equipe RH</span>
                    </li>
                </a>
                <a href="vagas.php">
                    <li class="sb-opcao">
                        <i class="bx bx-notepad"></i>
                        <span>Vagas</span>
                    </li>
                </a>
                <a href="logout.php">
                    <li class="sb-opcao">
                        <i class="bx bx-log-out"></i>
                        <span>Sair</span>
                    </li>
                </a>
            </ul>
        </div>
    </nav>
<?php } ?>