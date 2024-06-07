<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sbstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                <h2>graf vaga</h2>
            </div>
            <div class="dash-graf-modali">
                <h2>graf modali</h2>
            </div>
        </div>
        <div class="dash-bot">
            <div class="dash-ano">
                <h2>fome</h2>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#chart_vagas">
            Gráfico Vagas
        </button>
        <!-- Chart Modal -->
        <div class="modal fade" id="chart_vagas" tabindex="-1" role="dialog" aria-labelledby="myModalLabelVagas">
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
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#chart_mod">
            Gráfico Locais das Empresas
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
</body>
</html>