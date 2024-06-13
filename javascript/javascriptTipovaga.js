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
            url: 'get/getTipovaga.php',
            data: { page: page }
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
            url: 'getTipovaga.php',

            data: { page: page }
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
            rows = rows + '<td>' + value.cod_tipo + '</td>';
            rows = rows + '<td>' + value.desc_tipo + '</td>';
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
        rows = rows + '<th> Tipo de Vaga </th>';
        rows = rows + '<th width="200px">Ação</th>'
        rows = rows + '</tr>'
        $("thead").html(rows);
    }
    function createForm() {

        var html = '';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="desc_tipo">Descrição da Tipo de Vaga</label>';
        html = html + '<input type="text" name="desc_tipo" class="form-control" data-error="Por favor, insira a descrição do Tipo de Vaga." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit btn-success">Cadastrar</button>';
        html = html + '</div>';
        $("#create-item").find("form").html(html);
    }
    function createEditForm() {

        var html = '<input type="hidden" name="cod" class="edit-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_tipo">Código do Tipo de Vaga</label>';
        html = html + '<input type="text" name="cod_tipo" class="form-control" data-error="Por favor, insira o código do Tipo de Vaga." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<label class="control-label" for="desc_tipo">Descrição do Tipo de Vaga</label>';
        html = html + '<input type="text" name="desc_tipo" class="form-control" data-error="Por favor, insira a descrição do Tipo de Vaga." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit-edit btn-success">Salvar</button>';
        html = html + '</div>';
        $("#edit-item").find("form").html(html);

    }

    function createViewForm() {

        var html = '<input type="hidden" name="cod" class="view-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_tipo">Código do Tipo de Vaga</label>';
        html = html + '<input type="text" name="cod_tipo" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="desc_tipo">Descrição do Tipo de Vaga</label>';
        html = html + '<input type="text" name="desc_tipo" class="form-control" readonly/>';
        html = html + '</div>';
        $("#view-item").find("form").html(html);

    }

    $(".crud-submit").click(function (e) {
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var cod_tipo = $("#create-item").find("input[name='cod_tipo']").val();
        var desc_tipo = $("#create-item").find("input[name='desc_tipo']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { cod_tipo: cod_tipo, desc_tipo: desc_tipo }
        }).done(function (data) {

            $("#create-item").find("input[name='cod_tipo']").val('');
            $("#create-item").find("input[name='desc_tipo']").val('');

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });

        });

    });
    $("body").on("click", ".edit-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_tipo = dataCon[index].cod_tipo;
        var desc_tipo = dataCon[index].desc_tipo;

        $("#edit-item").find("input[name='cod_tipo']").val(cod_tipo);
        $("#edit-item").find("input[name='desc_tipo']").val(desc_tipo);
    });

    $("body").on("click", ".view-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_tipo = dataCon[index].cod_tipo;
        var desc_tipo = dataCon[index].desc_tipo;

        $("#view-item").find("input[name='cod_tipo']").val(cod_tipo);
        $("#view-item").find("input[name='desc_tipo']").val(desc_tipo);
    });

    $(".crud-submit-edit").click(function (e) {

        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");

        var cod_tipo = $("#edit-item").find("input[name='cod_tipo']").val();
        var desc_tipo = $("#edit-item").find("input[name='desc_tipo']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { cod_tipo: cod_tipo, desc_tipo: desc_tipo }

        }).done(function (data) {

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });
        });


    });

});
