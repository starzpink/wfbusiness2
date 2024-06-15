<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="script.js"></script>
</head>

<body>
    <nav class="navbar">
        <a href="index.php">
            <span class="logo">Workfolio for Business</span>
        </a>
    </nav>
    <div class="container">
        <h1>Cadastre-se</h1>
        <div class="formContainer">
            <form id="cadastroForm" action="insert/insertRh.php" method="post">
                <div class="parte1">
                    <div class="campo">
                        <label for="email">E-mail de Login:</label>
                        <input type="email" id="email" name="email" required><br>
                    </div>
                    <div class="campo">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required><br>
                    </div>
                    <div class="campo">
                        <label for="confirmaSenha">Confirme a Senha:</label>
                        <input type="password" id="confirmaSenha" name="confirmaSenha" required><br>
                    </div>
                    <input type="button" class="visible_submit" id="visible_submit" onclick="prox()" value="Próximo">
                </div>
                <div class="parte2" style="display:none;">
                    <div class="campo">
                        <label for="nome_rh">Nome:</label>
                        <input type="text" id="nome_rh" name="nome_rh" required><br>
                    </div>
                    <div class="campo">
                        <label for="cpf_rh">CPF:</label>
                        <input type="text" id="cpf_rh" name="cpf_rh" required><br>
                    </div>
                    <div class="campo">
                        <label for="email_rh">E-mail:</label>
                        <input type="email" id="email_rh" name="email_rh" required><br>
                    </div>
                    <div class="campo">
                        <label for="tel_rh">Telefone:</label>
                        <input type="text" id="tel_rh" name="tel_rh" required><br>
                    </div>
                    <div id="toast"></div>
                    <input type="submit" class="btCadastrar" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
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

                fetch('insert/insertRh.php', {
                    method: 'POST',
                    body: formData
                }).then(response => response.text())
                    .then(responseText => {
                        showToast(responseText);
                        console.log(responseText);  // Log para inspecionar a resposta

                        if (responseText.trim() === 'Sucesso') {
                            setTimeout(function () {
                                window.location.href = 'rh.php'; // Redireciona após 3 segundos
                            }, 3000);
                        }
                    }).catch(error => {
                        showToast('Erro no envio. Tente novamente.');
                        console.error(error);  // Log para inspecionar erros
                    });
            }

            document.getElementById('cadastroForm').addEventListener('submit', handleFormSubmit);

            function checkPart1Fields() {
                let allFilled = true;
                $('.parte1 input').each(function () {
                    if ($(this).val() === '') {
                        allFilled = false;
                        return false;
                    }
                });
                return allFilled;
            }

            $('.parte1 input').on('input', function () {
                if (checkPart1Fields()) {
                    $('#visible_submit').removeAttr('disabled');
                } else {
                    $('#visible_submit').attr('disabled', 'disabled');
                }
            });

            window.prox = function () {
                if (checkPart1Fields()) {
                    var senha = $('#senha').val();
                    var confirmaSenha = $('#confirmaSenha').val();

                    if (senha !== confirmaSenha) {
                        alert('As senhas não coincidem.');
                        return;
                    }

                    $('.parte2').show();
                    $('.parte1').hide();
                } else {
                    alert('Preencha todos os campos corretamente antes de prosseguir.');
                }
            }
        });
    </script>
</body>

</html>