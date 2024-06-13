$(document).ready(function () {
    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;
    var types = new Map();
    var dataCon;
    createHeadTable();
    manageData();

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
            url: 'get/getVaga.php',
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
            rows += '<tr>';
            rows += '<td>' + value.cod_vaga + '</td>';
            rows += '<td>' + value.titulo_vaga + '</td>';
            rows += '<td>' + value.situacao_vaga + '</td>';
            rows += '</tr>';
        });

        $("tbody").html(rows);
    }

    function createHeadTable() {
        var rows = '<tr>';
        rows += '<th class="thcod">Código</th>';
        rows += '<th class="thtitulo">Título da Vaga</th>';
        rows += '<th class="thsitu">Situação da Vaga</th>';
        rows += '</tr>';
        $("thead").html(rows);
    }
});
