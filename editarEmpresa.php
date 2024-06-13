<?php
session_start();
include '../conn.php';

if (!isset($_SESSION['cod_usuario'])) {
    echo "ID do usuário não fornecido.";
    exit;
}

$cod_usuario = intval($_SESSION['cod_usuario']);

$sql = "SELECT e.nome_emp, e.cod_local, e.areaat_emp, e.desc_emp, e.email_emp, e.site_emp, e.tel_emp, e.cnpj_emp, u.email
        FROM empresa e
        JOIN usuario u ON e.cod_usuario = u.cod_usuario
        WHERE e.cod_usuario = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "Erro na preparação da consulta: " . htmlspecialchars($conn->error) . "";
    exit;
}

$stmt->bind_param("i", $cod_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $empresa = $result->fetch_assoc();
    $cod_local = $empresa['cod_local']; // Save the cod_local value
    $areaat_emp = $empresa['areaat_emp'];
} else {
    echo "Empresa não encontrada.";
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
    <title>Editar Empresa</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            getLocalSelect();
            getAreaAtuacaoSelect();

            function getLocalSelect() {
                $.ajax({
                    dataType: 'json',
                    url: 'get/getLocaltrabalho.php',
                    data: {}
                }).done(function (data) {
                    var htmlSelect = '';
                    var currentCodLocal = <?php echo json_encode($cod_local); ?>;
                    $.each(data.data, function (key, value) {
                        var selected = value.cod_local == currentCodLocal ? 'selected' : '';
                        htmlSelect += '<option value="' + value.cod_local + '" ' + selected + '>' + value.cidade_local + '</option>';
                    });
                    $("#cod_local").html(htmlSelect);
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.log("Request failed: " + textStatus + ", " + errorThrown);
                });
            }

            function getAreaAtuacaoSelect() {
                $.ajax({
                    dataType: 'json',
                    url: 'get/getAreaat.php',
                    data: {}
                }).done(function (data) {
                    var htmlSelect = '';
                    var currentAreaAtuacao = <?php echo json_encode($areaat_emp); ?>;
                    $.each(data.data, function (key, value) {
                        var selected = value.cod_area == currentAreaAtuacao ? 'selected' : '';
                        htmlSelect += '<option value="' + value.cod_area + '" ' + selected + '>' + value.desc_area + '</option>';
                    });
                    $("#areaat_emp").html(htmlSelect);
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.log("Request failed: " + textStatus + ", " + errorThrown);
                });
            }

            function showToast(message) {
                var toast = document.getElementById("toast");
                toast.className = "show";
                toast.innerHTML = message;
                setTimeout(function () {
                    toast.className = toast.className.replace("show", "");
                }, 3000);
            }

            function handleFormSubmit(event) {
                event.preventDefault();

                var form = document.getElementById('cadastroForm');
                var formData = new FormData(form);

                fetch('update/updateEmpresa.php', {
                    method: 'POST',
                    body: formData
                }).then(response => response.text())
                    .then(responseText => {
                        if (responseText.trim() === 'Sucesso') {
                            showToast('Atualização bem-sucedida!');
                        } else {
                            showToast('Falha na atualização. Tente novamente.');
                        }
                    }).catch(error => {
                        showToast('Erro no envio. Tente novamente.');
                    });
            }

            document.getElementById('cadastroForm').addEventListener('submit', handleFormSubmit);
        });

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
</head>

<body>
    <nav class="navbar">
        <a href="index.php">
            <span class="logo">Workfolio for Business</span>
        </a>
    </nav>
    <div class="container">
        <h1>Editar Empresa</h1>
        <div class="formContainer">
            <form id="cadastroForm" method="post">
                <div class="parte1">
                    <div class="campo">
                        <label for="email">E-mail de Login:</label>
                        <input type="email" id="email" name="email"
                            value="<?php echo htmlspecialchars($empresa['email']); ?>" required>
                    </div>
                    <div class="campo">
                        <label for="senha">Nova Senha:</label>
                        <input type="password" id="senha" name="senha">
                    </div>
                    <div class="campo">
                        <label for="confirmaSenha">Confirme a Nova Senha:</label>
                        <input type="password" id="confirmaSenha" name="confirmaSenha">
                    </div>
                    <input type="button" class="visible_submit" id="visible_submit" onclick="prox()" value="Próximo">
                </div>
                <div class="parte2" style="display:none;">
                    <div class="campo">
                        <label for="nome_emp">Nome da Empresa:</label>
                        <input type="text" id="nome_emp" name="nome_emp"
                            value="<?php echo htmlspecialchars($empresa['nome_emp']); ?>" required>
                    </div>
                    <div class="campo">
                        <label for="cod_local">Local:</label>
                        <select id="cod_local" name="cod_local" required></select>
                    </div>
                    <div class="campo">
                        <label for="areaat_emp">Área de Atuação:</label>
                        <select id="areaat_emp" name="areaat_emp" required></select>
                    </div>
                    <div class="campo">
                        <label for="desc_emp">Descrição:</label>
                        <textarea id="desc_emp" name="desc_emp"
                            required><?php echo htmlspecialchars($empresa['desc_emp']); ?></textarea>
                    </div>
                    <div class="campo">
                        <label for="email_emp">E-mail de contato:</label>
                        <input type="email" id="email_emp" name="email_emp"
                            value="<?php echo htmlspecialchars($empresa['email_emp']); ?>" required>
                    </div>
                    <div class="campo">
                        <label for="site_emp">Site:</label>
                        <input type="text" id="site_emp" name="site_emp"
                            value="<?php echo htmlspecialchars($empresa['site_emp']); ?>" required>
                    </div>
                    <div class="campo">
                        <label for="tel_emp">Telefone:</label>
                        <input type="text" id="tel_emp" name="tel_emp"
                            value="<?php echo htmlspecialchars($empresa['tel_emp']); ?>" required>
                    </div>
                    <div class="campo">
                        <label for="cnpj_emp">CNPJ</label>
                        <input type="text" id="cnpj_emp" name="cnpj_emp"
                            value="<?php echo htmlspecialchars($empresa['cnpj_emp']); ?>" required>
                    </div>
                    <input type="hidden" name="cod_usuario" value="<?php echo $cod_usuario; ?>">
                    <div id="toast" class="toast"></div>
                    <input type="submit" class="btCadastrar" onclick="funcoes()" value="Atualizar">
                </div>
            </form>
        </div>
    </div>
</body>

</html>