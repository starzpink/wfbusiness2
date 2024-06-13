$(document).ready(function () {
    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;
    var types = new Map();
    var dataCon;
    var cod_vaga = new URLSearchParams(window.location.search).get('cod_vaga');

    createHeadTable();
    createViewForm();
    manageData();

    function manageData() {
        $.ajax({
            dataType: 'json',
            url: 'get/getCandidato.php',
            data: { page: page, cod_vaga: cod_vaga }
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
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.error("Error fetching data: ", textStatus, errorThrown);
            alert("Error fetching data. Please try again later.");
        });
    }

    function getPageData() {
        $.ajax({
            dataType: 'json',
            url: 'get/getCandidato.php',
            data: { page: page, cod_vaga: cod_vaga }
        }).done(function (data) {
            manageRow(data.data);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.error("Error fetching page data: ", textStatus, errorThrown);
            alert("Error fetching page data. Please try again later.");
        });
    }

    function manageRow(data) {
        if (!Array.isArray(data) || data.length === 0) {
            $("tbody").html("<tr><td colspan='3'>No data found</td></tr>");
            return;
        }

        dataCon = data;
        var rows = '';
        var i = 0;
        $.each(data, function (key, value) {
            rows += '<tr>';
            rows += '<td>' + value.cod_cand + '</td>';
            rows += '<td>' + value.nome_cand + '</td>';
            rows += '<td data-id="' + i++ + '">';
            rows += '<button data-toggle="modal" data-target="#view-item" class="btn btn-primary view-item">Visualizar</button>';
            rows += '</td>';
            rows += '</tr>';
        });
        $("tbody").html(rows);
    }
    function createHeadTable() {

        var rows = '<tr>';
        rows = rows + '<th> Código </th>';
        rows = rows + '<th> Nome </th>';
        rows = rows + '<th width="105px">Ação</th>'
        rows = rows + '</tr>'
        $("thead").html(rows);
    }

    function createViewForm() {

        var html = '<input type="hidden" name="cod" class="view-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="nome_cand">Nome</label>';
        html = html + '<input type="text" name="nome_cand" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="link_port">Link do Portfolio</label>';
        html = html + '<input type="text" name="link_port" class="form-control" readonly/>';
        html = html + '</div>';
        $("#view-item").find("form").html(html);

    }

    $("body").on("click", ".view-item", function () {
        var index = $(this).parent("td").data('id');

        var nome_cand = dataCon[index].nome_cand;
        var link_port = dataCon[index].link_port;

        $("#view-item").find("input[name='nome_cand']").val(nome_cand);
        $("#view-item").find("input[name='link_port']").val(link_port);
    });

});
