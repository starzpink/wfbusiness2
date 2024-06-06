<?php $classe = isset($_GET["classe"]) ? $_GET["classe"] : ""; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Área do Administrador</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="javascript/javascript<?php echo $classe; ?>.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="javascript/javascriptChart.js"></script>
</head>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="administracao.php">Home</a></li>
                <li><a href="administracao.php?classe=Areaat">Áreas de Atuação</a></li>
                <li><a href="administracao.php?classe=Competencia">Competências</a></li>
                <li><a href="administracao.php?classe=Empresa">Empresas</a></li>
                <li><a href="administracao.php?classe=Localtrabalho">Locais de Trabalho</a></li>
                <li><a href="administracao.php?classe=Modalidade">Modalidades</a></li>
                <li><a href="administracao.php?classe=Requisito">Requisitos</a></li>
                <li><a href="administracao.php?classe=Sede">Sedes</a></li>
                <li><a href="administracao.php?classe=Tipovaga">Tipos de Vagas</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </div>
    </nav>
    <?php if (!empty($classe)) { ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Cadastro de <?php echo $classe; ?></h2>
                    </div>
                    <div class="pull-right">
                        <?php if ($classe != "Empresa") { ?>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
                                Criar <?php echo $classe; ?>
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-style">
                <thead style="background-color: #EEE8AA;">
                </thead>
                <tbody>
                </tbody>
            </table>

            <ul id="pagination" class="pagination-sm"></ul>
            <!-- Criação de Item Modal -->
            <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Criar <?php echo $classe; ?></h4>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" action="insert/insert<?php echo $classe; ?>.php" method="POST">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edição de Item Modal -->
            <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar <?php echo $classe; ?></h4>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" action="update/update<?php echo $classe; ?>.php" method="POST">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Visualização de Item Modal -->
            <div class="modal fade" id="view-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Visualizar <?php echo $classe; ?></h4>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" action="select<?php echo $classe; ?>.php" method="POST">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#chart_areaat">
            Gráfico Área de Atuação
        </button>
        <!-- Chart Modal -->
        <div class="modal fade" id="chart_areaat" tabindex="-1" role="dialog" aria-labelledby="myModalLabelAreaat">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabelAreaat">Gráfico Área de Atuação</h4>
                    </div>
                    <div class="modal-body">
                        <div id="chart_div_areaat"></div>
                        <div id="png_areaat"></div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#chart_local">
            Gráfico Locais das Empresas
        </button>
        <!-- Chart Modal -->
        <div class="modal fade" id="chart_local" tabindex="-1" role="dialog" aria-labelledby="myModalLabelLocal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabelLocal">Gráfico Locais das Empresas</h4>
                    </div>
                    <div class="modal-body">
                        <div id="chart_div_local"></div>
                        <div id="png_local"></div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
</body>

</html>
