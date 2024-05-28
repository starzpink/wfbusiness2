<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="sbstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Vagas</title>
</head>
<body class="v-body">
        <nav class="nav-sidebar">
            <?php include 'sidebar.php'; ?>
        </nav>
        <div class="v-principal">
            <div class="v-botao-nova">
                <a href="coco.php">
                    <i class="bx bx-plus bx-sm"></i>
                    <p>Nova vaga</p>
                </a>
            </div>
            <div class="v-card-container">
                <div class="v-card">
                    <div class="v-card-header">
                        <p class="v-card-id">ID: 12345</p>
                        <h2 class="v-card-titulo">Nome da vaga</h2>
                        <p class="v-card-local">Local</p>
                    </div>
                    <p class="v-card-status">ABERTA</p>
                    <div class="v-card-botao">
                        <a href="mamae.php">
                            <p>Visualizar</p>
                        </a>
                    </div>
                </div>
                <div class="v-card">
                    <div class="v-card-header">
                        <p class="v-card-id">ID: 12345</p>
                        <h2 class="v-card-titulo">Nome da vaga</h2>
                        <p class="v-card-local">Local</p>
                    </div>
                    <p class="v-card-status">ABERTA</p>
                    <div class="v-card-botao">
                        <a>
                            <p>Visualizar</p>
                        </a>
                    </div>
                </div>
                <div class="v-card">
                    <div class="v-card-header">
                        <p class="v-card-id">ID: 12345</p>
                        <h2 class="v-card-titulo">Nome da vaga</h2>
                        <p class="v-card-local">Local</p>
                    </div>
                    <p class="v-card-status">ABERTA</p>
                    <div class="v-card-botao">
                        <a>
                            <p>Visualizar</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>