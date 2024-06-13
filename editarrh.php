<?php
session_start();
include './conn.php';

if (!isset($_SESSION['cod_usuario'])) {
    echo "ID do usuário não fornecido.";
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

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar rh</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <script defer src="script.js"></script>
</head>

<body>
    <nav class="navbar">
        <a href="index.php">
            <span class="logo">Workfolio for Business</span>
        </a>
    </nav>
    <div class="container">
        <h1>Editar RH</h1>
        <div class="formContainer">
            <form id="cadastroForm" action="update/updaterh.php" method="post">
                <div class="parte1">
                    <div class="campo">
                        <label for="email">E-mail de Login:</label>
                        <input type="email" id="email" name="email"
                            value="<?php echo htmlspecialchars($rh['email']); ?>" required><br>
                    </div>
                    <div class="campo">
                        <label for="senha">Nova Senha:</label>
                        <input type="password" id="senha" name="senha"><br>
                    </div>
                    <div class="campo">
                        <label for="confirmaSenha">Confirme a Nova Senha:</label>
                        <input type="password" id="confirmaSenha" name="confirmaSenha"><br>
                    </div>
                    <input type="button" class="visible_submit" id="visible_submit" onclick="prox()" value="Próximo">
                </div>
                <div class="parte2" style="display:none;">
                    <div class="campo">
                        <label for="nome_emp">Nome:</label>
                        <input type="text" id="nome_rh" name="nome_rh"
                            value="<?php echo htmlspecialchars($rh['nome_rh']); ?>" required><br>
                    </div>
                    <div class="campo">
                        <label for="cpf_rh">CPF:</label>
                        <input type="text" id="cpf_rh" name="cpf_rh"
                            value="<?php echo htmlspecialchars($rh['cpf_rh']); ?>" required><br>
                    </div>
                    <div class="campo">
                        <label for="email_rh">E-mail de contato:</label>
                        <input type="text" id="email_rh" name="email_rh"
                            value="<?php echo htmlspecialchars($rh['email_rh']); ?>" required><br>
                    </div>
                    <div class="campo">
                        <label for="tel_rh">Telefone:</label>
                        <input type="text" id="tel_rh" name="tel_rh"
                            value="<?php echo htmlspecialchars($rh['tel_rh']); ?>" required><br>
                    </div>
                    <input type="hidden" name="cod_usuario" value="<?php echo $cod_usuario; ?>">
                    <input type="submit" class="btCadastrar" value="Atualizar">
                </div>
            </form>
        </div>
    </div>
    <script>
        function prox() {
            var camposPreenchidos = true;
            document.querySelectorAll('.parte1 input').forEach(function (input) {
                if (input.value === '') {
                    camposPreenchidos = false;
                    return;
                }
            });

            if (camposPreenchidos) {
                document.querySelector('.parte2').style.display = 'block';
                document.querySelector('.parte1').style.display = 'none';
            } else {
                alert('Preencha todos os campos corretamente antes de prosseguir.');
            }
        }
    </script>
</body>

</html>