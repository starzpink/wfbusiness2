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