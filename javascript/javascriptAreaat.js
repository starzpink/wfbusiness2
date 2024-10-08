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
            url: 'get/getAreaat.php',
            data: { page: page }
        }).done(function (data) {
            console.log('Initial data:', data);
            total_page = Math.ceil(data.total / 10);
            current_page = page;

            if (is_ajax_fire === 0) {
                $('#pagination').twbsPagination({
                    totalPages: total_page,
                    visiblePages: 5,
                    onPageClick: function (event, pageL) {
                        page = pageL;
                        if (is_ajax_fire != 0) {
                            getPageData();
                        }
                    }
                });
                is_ajax_fire = 1;
            }
            
            manageRow(data.data);
        });
    }

    function getPageData() {
        $.ajax({
            dataType: 'json',
            url: 'get/getAreaat.php',
            data: { page: page }
        }).done(function (data) {
            console.log('Page data:', data);
            manageRow(data.data);
        });
    }

    function manageRow(data) {

        dataCon = data;
        var rows = '';
        var i = 0;
        $.each(data, function (key, value) {
            rows = rows + '<tr>';
            rows = rows + '<td>' + value.cod_area + '</td>';
            rows = rows + '<td>' + value.desc_area + '</td>';
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
        rows = rows + '<th> Área de Atuação </th>';
        rows = rows + '<th width="200px">Ação</th>'
        rows = rows + '</tr>'
        $("thead").html(rows);
    }
    function createForm() {

        var html = '';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="desc_area">Descrição da Área de Atuação</label>';
        html = html + '<input type="text" name="desc_area" class="form-control" data-error="Por favor, insira a descrição da área de atuação." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit btn-success">Cadastrar</button>';
        html = html + '</div>';
        $("#create-item").find("form").html(html);
    }
    function createEditForm() {

        var html = '<input type="hidden" name="cod" class="edit-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_area">Código da Área de Atuação</label>';
        html = html + '<input type="text" name="cod_area" class="form-control" data-error="Por favor, insira o código da área de atuação." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<label class="control-label" for="desc_area">Descrição da Área de Atuação</label>';
        html = html + '<input type="text" name="desc_area" class="form-control" data-error="Por favor, insira a descrição da área de atuação." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit-edit btn-success">Salvar</button>';
        html = html + '</div>';
        $("#edit-item").find("form").html(html);

    }

    function createViewForm() {

        var html = '<input type="hidden" name="cod" class="view-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_area">Código da Área de Atuação</label>';
        html = html + '<input type="text" name="cod_area" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="desc_area">Descrição da Área de Atuação</label>';
        html = html + '<input type="text" name="desc_area" class="form-control" readonly/>';
        html = html + '</div>';
        $("#view-item").find("form").html(html);

    }

    $(".crud-submit").click(function (e) {
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var cod_area = $("#create-item").find("input[name='cod_area']").val();
        var desc_area = $("#create-item").find("input[name='desc_area']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { cod_area: cod_area, desc_area: desc_area }
        }).done(function (data) {

            $("#create-item").find("input[name='cod_area']").val('');
            $("#create-item").find("input[name='desc_area']").val('');

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });

        });

    });
    $("body").on("click", ".edit-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_area = dataCon[index].cod_area;
        var desc_area = dataCon[index].desc_area;

        $("#edit-item").find("input[name='cod_area']").val(cod_area);
        $("#edit-item").find("input[name='desc_area']").val(desc_area);
    });

    $("body").on("click", ".view-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_area = dataCon[index].cod_area;
        var desc_area = dataCon[index].desc_area;

        $("#view-item").find("input[name='cod_area']").val(cod_area);
        $("#view-item").find("input[name='desc_area']").val(desc_area);
    });

    $(".crud-submit-edit").click(function (e) {

        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");

        var cod_area = $("#edit-item").find("input[name='cod_area']").val();
        var desc_area = $("#edit-item").find("input[name='desc_area']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: { cod_area: cod_area, desc_area: desc_area }

        }).done(function (data) {

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', { timeOut: 5000 });
        });


    });

});
