$(document).ready(function () {
    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;
    var types = new Map();
    var dataCon;
    createHeadTable();
    createForm();
    createEditForm();
    createViewForm();
    manageData();

    function manageData() {

        $.ajax({
            dataType: 'json',
            url: 'get/getRh.php',
            data: {page: page}
        }).done(function (data) {
            total_page = Math.ceil(data.total / 10);
            current_page = page;
            $('#pagination').twbsPagination({
                totalPages: total_page,
                visiblePages: current_page,
                onPageClick: function (event, pageL) {
                    page = pageL;
                    if (is_ajax_fire != 0) {
                        getPageData();
                    }
                }
            });

            manageRow(data.data);
            is_ajax_fire = 1;
        });
    }

    function getPageData() {
        $.ajax({
            dataType: 'json',
            url: 'getRh.php',

            data: {page: page}
        }).done(function (data) {
            manageRow(data.data);
        });
    }

    function manageRow(data) {

        dataCon = data;
        var rows = '';
        var i = 0;
        $.each(data, function (key, value) {
            rows = rows + '<tr>';
            rows = rows + '<td>' + value.cod_rh + '</td>';
            rows = rows + '<td>' + value.nome_rh + '</td>';
            rows = rows + '<td data-id="' + i++ + '">';
            rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Editar</button> ';
            rows = rows + '<button data-toggle="modal" data-target="#view-item" class="btn btn-primary view-item">Visualizar</button> ';
            rows = rows + '</td>';
            rows = rows + '</tr>';
        });

        $("tbody").html(rows);
    }
    function createHeadTable() {

        var rows = '<tr>';
        rows = rows + '<th> Código </th>';
        rows = rows + '<th> Nome </th>';
        rows = rows + '<th width="200px">Ação</th>'
        rows = rows + '</tr>'
        $("thead").html(rows);
    }
    function createForm() {

        var html = '';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="nome_rh">Nome</label>';
        html = html + '<input type="text" name="nome_rh" class="form-control" data-error="Por favor, insira o nome." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cpf_rh">CPF</label>';
        html = html + '<input type="text" name="cpf_rh" class="form-control" data-error="Por favor, insira o CPF." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="email_rh">E-mail</label>';
        html = html + '<input type="text" name="email_rh" class="form-control" data-error="Por favor, insira o e-mail." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="tel_rh">Telefone</label>';
        html = html + '<input type="text" name="tel_rh" class="form-control" data-error="Por favor, insira o telefone." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit btn-success">Cadastrar</button>';
        html = html + '</div>';
        $("#create-item").find("form").html(html);
    }
    function createEditForm() {

        var html = '<input type="hidden" name="cod" class="edit-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="nome_rh">Nome</label>';
        html = html + '<input type="text" name="nome_rh" class="form-control" data-error="Por favor, insira o nome." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cpf_rh">CPF</label>';
        html = html + '<input type="text" name="cpf_rh" class="form-control" data-error="Por favor, insira o CPF." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="email_rh">E-mail</label>';
        html = html + '<input type="text" name="email_rh" class="form-control" data-error="Por favor, insira o e-mail." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="tel_rh">Telefone</label>';
        html = html + '<input type="text" name="tel_rh" class="form-control" data-error="Por favor, insira o telefone." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit-edit btn-success">Salvar</button>';
        html = html + '</div>';
        $("#edit-item").find("form").html(html);

    }

    function createViewForm() {

        var html = '<input type="hidden" name="cod" class="view-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="nome_rh">Nome</label>';
        html = html + '<input type="text" name="nome_rh" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cpf_rh">CPF</label>';
        html = html + '<input type="text" name="cpf_rh" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="email_rh">E-mail</label>';
        html = html + '<input type="text" name="email_rh" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="tel_rh">Telefone</label>';
        html = html + '<input type="text" name="tel_rh" class="form-control" readonly/>';
        html = html + '</div>';
        $("#view-item").find("form").html(html);

    }

    $(".crud-submit").click(function (e) {
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var nome_rh = $("#create-item").find("input[name='nome_rh']").val();
        var cpf_rh = $("#create-item").find("input[name='cpf_rh']").val();
        var email_rh  = $("#create-item").find("input[name='email_rh']").val();
        var tel_rh  = $("#create-item").find("input[name='tel_rh']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: {nome_rh: nome_rh, cpf_rh: cpf_rh, email_rh: email_rh, tel_rh: tel_rh}
        }).done(function (data) {

            $("#create-item").find("input[name='nome_rh']").val('');
            $("#create-item").find("input[name='cpf_rh']").val('');
            $("#create-item").find("input[name='email_rh']").val('');
            $("#create-item").find("input[name='tel_rh']").val('');
            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', {timeOut: 5000});

        });

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: {nome_rh: nome_rh, cpf_rh: cpf_rh, email_rh: email_rh, tel_rh: tel_rh}
        }).done(function (data) {

            $("#create-item").find("input[name='nome_rh']").val('');
            $("#create-item").find("input[name='cpf_rh']").val('');
            $("#create-item").find("input[name='email_rh']").val('');
            $("#create-item").find("input[name='tel_rh']").val('');
            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', {timeOut: 5000});

        });

    });
    $("body").on("click", ".edit-item", function () {
        var index = $(this).parent("td").data('id');

        var nome_rh = dataCon[index].nome_rh;
        var cpf_rh = dataCon[index].cpf_rh;
        var email_rh = dataCon[index].email_rh;
        var tel_rh  = dataCon[index].tel_rh;

        $("#edit-item").find("input[name='nome_rh']").val(nome_rh);
        $("#edit-item").find("input[name='cpf_rh']").val(cpf_rh);
        $("#edit-item").find("input[name='email_rh']").val(email_rh);
        $("#edit-item").find("input[name='tel_rh']").val(tel_rh);

    });

    $("body").on("click", ".view-item", function () {
        var index = $(this).parent("td").data('id');

        var nome_rh = dataCon[index].nome_rh;
        var cpf_rh = dataCon[index].cpf_rh;
        var email_rh = dataCon[index].email_rh;
        var tel_rh  = dataCon[index].tel_rh;

        $("#view-item").find("input[name='nome_rh']").val(nome_rh);
        $("#view-item").find("input[name='cpf_rh']").val(cpf_rh);
        $("#view-item").find("input[name='email_rh']").val(email_rh);
        $("#view-item").find("input[name='tel_rh']").val(tel_rh);
    });

    $(".crud-submit-edit").click(function (e) {

        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");

        var nome_rh = $("#edit-item").find("input[name='nome_rh']").val();
        var cpf_rh = $("#edit-item").find("input[name='cpf_rh']").val();
        var email_rh = $("#edit-item").find("input[name='email_rh']").val();
        var tel_rh  = $("#edit-item").find("input[name='tel_rh']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: {nome_rh: nome_rh, cpf_rh: cpf_rh, email_rh: email_rh, tel_rh: tel_rh}

        }).done(function (data) {

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', {timeOut: 5000});
        });


    });

});
