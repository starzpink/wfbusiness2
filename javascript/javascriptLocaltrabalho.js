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
            url: 'get/getLocaltrabalho.php',
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
            url: 'getLocaltrabalho.php',

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
            rows = rows + '<td>' + value.cod_local + '</td>';
            rows = rows + '<td>' + value.cidade_local + '</td>';
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
        rows = rows + '<th> Local </th>';
        rows = rows + '<th width="200px">Ação</th>'
        rows = rows + '</tr>'
        $("thead").html(rows);
    }
    function createForm() {

        var html = '';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cep_local">CEP</label>';
        html = html + '<input type="text" name="cep_local" class="form-control" data-error="Por favor, insira o CEP." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<label class="control-label" for="cidade_local">Cidade</label>';
        html = html + '<input type="text" name="cidade_local" class="form-control" data-error="Por favor, insira a cidade." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<label class="control-label" for="estado_local">Estado</label>';
        html = html + '<input type="text" name="estado_local" class="form-control" data-error="Por favor, insira o estado." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit btn-success">Cadastrar</button>';
        html = html + '</div>';
        $("#create-item").find("form").html(html);
    }
    function createEditForm() {

        var html = '<input type="hidden" name="cod" class="edit-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_local">Código</label>';
        html = html + '<input type="text" name="cod_local" class="form-control" data-error="Por favor, insira o código." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<label class="control-label" for="cep_local">CEP</label>';
        html = html + '<input type="text" name="cep_local" class="form-control" data-error="Por favor, insira o CEP." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<label class="control-label" for="cidade_local">Cidade</label>';
        html = html + '<input type="text" name="cidade_local" class="form-control" data-error="Por favor, insira a cidade." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<label class="control-label" for="estado_local">Estado</label>';
        html = html + '<input type="text" name="estado_local" class="form-control" data-error="Por favor, insira o estado." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit-edit btn-success">Salvar</button>';
        html = html + '</div>';
        $("#edit-item").find("form").html(html);

    }

    function createViewForm() {

        var html = '<input type="hidden" name="cod" class="view-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_local">Código</label>';
        html = html + '<input type="text" name="cod_local" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cep_local">CEP</label>';
        html = html + '<input type="text" name="cep_local" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cidade_local">Cidade</label>';
        html = html + '<input type="text" name="cidade_local" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="estado_local">Estado</label>';
        html = html + '<input type="text" name="estado_local" class="form-control" readonly/>';
        html = html + '</div>';
        $("#view-item").find("form").html(html);

    }

    $(".crud-submit").click(function (e) {
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var cod_local = $("#create-item").find("input[name='cod_local']").val();
        var cep_local = $("#create-item").find("input[name='cep_local']").val();
        var cidade_local = $("#create-item").find("input[name='cidade_local']").val();
        var estado_local = $("#create-item").find("input[name='estado_local']").val();
        
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: {cod_local: cod_local, cep_local: cep_local, cidade_local: cidade_local, estado_local: estado_local}
        }).done(function (data) {

            $("#create-item").find("input[name='cod_local']").val('');
            $("#create-item").find("input[name='cep_local']").val('');
            $("#create-item").find("input[name='cidade_local']").val('');
            $("#create-item").find("input[name='estado_local']").val('');

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', {timeOut: 5000});

        });

    });
    $("body").on("click", ".edit-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_local = dataCon[index].cod_local;
        var cep_local = dataCon[index].cep_local;
        var cidade_local = dataCon[index].cidade_local;
        var estado_local = dataCon[index].estado_local;

        $("#edit-item").find("input[name='cod_local']").val(cod_local);
        $("#edit-item").find("input[name='cep_local']").val(cep_local);
        $("#edit-item").find("input[name='cidade_local']").val(cidade_local);
        $("#edit-item").find("input[name='estado_local']").val(estado_local);
    });

    $("body").on("click", ".view-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_local = dataCon[index].cod_local;
        var cep_local = dataCon[index].cep_local;
        var cidade_local = dataCon[index].cidade_local;
        var estado_local = dataCon[index].estado_local;

        $("#view-item").find("input[name='cod_local']").val(cod_local);
        $("#view-item").find("input[name='cep_local']").val(cep_local);
        $("#view-item").find("input[name='cidade_local']").val(cidade_local);
        $("#view-item").find("input[name='estado_local']").val(estado_local);
    });

    $(".crud-submit-edit").click(function (e) {

        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");

        var cod_local = $("#edit-item").find("input[name='cod_local']").val();
        var cep_local = $("#edit-item").find("input[name='cep_local']").val();
        var cidade_local = $("#edit-item").find("input[name='cidade_local']").val();
        var estado_local = $("#edit-item").find("input[name='estado_local']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: {cod_local: cod_local, cep_local: cep_local, cidade_local: cidade_local, estado_local: estado_local}

        }).done(function (data) {

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', {timeOut: 5000});
        });


    });

});
