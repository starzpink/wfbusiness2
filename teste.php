<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do RH</title>
    <meta name="description" content="Gerencie sua empresa no Workfolio For Business">
    <link rel="stylesheet" type="text/css" href="css/perfil.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="v-body">
    <nav class="nav-sidebar">
    </nav>
    <div class="v-principal">
        <h1>Perfil do RH</h1>
        <div class="campos-container">
            <div class="campo">
                <label>Email do Usuário:</label>
                <p><?php echo htmlspecialchars($rh['email']); ?></p>
            </div>
            <div class="campo">
                <label>Nome:</label>
                <p><?php echo htmlspecialchars($rh['nome_rh']); ?></p>
            </div>
            <div class="campo">
                <label>CPF:</label>
                <p><?php echo htmlspecialchars($rh['cpf_rh']); ?></p>
            </div>
            <div class="campo">
                <label>E-mail:</label>
                <p><?php echo htmlspecialchars($rh['email_rh']); ?></p>
            </div>
            <div class="campo">
                <label>Telefone:</label>
                <p><?php echo htmlspecialchars($rh['tel_rh']); ?></p>
            </div>
            <div class="dash-botoes">
                <a href="editarrh.php?cod_usuario=<?php echo $cod_usuario; ?>" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</body>

</html>