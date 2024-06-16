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