<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sbstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="javascript/javascriptVaga.js"></script>
    <title>Vagas</title>
</head>

<body class="v-body">
    <nav class="nav-sidebar">
        <?php include 'sidebar.php'; ?>
    </nav>
    <div class="v-principal">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Cadastro de Vaga</h2>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
                            Criar Vaga
                        </button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-style">
                <thead>
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
                            <h4 class="modal-title" id="myModalLabel">Criar Vaga</h4>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" action="insert/insertVaga.php" method="POST">

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
                            <h4 class="modal-title" id="myModalLabel">Editar Vaga</h4>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" action="update/updateVaga.php" method="POST">
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
                            <h4 class="modal-title" id="myModalLabel">Visualizar Vaga</h4>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" action="get/getVaga.php" method="POST">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>