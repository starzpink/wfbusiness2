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
            url: 'get/getModalidade.php',
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
            url: 'getModalidade.php',

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
            rows = rows + '<td>' + value.cod_mod + '</td>';
            rows = rows + '<td>' + value.desc_mod + '</td>';
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
        rows = rows + '<th> Modalidade </th>';
        rows = rows + '<th width="200px">Ação</th>'
        rows = rows + '</tr>'
        $("thead").html(rows);
    }
    function createForm() {

        var html = '';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="desc_mod">Descrição da Modalidade</label>';
        html = html + '<input type="text" name="desc_mod" class="form-control" data-error="Por favor, insira a descrição da modalidade." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit btn-success">Cadastrar</button>';
        html = html + '</div>';
        $("#create-item").find("form").html(html);
    }
    function createEditForm() {

        var html = '<input type="hidden" name="cod" class="edit-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_mod">Código da Modalidade</label>';
        html = html + '<input type="text" name="cod_mod" class="form-control" data-error="Por favor, insira o código da modalidade." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<label class="control-label" for="desc_mod">Descrição da Modalidade</label>';
        html = html + '<input type="text" name="desc_mod" class="form-control" data-error="Por favor, insira a descrição da modalidade." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit-edit btn-success">Salvar</button>';
        html = html + '</div>';
        $("#edit-item").find("form").html(html);

    }

    function createViewForm() {

        var html = '<input type="hidden" name="cod" class="view-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_mod">Código da Modalidade</label>';
        html = html + '<input type="text" name="cod_mod" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="desc_mod">Descrição da Modalidade</label>';
        html = html + '<input type="text" name="desc_mod" class="form-control" readonly/>';
        html = html + '</div>';
        $("#view-item").find("form").html(html);

    }

    $(".crud-submit").click(function (e) {
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var cod_mod = $("#create-item").find("input[name='cod_mod']").val();
        var desc_mod = $("#create-item").find("input[name='desc_mod']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { cod_mod: cod_mod, desc_mod: desc_mod }
        }).done(function (data) {

            $("#create-item").find("input[name='cod_mod']").val('');
            $("#create-item").find("input[name='desc_mod']").val('');

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });

        });

    });
    $("body").on("click", ".edit-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_mod = dataCon[index].cod_mod;
        var desc_mod = dataCon[index].desc_mod;

        $("#edit-item").find("input[name='cod_mod']").val(cod_mod);
        $("#edit-item").find("input[name='desc_mod']").val(desc_mod);
    });

    $("body").on("click", ".view-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_mod = dataCon[index].cod_mod;
        var desc_mod = dataCon[index].desc_mod;

        $("#view-item").find("input[name='cod_mod']").val(cod_mod);
        $("#view-item").find("input[name='desc_mod']").val(desc_mod);
    });

    $(".crud-submit-edit").click(function (e) {

        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");

        var cod_mod = $("#edit-item").find("input[name='cod_mod']").val();
        var desc_mod = $("#edit-item").find("input[name='desc_mod']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { cod_mod: cod_mod, desc_mod: desc_mod }

        }).done(function (data) {

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });
        });


    });

});
