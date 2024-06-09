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
    getDataSelect();
    getVagaSelect();


    function manageData() {

        $.ajax({
            dataType: 'json',
            url: 'get/getRequisito.php',
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
            url: 'getRequisito.php',

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
            rows = rows + '<td>' + value.cod_comp + '</td>';
            rows = rows + '<td>' + value.cod_vaga + '</td>';
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
        rows = rows + '<th> Competência </th>';
        rows = rows + '<th> Vaga </th>';
        rows = rows + '<th width="200px">Ação</th>'
        rows = rows + '</tr>'
        $("thead").html(rows);
    }
    function createForm() {

        var html = '';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_comp">Competência</label>';
        html = html + '<select name="cod_comp" id="cod_comp" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_vaga">Vaga</label>';
        html = html + '<select name="cod_vaga" id="cod_vaga" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit btn-success">Cadastrar</button>';
        html = html + '</div>';
        $("#create-item").find("form").html(html);
    }
    function createEditForm() {

        var html = '<input type="hidden" name="cod" class="edit-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_comp">Competência</label>';
        html = html + '<select name="cod_comp" id="cod_comp_edit" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_vaga">Vaga</label>';
        html = html + '<select name="cod_vaga" id="cod_vaga_edit" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit-edit btn-success">Salvar</button>';
        html = html + '</div>';
        $("#edit-item").find("form").html(html);

    }

    function createViewForm() {

        var html = '<input type="hidden" name="cod" class="view-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_comp">Competência</label>';
        html = html + '<select id="cod_comp_view" name="cod_comp" class="form-control" disabled></select>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_vaga">Vaga</label>';
        html = html + '<select id="cod_vaga_view" name="cod_vaga" class="form-control" disabled></select>';
        html = html + '</div>';
        $("#view-item").find("form").html(html);

    }

    $(".crud-submit").click(function (e) {
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var cod_comp = $("#create-item").find("input[name='cod_comp']").val();
        var cod_vaga = $("#create-item").find("input[name='cod_vaga']").val();
        
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: {cod_comp: cod_comp, cod_vaga: cod_vaga}
        }).done(function (data) {

            $("#create-item").find("input[name='cod_comp']").val('');
            $("#create-item").find("input[name='cod_vaga']").val('');

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', {timeOut: 5000});

        });

    });
    $("body").on("click", ".edit-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_comp = dataCon[index].cod_comp;
        var cod_vaga = dataCon[index].cod_vaga;

        $("#edit-item").find("input[name='cod_comp']").val(cod_comp);
        $("#edit-item").find("input[name='cod_vaga']").val(cod_vaga);
    });

    $("body").on("click", ".view-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_comp = dataCon[index].cod_comp;
        var cod_vaga = dataCon[index].cod_vaga;

        $("#view-item").find("input[name='cod_comp']").val(cod_comp);
        $("#view-item").find("input[name='cod_vaga']").val(cod_vaga);
    });

    $(".crud-submit-edit").click(function (e) {

        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");

        var cod_comp = $("#edit-item").find("input[name='cod_comp']").val();
        var cod_vaga = $("#edit-item").find("input[name='cod_vaga']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: {cod_comp: cod_comp, cod_vaga: cod_vaga}

        }).done(function (data) {

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', {timeOut: 5000});
        });


    });

    function getDataSelect() {

        $.ajax({
            dataType: 'json',
            url: 'get/getCompetencia.php',
            data: {}
        }).done(function (data) {

            var htmlSelect = '';
            $.each(data.data, function (key, value) {
                htmlSelect = htmlSelect + '<option value="' + value.cod_comp + '"> ' + value.desc_comp + '</option>';
            });
            $("#cod_comp").html(htmlSelect);
            $("#cod_comp_edit").html(htmlSelect);
            $("#cod_comp_view").html(htmlSelect);

        });
    }

    function getVagaSelect() {

        $.ajax({
            dataType: 'json',
            url: 'get/getVaga.php',
            data: {}
        }).done(function (data) {

            var htmlSelect = '';
            $.each(data.data, function (key, value) {
                htmlSelect = htmlSelect + '<option value="' + value.cod_vaga + '"> ' + value.titulo_vaga + '</option>';
            });
            $("#cod_vaga").html(htmlSelect);
            $("#cod_vaga_edit").html(htmlSelect);
            $("#cod_vaga_view").html(htmlSelect);

        });
    }

});
