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