$(document).ready(function () {
    $(document).ready(function () {
        // Load the Google Charts library
        google.charts.load('current', { 'packages': ['corechart'] });

        // Chart data arrays
        var chartAreaat = [];
        var chartLocal = [];
        var chartCadEmp = [];
        var chartVagas = [];
        var chartModalidade = [];

        // Load charts when Google Charts library is ready
        google.charts.setOnLoadCallback(loadCharts);

        function loadCharts() {
            carregaChartAreaat();
            carregaChartLocal();
            carregaChartCadEmp();
            carregaChartVagas();
            carregaChartModalidades();
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
            chart.draw(data, options);
        }
        function carregaChartVagas() {
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: 'chart/chartVaga.php',
                data: {}
            }).done(function (data) {
                $.each(data.data, function (key, value) {
                    chartVagas.push(new Array(new String(value.titulo_vaga).toString(), new Number(value.total).valueOf()));
                });

                google.charts.load('current', { 'packages': ['corechart'] });
                google.charts.setOnLoadCallback(drawChartVagas);

                function drawChartVagas() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Vaga');
                    data.addColumn('number', 'Quantidade');
                    data.addRows(chartVagas);

                    var options = {
                        'width': 400,
                        'height': 350,
                        'chartArea': {'width': '100%', 'height': '80%'},
                        'legend': {'position': 'bottom'}
                    };

                    var chart_div = document.getElementById('chart_div_vagas');
                    var chart = new google.visualization.PieChart(chart_div);
                    chart.draw(data, options);
                }
            });
        }
        function carregaChartModalidades() {
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: 'chart/chartModalidade.php',
                data: {}
            }).done(function (data) {
                $.each(data.data, function (key, value) {
                    chartModalidade.push(new Array(new String(value.desc_mod).toString(), new Number(value.total).valueOf()));
                });

                google.charts.load('current', { 'packages': ['corechart'] });
                google.charts.setOnLoadCallback(drawChartVagas);

                function drawChartVagas() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Modalidade');
                    data.addColumn('number', 'Quantidade');
                    data.addRows(chartModalidade);

                    var options = {
                        'width': 400,
                        'height': 350,
                        'chartArea': {'width': '100%', 'height': '80%'},
                        'legend': {'position': 'bottom'}
                    };

                    var chart_div = document.getElementById('chart_div_mod');
                    var chart = new google.visualization.PieChart(chart_div);
                    chart.draw(data, options);
                }
            });
        }
    });
});
