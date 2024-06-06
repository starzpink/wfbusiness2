$(document).ready(function () {
    $(document).ready(function () {
        // Load the Google Charts library
        google.charts.load('current', { 'packages': ['corechart'] });

        // Chart data arrays
        var chartAreaat = [];
        var chartLocal = [];
        var chartCadEmp = [];

        // Load charts when Google Charts library is ready
        google.charts.setOnLoadCallback(loadCharts);

        function loadCharts() {
            carregaChartAreaat();
            carregaChartLocal();
            carregaChartCadEmp();
        }
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
                        chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
                        document.getElementById('png_areaat').outerHTML = '<a href="' + chart.getImageURI() + '">Versão para Impressão</a>';
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
                        chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
                        document.getElementById('png_local').outerHTML = '<a href="' + chart.getImageURI() + '">Versão para Impressão</a>';
                    });
                    chart.draw(data, options);
                }
            });
        }
        function carregaChartCadEmp() {
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: 'chart/chartCadEmp.php', // Altere este URL para o correto
                data: {}
            }).done(function (data) {
                $.each(data.data, function (key, value) {
                    chartCadEmp.push([value.data_registro, value.nome_emp]);
                });
                drawChartCadEmp();
            });
        }
    
        function drawChartCadEmp() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Data de Registro');
            data.addColumn('number', 'Quantidade de Empresas');
    
            // Agrupa os dados por data
            var groupedData = chartCadEmp.reduce(function (acc, curr) {
                var date = curr[0];
                if (!acc[date]) {
                    acc[date] = 0;
                }
                acc[date]++;
                return acc;
            }, {});
    
            // Converte o objeto agrupado em um array
            var rows = [];
            for (var date in groupedData) {
                if (groupedData.hasOwnProperty(date)) {
                    rows.push([date, groupedData[date]]);
                }
            }
    
            data.addRows(rows);
    
            var options = {
                title: 'Empresas Cadastradas ao Longo do Tempo',
                bar: { groupWidth: '95%' },
                legend: { position: 'none' },
                width: 400,
                height: 300
            };
    
            var chart_div = document.getElementById('chart_div_coluna');
            var chart = new google.visualization.ColumnChart(chart_div);
            google.visualization.events.addListener(chart, 'ready', function () {
                chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
                document.getElementById('png_coluna').outerHTML = '<a href="' + chart.getImageURI() + '">Versão para Impressão</a>';
            });
            chart.draw(data, options);
        }
    });
});
