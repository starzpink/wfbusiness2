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
    getLocalSelect();
    getModalidadeSelect();
    getTipoSelect();

    function manageData() {

        $.ajax({
            dataType: 'json',
            url: 'get/getVaga.php',
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
            url: 'getVaga.php',

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
            rows = rows + '<td>' + value.cod_vaga + '</td>';
            rows = rows + '<td>' + value.titulo_vaga + '</td>';
            rows = rows + '<td data-id="' + i++ + '">';
            rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Editar</button> ';
            rows = rows + '<button data-toggle="modal" data-target="#view-item" class="btn btn-primary view-item">Visualizar</button> ';
            rows = rows + '<button class="btn btn-primary view-candidates" data-cod_vaga="' + value.cod_vaga + '">Ver Candidatos</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
        });

        $("tbody").html(rows);
    }
    function createHeadTable() {

        var rows = '<tr>';
        rows = rows + '<th> Código </th>';
        rows = rows + '<th> Título da Vaga </th>';
        rows = rows + '<th width="300px">Ação</th>'
        rows = rows + '</tr>'
        $("thead").html(rows);
    }
    function createForm() {

        var html = '';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="titulo_vaga">Título da Vaga</label>';
        html = html + '<input type="text" name="titulo_vaga" class="form-control" data-error="Por favor, insira o título da vaga." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="descricao_vaga">Descrição</label>';
        html = html + '<textarea name="descricao_vaga" class="form-control" data-error="Por favor, insira a descrição da vaga." required></textarea>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="salario_vaga">Salário</label>';
        html = html + '<input type="text" name="salario_vaga" class="form-control"></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_local">Local</label>';
        html = html + '<select name="cod_local" id="cod_local" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_mod">Modalidade</label>';
        html = html + '<select name="cod_mod" id="cod_mod" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_tipo">Tipo da vaga</label>';
        html = html + '<select name="cod_tipo" id="cod_tipo" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="horario_vaga">Horário da Vaga</label>';
        html = html + '<input type="text" name="horario_vaga" class="form-control" data-error="Por favor, insira o horário da vaga." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="situacao_vaga">Situação da Vaga</label>';
        html = html + '<input type="text" name="situacao_vaga" class="form-control" data-error="Por favor, insira a situação da vaga." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit btn-success">Cadastrar</button>';
        html = html + '</div>';
        $("#create-item").find("form").html(html);
    }
    function createEditForm() {

        var html = '<input type="hidden" name="cod" class="edit-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_vaga">Código da Vaga</label>';
        html = html + '<input type="text" name="cod_vaga" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="titulo_vaga">Título da Vaga</label>';
        html = html + '<input type="text" name="titulo_vaga" class="form-control" data-error="Por favor, insira o título da vaga." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="descricao_vaga">Descrição</label>';
        html = html + '<textarea name="descricao_vaga" class="form-control" data-error="Por favor, insira a descrição da vaga." required></textarea>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="salario_vaga">Salário</label>';
        html = html + '<input type="text" name="salario_vaga" class="form-control"></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_local">Local</label>';
        html = html + '<select name="cod_local" id="cod_local_edit" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_mod">Modalidade</label>';
        html = html + '<select name="cod_mod" id="cod_mod_edit" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_tipo">Tipo da vaga</label>';
        html = html + '<select name="cod_tipo" id="cod_tipo_edit" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="horario_vaga">Horário da Vaga</label>';
        html = html + '<input type="text" name="horario_vaga" class="form-control" data-error="Por favor, insira o horário da vaga." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="situacao_vaga">Situação da Vaga</label>';
        html = html + '<input type="text" name="situacao_vaga" class="form-control" data-error="Por favor, insira a situação da vaga." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit-edit btn-success">Salvar</button>';
        html = html + '</div>';
        $("#edit-item").find("form").html(html);

    }

    function createViewForm() {

        var html = '<input type="hidden" name="cod" class="view-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_vaga">Código da Vaga</label>';
        html = html + '<input type="text" name="cod_vaga" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="titulo_vaga">Título da Vaga</label>';
        html = html + '<input type="text" name="titulo_vaga" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="descricao_vaga">Descrição</label>';
        html = html + '<textarea name="descricao_vaga" class="form-control" readonly></textarea>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="salario_vaga">Salário</label>';
        html = html + '<input type="text" name="salario_vaga" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_local_view">Local</label>';
        html = html + '<select name="cod_local" id="cod_local_view" class="form-control" disabled></select>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_mod_view">Modalidade</label>';
        html = html + '<select name="cod_mod" id="cod_mod_view" class="form-control" disabled></select>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_tipo_view">Tipo da vaga</label>';
        html = html + '<select name="cod_tipo" id="cod_tipo_view" class="form-control" disabled></select>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="horario_vaga">Horário da Vaga</label>';
        html = html + '<input type="text" name="horario_vaga" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="situacao_vaga">Situação da Vaga</label>';
        html = html + '<input type="text" name="situacao_vaga" class="form-control" readonly/>';
        html = html + '</div>';
        $("#view-item").find("form").html(html);

    }

    $(".crud-submit").click(function (e) {
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var titulo_vaga = $("#create-item").find("input[name='titulo_vaga']").val();
        var descricao_vaga = $("#create-item").find("textarea[name='descricao_vaga']").val();
        var salario_vaga = $("#create-item").find("input[name='salario_vaga']").val();
        var cod_local = $("#create-item").find("select[name='cod_local']").val();
        var cod_mod = $("#create-item").find("select[name='cod_mod']").val();
        var cod_tipo = $("#create-item").find("select[name='cod_tipo']").val();
        var horario_vaga = $("#create-item").find("input[name='horario_vaga']").val();
        var situacao_vaga = $("#create-item").find("input[name='situacao_vaga']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { titulo_vaga: titulo_vaga, descricao_vaga: descricao_vaga, salario_vaga: salario_vaga, cod_local: cod_local, cod_mod: cod_mod, cod_tipo: cod_tipo, horario_vaga: horario_vaga, situacao_vaga: situacao_vaga }
        }).done(function (data) {

            $("#create-item").find("input[name='titulo_vaga']").val('');
            $("#create-item").find("textarea[name='descricao_vaga']").val('');
            $("#create-item").find("input[name='salario_vaga']").val('');
            $("#create-item").find("select[name='cod_local]").val('');
            $("#create-item").find("select[name='cod_mod']").val('');
            $("#create-item").find("select[name='cod_tipo']").val('');
            $("#create-item").find("input[name='horario_vaga']").val('');
            $("#create-item").find("input[name='situacao_vaga']").val('');
            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });

        });

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { titulo_vaga: titulo_vaga, descricao_vaga: descricao_vaga, salario_vaga: salario_vaga, cod_local: cod_local, cod_mod: cod_mod, cod_tipo: cod_tipo, horario_vaga: horario_vaga, situacao_vaga: situacao_vaga }
        }).done(function (data) {

            $("#create-item").find("input[name='titulo_vaga']").val('');
            $("#create-item").find("textarea[name='descricao_vaga']").val('');
            $("#create-item").find("input[name='salario_vaga']").val('');
            $("#create-item").find("select[name='cod_local]").val('');
            $("#create-item").find("select[name='cod_mod']").val('');
            $("#create-item").find("select[name='cod_tipo']").val('');
            $("#create-item").find("input[name='horario_vaga']").val('');
            $("#create-item").find("input[name='situacao_vaga']").val('');
            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });

        });

    });
    $("body").on("click", ".edit-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_vaga = dataCon[index].cod_vaga;
        var titulo_vaga = dataCon[index].titulo_vaga;
        var descricao_vaga = dataCon[index].descricao_vaga;
        var salario_vaga = dataCon[index].salario_vaga;
        var cod_local = dataCon[index].cod_local;
        var cod_mod = dataCon[index].cod_mod;
        var cod_tipo = dataCon[index].cod_tipo;
        var horario_vaga = dataCon[index].horario_vaga;
        var situacao_vaga = dataCon[index].situacao_vaga;

        $("#edit-item").find("input[name='cod_vaga']").val(cod_vaga);
        $("#edit-item").find("input[name='titulo_vaga']").val(titulo_vaga);
        $("#edit-item").find("textarea[name='descricao_vaga']").val(descricao_vaga);
        $("#edit-item").find("input[name='salario_vaga']").val(salario_vaga);
        $("#edit-item").find("select[name='cod_local']").val(cod_local);
        $("#edit-item").find("select[name='cod_mod']").val(cod_mod);
        $("#edit-item").find("select[name='cod_tipo']").val(cod_tipo);
        $("#edit-item").find("input[name='horario_vaga']").val(horario_vaga);
        $("#edit-item").find("input[name='situacao_vaga']").val(situacao_vaga);
    });

    $("body").on("click", ".view-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_vaga = dataCon[index].cod_vaga;
        var titulo_vaga = dataCon[index].titulo_vaga;
        var descricao_vaga = dataCon[index].descricao_vaga;
        var salario_vaga = dataCon[index].salario_vaga;
        var cod_local = dataCon[index].cod_local;
        var cod_mod = dataCon[index].cod_mod;
        var cod_tipo = dataCon[index].cod_tipo;
        var horario_vaga = dataCon[index].horario_vaga;
        var situacao_vaga = dataCon[index].situacao_vaga;

        $("#view-item").find("input[name='cod_vaga']").val(cod_vaga);
        $("#view-item").find("input[name='titulo_vaga']").val(titulo_vaga);
        $("#view-item").find("textarea[name='descricao_vaga']").val(descricao_vaga);
        $("#view-item").find("input[name='salario_vaga']").val(salario_vaga);
        $("#view-item").find("select[name='cod_local']").val(cod_local);
        $("#view-item").find("select[name='cod_mod']").val(cod_mod);
        $("#view-item").find("select[name='cod_tipo']").val(cod_tipo);
        $("#view-item").find("input[name='horario_vaga']").val(horario_vaga);
        $("#view-item").find("input[name='situacao_vaga']").val(situacao_vaga);

    });

    $(".crud-submit-edit").click(function (e) {

        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");

        var cod_vaga = $("#edit-item").find("input[name='cod_vaga']").val();
        var titulo_vaga = $("#edit-item").find("input[name='titulo_vaga']").val();
        var descricao_vaga = $("#edit-item").find("textarea[name='descricao_vaga']").val();
        var salario_vaga = $("#edit-item").find("input[name='salario_vaga']").val();
        var cod_local = $("#edit-item").find("select[name='cod_local']").val();
        var cod_mod = $("#edit-item").find("select[name='cod_mod']").val();
        var cod_tipo = $("#edit-item").find("select[name='cod_tipo']").val();
        var horario_vaga = $("#edit-item").find("input[name='horario_vaga']").val();
        var situacao_vaga = $("#edit-item").find("input[name='situacao_vaga']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { cod_vaga: cod_vaga, titulo_vaga: titulo_vaga, descricao_vaga: descricao_vaga, salario_vaga: salario_vaga, cod_local: cod_local, cod_mod: cod_mod, cod_tipo: cod_tipo, horario_vaga: horario_vaga, situacao_vaga: situacao_vaga }

        }).done(function (data) {

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });
        });


    });

    function getLocalSelect() {

        $.ajax({
            dataType: 'json',
            url: 'get/getLocaltrabalho.php',
            data: {}
        }).done(function (data) {

            var htmlSelect = '';
            $.each(data.data, function (key, value) {
                htmlSelect = htmlSelect + '<option value="' + value.cod_local + '"> ' + value.cidade_local + '</option>';
            });
            $("#cod_local").html(htmlSelect);
            $("#cod_local_edit").html(htmlSelect);
            $("#cod_local_view").html(htmlSelect);

        });
    }

    function getModalidadeSelect() {

        $.ajax({
            dataType: 'json',
            url: 'get/getModalidade.php',
            data: {}
        }).done(function (data) {

            var htmlSelect = '';
            $.each(data.data, function (key, value) {
                htmlSelect = htmlSelect + '<option value="' + value.cod_mod + '"> ' + value.desc_mod + '</option>';
            });
            $("#cod_mod").html(htmlSelect);
            $("#cod_mod_edit").html(htmlSelect);
            $("#cod_mod_view").html(htmlSelect);

        });
    }

    function getTipoSelect() {

        $.ajax({
            dataType: 'json',
            url: 'get/getTipovaga.php',
            data: {}
        }).done(function (data) {

            var htmlSelect = '';
            $.each(data.data, function (key, value) {
                htmlSelect = htmlSelect + '<option value="' + value.cod_tipo + '"> ' + value.desc_tipo + '</option>';
            });
            $("#cod_tipo").html(htmlSelect);
            $("#cod_tipo_edit").html(htmlSelect);
            $("#cod_tipo_view").html(htmlSelect);

        });
    }

    $(document).on('click', '.view-candidates', function () {
        var cod_vaga = $(this).data('cod_vaga');
        window.location.href = 'candidatos.php?cod_vaga=' + cod_vaga;
    });
});