<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
            <form id="cadastroForm" onsubmit="return comparaSenha()" action="insert/insertEmpresa.php" method="post">
                <div class="parte1">
                    <div class="campo">
                        <label for="email">E-mail de Login:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="campo">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    <div class="campo">
                        <label for="confirmarSenha">Confirme a Senha:</label>
                        <input type="password" id="confirmarSenha" name="confirmarSenha" required>
                        <span class="senhadiferente"></span>
                    </div>
                    <input type="button" class="visible_submit" id="visible_submit" onclick="prox()" value="Próximo"
                        disabled>
                </div>
                <div class="parte2" style="display:none;">
                    <div class="campo">
                        <label for="nome_emp">Nome da Empresa:</label>
                        <input type="text" id="nome_emp" name="nome_emp" required>
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
                        <textarea id="desc_emp" name="desc_emp" required></textarea>
                    </div>
                    <div class="campo">
                        <label for="email_emp">E-mail de contato:</label>
                        <input type="email" id="email_emp" name="email_emp" required>
                    </div>
                    <div class="campo">
                        <label for="site_emp">Site:</label>
                        <input type="text" id="site_emp" name="site_emp" required>
                    </div>
                    <div class="campo">
                        <label for="tel_emp">Telefone:</label>
                        <input type="text" id="tel_emp" name="tel_emp" required>
                    </div>
                    <div class="campo">
                        <label for="cnpj_emp">CNPJ</label>
                        <input type="text" id="cnpj_emp" name="cnpj_emp" required>
                    </div>
                    <input type="submit" class="btCadastrar" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            getLocalSelect();
            getAreaAtuacaoSelect();

            function getLocalSelect() {
                $.ajax({
                    dataType: 'json',
                    url: './get/getLocaltrabalho.php',
                    data: {}
                }).done(function (data) {

                    var htmlSelect = '';
                    $.each(data.data, function (key, value) {
                        htmlSelect = htmlSelect + '<option value="' + value.cod_local + '"> ' + value.cidade_local + '</option>';
                    });
                    $("#cod_local").html(htmlSelect);
                });
            }

            function getAreaAtuacaoSelect() {

                $.ajax({
                    dataType: 'json',
                    url: 'get/getAreaat.php',
                    data: {}
                }).done(function (data) {

                    var htmlSelect = '';
                    $.each(data.data, function (key, value) {
                        htmlSelect = htmlSelect + '<option value="' + value.cod_area + '"> ' + value.desc_area + '</option>';
                    });
                    $("#areaat_emp").html(htmlSelect);
                });
            }
        });
        function prox() {
            const emailz = document.getElementById('email');

            var camposPreenchidos = true;
            document.querySelectorAll('.parte1 input').forEach(function (input) {
                if (input.value === '' || !emailz.checkValidity()) {
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

        document.querySelector('.parte1').addEventListener('input', function () {
            var camposPreenchidos = true;
            document.querySelectorAll('.parte1 input').forEach(function (input) {
                if (input.value === '' || senha.value != confirmaSenha.value) {
                    camposPreenchidos = false;
                    return;
                }
            });

            document.getElementById('visible_submit').disabled = !camposPreenchidos;
        });

        let senha = document.getElementById('senha');
        let confirmaSenha = document.getElementById('confirmarSenha')
        let senhadiferente = document.querySelector('.senhadiferente')
        let form = document.getElementById('cadastroForm')

        function comparaSenha() {
            if (confirmaSenha.value) {
                if (senha.value != confirmaSenha.value) {
                    senhadiferente.style.display = 'block'
                    senhadiferente.style.color = 'red'
                    senhadiferente.innerHTML = 'As senhas não são iguais'
                    return false
                    e.preventDefault()
                } else {
                    senhadiferente.style.display = 'none'
                }
            }
        }

        confirmaSenha.addEventListener('keyup', () => {
            comparaSenha()
        })

        senha.addEventListener('keyup', () => {
            comparaSenha()
        })
    </script>
</body>

</html>
