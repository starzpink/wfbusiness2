<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sbstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="javascript/javascriptChart.js"></script>

    <title>Dashboard</title>
</head>

<body class="v-body">
    <nav class="nav-sidebar">
        <?php include 'sidebarEmpresa.php'; ?>
    </nav>
    <div class="v-principal">
        <h1>Dashboard</h1>
        <div class="dash-top">
            <div class="dash-vagas-abertas">
                <h2>vagas</h2>
                
            </div>
            <div class="dash-portfolios-recebidos">
                <h2>portfolios recebidos</h2>
            </div>
            <div class="dash-contratados">
                <h2>contrat<h2>
            </div>
        </div>
        <div class="dash-meio">
            <div class="dash-graf-vagas">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#chart_vagas">
                    Gráfico Vagas
                </button>
                <!-- Chart Modal -->
                <div class="modal fade" id="chart_vagas" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabelVagas">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabelVagas">Gráfico de Vagas</h4>
                            </div>
                            <div class="modal-body">
                                <div id="chart_div_vagas"></div>
                                <div id="png_vagas"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dash-graf-modali">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#chart_mod">
                    Gráfico Modalidades
                </button>
                <!-- Chart Modal -->
                <div class="modal fade" id="chart_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabelMod">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabelMod">Gráfico Modalidades</h4>
                            </div>
                            <div class="modal-body">
                                <div id="chart_div_mod"></div>
                                <div id="png_mod"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dash-bot">
            <div class="dash-ano">
                <h2>fome</h2>
            </div>
        </div>
    </div>

</body>

</html>