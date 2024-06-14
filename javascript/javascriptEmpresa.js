$(document).ready(function () {
    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;
    var types = new Map();
    var dataCon;
    createHeadTable();
    createViewForm();
    manageData();
    getDataSelect();
    getLocalSelect();

    function manageData() {
        $.ajax({
            dataType: 'json',
            url: 'get/getEmpresa.php',
            data: { page: page }
        }).done(function (data) {
            console.log('Initial data:', data);  // Log initial data for debugging
            total_page = Math.ceil(data.total / 10);
            current_page = page;

            if (is_ajax_fire === 0) {
                $('#pagination').twbsPagination({
                    totalPages: total_page,
                    visiblePages: 5,  // Assuming you want to show 5 visible pages
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
            url: 'getEmpresa.php',
            data: { page: page }
        }).done(function (data) {
            console.log('Page data:', data);  // Log page data for debugging
            manageRow(data.data);
        });
    }

    function manageRow(data) {

        dataCon = data;
        var rows = '';
        var i = 0;
        $.each(data, function (key, value) {
            rows = rows + '<tr>';
            rows = rows + '<td>' + value.cod_emp + '</td>';
            rows = rows + '<td>' + value.nome_emp + '</td>';
            rows = rows + '<td data-id="' + i++ + '">';
            rows = rows + '<button data-toggle="modal" data-target="#view-item" class="btn btn-primary view-item">Visualizar</button> ';
            rows = rows + '</td>';
            rows = rows + '</tr>';
        });

        $("tbody").html(rows);
    }
    function createHeadTable() {

        var rows = '<tr>';
        rows = rows + '<th> Código </th>';
        rows = rows + '<th> Nome da Empresa </th>';
        rows = rows + '<th width="105px">Ação</th>'
        rows = rows + '</tr>'
        $("thead").html(rows);
    }

    function createViewForm() {

        var html = '<input type="hidden" name="cod" class="view-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_emp">Código da Empresa</label>';
        html = html + '<input type="text" name="cod_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="nome_emp">Nome da Empresa</label>';
        html = html + '<input type="text" name="nome_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_local">Local</label>';
        html = html + '<select id="cod_local_view" name="cod_local" class="form-control" disabled></select>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="areaat_emp">Área de Atuação</label>';
        html = html + '<select id="cod_area_view" name="areaat_emp" class="form-control" disabled></select>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="desc_emp">Descrição</label>';
        html = html + '<textarea name="desc_emp" class="form-control" rows="4" readonly></textarea>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="email_emp">E-mail</label>';
        html = html + '<input type="text" name="email_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="site_emp">Site</label>';
        html = html + '<input type="text" name="site_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="tel_emp">Telefone</label>';
        html = html + '<input type="text" name="tel_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cnpj_emp">CNPJ</label>';
        html = html + '<input type="text" name="cnpj_emp" class="form-control" readonly/>';
        html = html + '</div>';
        $("#view-item").find("form").html(html);

    }

    $("body").on("click", ".view-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_emp = dataCon[index].cod_emp;
        var nome_emp = dataCon[index].nome_emp;
        var cod_local = dataCon[index].cod_local;
        var areaat_emp = dataCon[index].areaat_emp;
        var desc_emp = dataCon[index].desc_emp;
        var email_emp  = dataCon[index].email_emp;
        var site_emp  = dataCon[index].site_emp;
        var tel_emp  = dataCon[index].tel_emp;
        var cnpj_emp  = dataCon[index].cnpj_emp;

        $("#view-item").find("input[name='cod_emp']").val(cod_emp);
        $("#view-item").find("input[name='nome_emp']").val(nome_emp);
        $("#view-item").find("select[name='cod_local']").val(cod_local);
        $("#view-item").find("select[name='areaat_emp']").val(areaat_emp);
        $("#view-item").find("textarea[name='desc_emp']").val(desc_emp);
        $("#view-item").find("input[name='email_emp']").val(email_emp);
        $("#view-item").find("input[name='site_emp']").val(site_emp);
        $("#view-item").find("input[name='tel_emp']").val(tel_emp);
        $("#view-item").find("input[name='cnpj_emp']").val(cnpj_emp);
    });

    function getDataSelect() {

        $.ajax({
            dataType: 'json',
            url: 'get/getAreaat.php',
            data: {}
        }).done(function (data) {

            var htmlSelect = '';
            $.each(data.data, function (key, value) {
                htmlSelect = htmlSelect + '<option value="' + value.cod_area + '"> ' + value.desc_area + '</option>';
            });

            $("#cod_area_view").html(htmlSelect);
        });
    }

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

            $("#cod_local_view").html(htmlSelect);
        });
    }
});