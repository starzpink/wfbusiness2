$(document).ready(function () {
    var chartAreaat = new Array();
    carregaChartAreaat();

    var chartLocal = new Array();
    carregaChartLocal();
    
    function carregaChartAreaat() {
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: 'chart/chartAreaat.php',
            data: {}
        }).done(function (data) {
            $.each(data.data, function (key, value) {
                chartAreaat.push(new Array(new String(value.desc_area).toString(), new Number(value.total).valueOf()));
            });

            google.charts.load('current', { 'packages': ['corechart'] });
            google.charts.setOnLoadCallback(drawChartAreaat);

            function drawChartAreaat() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Área');
                data.addColumn('number', 'Quantidade');
                data.addRows(chartAreaat);

                var options = {
                    'title': 'Quantidade de Empresas Por Áreas de Atuação',
                    'width': 400,
                    'height': 300
                };

                var chart_div = document.getElementById('chart_div_areaat');
                var chart = new google.visualization.PieChart(chart_div);
                google.visualization.events.addListener(chart, 'ready', function () {
                    chart_div.innerHTML = '<img src="'+chart.getImageURI()+'">';
                    document.getElementById('png_areaat').outerHTML = '<a href="'+ chart.getImageURI() +'">Versão para Impressão</a>';
                });
                chart.draw(data, options);
            }
        });
    }

    function carregaChartLocal() {
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: 'chart/chartLocal.php',
            data: {}
        }).done(function (data) {
            $.each(data.data, function (key, value) {
                chartLocal.push(new Array(new String(value.cidade_local).toString(), new Number(value.total).valueOf()));
            });

            google.charts.load('current', { 'packages': ['corechart'] });
            google.charts.setOnLoadCallback(drawChartLocal);

            function drawChartLocal() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Cidade');
                data.addColumn('number', 'Quantidade');
                data.addRows(chartLocal);

                var options = {
                    'title': 'Quantidade de Empresas dividida por Cidades',
                    'width': 400,
                    'height': 300
                };

                var chart_div = document.getElementById('chart_div_local');
                var chart = new google.visualization.PieChart(chart_div);
                google.visualization.events.addListener(chart, 'ready', function () {
                    chart_div.innerHTML = '<img src="'+chart.getImageURI()+'">';
                    document.getElementById('png_local').outerHTML = '<a href="'+ chart.getImageURI() +'">Versão para Impressão</a>';
                });
                chart.draw(data, options);
            }
        });
    }

});
