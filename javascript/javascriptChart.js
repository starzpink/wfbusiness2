$(document).ready(function () {
    var dataCon;
    var dataChart = new Array();
    carregaChart();
    
    function carregaChart() {
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: 'chart/chartAreaat.php',
            data: {}
        }).done(function (data) {
            $.each(data.data, function (key, value) {
                dataChart.push(new Array(new String(value.desc_area).toString(), new Number(value.total).valueOf()));
                //dataChart = dataChart + " ['" + value.descricao +"', "+ value.total + "]";
            });
            // Load the Visualization API and the corechart package.
            google.charts.load('current', { 'packages': ['corechart'] });
            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);
            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {
                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                data.addRows(dataChart);
                // Set chart options
                var options = {
                    'title': 'Quantidade de Empresas Por Áreas de Atuação',
                    'width': 400,
                    'height': 300
                };
                // Instantiate and draw our chart, passing in some options.
                var chart_div = document.getElementById('chart_div');
                var chart = new google.visualization.PieChart(chart_div);
                google.visualization.events.addListener(chart, 'ready', function () {
                    chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
                    console.log(chart_div.innerHTML);
                    document.getElementById('png').outerHTML = '<a href="' + chart.getImageURI() + '">Versão para Impressão</a > ';
                });
                chart.draw(data, options);
            }
        });
    }

});