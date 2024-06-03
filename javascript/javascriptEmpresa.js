$(document).ready(function () {
    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;
    var types = new Map();
    var dataCon;
    createHeadTable();
    /*
    createForm();
    createEditForm();
    */
    createViewForm();
    manageData();
    getDataSelect();

    function manageData() {

        $.ajax({
            dataType: 'json',
            url: 'get/getEmpresa.php',
            data: {page: page}
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
            url: 'getEmpresa.php',

            data: {page: page}
        }).done(function (data) {
            manageRow(data.data);
        });
    }

    function manageRow(data) {

        dataCon = data;
        var rows = '';
        var i = 0;
        $.each(data, function (key, value) {
            rows = rows + '<tr>';
            rows = rows + '<td>' + value.cod_emp + '</td>';
            rows = rows + '<td>' + value.nome_emp + '</td>';
            rows = rows + '<td data-id="' + i++ + '">';
            //rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Editar</button> ';
            rows = rows + '<button data-toggle="modal" data-target="#view-item" class="btn btn-primary view-item">Visualizar</button> ';
            rows = rows + '</td>';
            rows = rows + '</tr>';
        });

        $("tbody").html(rows);
    }
    function createHeadTable() {

        var rows = '<tr>';
        rows = rows + '<th> Código </th>';
        rows = rows + '<th> Nome da Empresa </th>';
        rows = rows + '<th width="200px">Ação</th>'
        rows = rows + '</tr>'
        $("thead").html(rows);
    }
    /*function createForm() {

        var html = '';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="nome_emp">Nome da Empresa</label>';
        html = html + '<input type="text" name="nome_emp" class="form-control" data-error="Por favor, insira o nome da empresa." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="senha">Senha</label>';
        html = html + '<input type="password" name="senha" class="form-control" data-error="Por favor, insira a senha." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="sede_emp">Sede</label>';
        html = html + '<input type="text" name="sede_emp" class="form-control" data-error="Por favor, insira o código da sede." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="areaat_emp">Área de Atuação</label>';
        html = html + '<select name="areaat_emp" id="cod_area" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="email_emp">E-mail</label>';
        html = html + '<input type="text" name="email_emp" class="form-control" data-error="Por favor, insira o email da empresa." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="desc_emp">Descrição</label>';
        html = html + '<textarea name="desc_emp" class="form-control" data-error="Por favor, insira a descrição da empresa." required></textarea>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="site_emp">Site</label>';
        html = html + '<input type="text" name="site_emp" class="form-control"></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="tel_emp">Telefone</label>';
        html = html + '<input type="text" name="tel_emp" class="form-control" data-error="Por favor, insira o telefone da empresa." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cnpj_emp">CNPJ</label>';
        html = html + '<input type="text" name="cnpj_emp" class="form-control" data-error="Por favor, insira o CNPJ da empresa." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit btn-success">Cadastrar</button>';
        html = html + '</div>';
        $("#create-item").find("form").html(html);
    }
    function createEditForm() {

        var html = '<input type="hidden" name="cod" class="edit-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="nome_emp">Nome da Empresa</label>';
        html = html + '<input type="text" name="nome_emp" class="form-control" data-error="Por favor, insira o nome da empresa." required />';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="senha">Senha</label>';
        html = html + '<input type="password" name="senha" class="form-control" data-error="Por favor, insira a senha." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="sede_emp">Sede</label>';
        html = html + '<input type="text" name="sede_emp" class="form-control" data-error="Por favor, insira o código da sede." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="areaat_emp">Área de Atuação</label>';
        html = html + '<select id="cod_area_edit" name="areaat_emp" class="form-control"></select>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="email_emp">E-mail</label>';
        html = html + '<input type="text" name="email_emp" class="form-control" data-error="Por favor, insira o email da empresa." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="desc_emp">Descrição</label>';
        html = html + '<textarea name="desc_emp" class="form-control" rows="4" data-error="Por favor, insira a descrição da empresa." required></textarea>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="site_emp">Site</label>';
        html = html + '<input type="text" name="site_emp" class="form-control"></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="tel_emp">Telefone</label>';
        html = html + '<input type="text" name="tel_emp" class="form-control" data-error="Por favor, insira o telefone da empresa." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cnpj_emp">CNPJ</label>';
        html = html + '<input type="text" name="cnpj_emp" class="form-control" data-error="Por favor, insira o CNPJ da empresa." required></input>';
        html = html + '<div class="help-block with-errors"></div>';
        html = html + '</div>';
        html = html + '<button type="submit" class="btn crud-submit-edit btn-success">Salvar</button>';
        html = html + '</div>';
        $("#edit-item").find("form").html(html);

    }*/

    function createViewForm() {

        var html = '<input type="hidden" name="cod" class="view-id">';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cod_emp">Código da Empresa</label>';
        html = html + '<input type="text" name="cod_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="nome_emp">Nome da Empresa</label>';
        html = html + '<input type="text" name="nome_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="senha">Senha</label>';
        html = html + '<input type="password" name="senha" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="sede_emp">Sede</label>';
        html = html + '<input type="text" name="sede_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="areaat_emp">Área de Atuação</label>';
        html = html + '<select id="cod_area_view" name="areaat_emp" class="form-control" disabled></select>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="desc_emp">Descrição</label>';
        html = html + '<textarea name="desc_emp" class="form-control" rows="4" readonly></textarea>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="email_emp">E-mail</label>';
        html = html + '<input type="text" name="email_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="site_emp">Site</label>';
        html = html + '<input type="text" name="site_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="tel_emp">Telefone</label>';
        html = html + '<input type="text" name="tel_emp" class="form-control" readonly/>';
        html = html + '</div>';
        html = html + '<div class="form-group">';
        html = html + '<label class="control-label" for="cnpj_emp">CNPJ</label>';
        html = html + '<input type="text" name="cnpj_emp" class="form-control" readonly/>';
        html = html + '</div>';
        $("#view-item").find("form").html(html);

    }

    $(".crud-submit").click(function (e) {
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var nome_emp = $("#create-item").find("input[name='nome_emp']").val();
        var senha = $("#create-item").find("input[name='senha']").val();
        var sede_emp = $("#create-item").find("input[name='sede_emp']").val();
        var areaat_emp = $("#create-item").find("select[name='areaat_emp']").val();
        var desc_emp = $("#create-item").find("textarea[name='desc_emp']").val();
        var email_emp  = $("#create-item").find("input[name='email_emp']").val();
        var site_emp  = $("#create-item").find("input[name='site_emp']").val();
        var tel_emp  = $("#create-item").find("input[name='tel_emp']").val();
        var cnpj_emp  = $("#create-item").find("input[name='cnpj_emp']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: {cod_emp: cod_emp, nome_emp: nome_emp, senha: senha, sede_emp: sede_emp, areaat_emp: areaat_emp, desc_emp: desc_emp, email_emp: email_emp, site_emp: site_emp, tel_emp: tel_emp, cnpj_emp: cnpj_emp}
        }).done(function (data) {

            $("#create-item").find("input[name='nome_emp']").val('');
            $("#create-item").find("input[name='senha']").val('');
            $("#create-item").find("input[name='sede_emp']").val('');
            $("#create-item").find("select[name='areaat_emp']").val('');
            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', {timeOut: 5000});

        });

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: {cod_usuario: cod_usuario, email:email, senha:senha, cargo:cargo}
        }).done(function (data) {

            $("#create-item").find("input[name='nome_emp']").val('');
            $("#create-item").find("input[name='senha']").val('');
            $("#create-item").find("input[name='sede_emp']").val('');
            $("#create-item").find("select[name='areaat_emp']").val('');
            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', {timeOut: 5000});

        });

    });
    $("body").on("click", ".edit-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_emp = dataCon[index].cod_emp;
        var nome_emp = dataCon[index].nome_emp;
        var senha = dataCon[index].senha;
        var sede_emp = dataCon[index].sede_emp;
        var areaat_emp = dataCon[index].areaat_emp;
        var desc_emp = dataCon[index].desc_emp;
        var email_emp  = dataCon[index].email_emp;
        var site_emp  = dataCon[index].site_emp;
        var tel_emp  = dataCon[index].tel_emp;
        var cnpj_emp  = dataCon[index].cnpj_emp;

        $("#edit-item").find("input[name='cod_emp']").val(cod_emp);
        $("#edit-item").find("input[name='nome_emp']").val(nome_emp);
        $("#edit-item").find("input[name='senha']").val(senha);
        $("#edit-item").find("input[name='sede_emp']").val(sede_emp);
        $("#edit-item").find("select[name='areaat_emp']").val(areaat_emp);
        $("#edit-item").find("textarea[name='desc_emp']").val(desc_emp);
        $("#edit-item").find("input[name='email_emp']").val(email_emp);
        $("#edit-item").find("input[name='site_emp']").val(site_emp);
        $("#edit-item").find("input[name='tel_emp']").val(tel_emp);
        $("#edit-item").find("input[name='cnpj_emp']").val(cnpj_emp);
    });

    $("body").on("click", ".view-item", function () {
        var index = $(this).parent("td").data('id');

        var cod_emp = dataCon[index].cod_emp;
        var nome_emp = dataCon[index].nome_emp;
        var senha = dataCon[index].senha;
        var sede_emp = dataCon[index].sede_emp;
        var areaat_emp = dataCon[index].areaat_emp;
        var desc_emp = dataCon[index].desc_emp;
        var email_emp  = dataCon[index].email_emp;
        var site_emp  = dataCon[index].site_emp;
        var tel_emp  = dataCon[index].tel_emp;
        var cnpj_emp  = dataCon[index].cnpj_emp;

        $("#view-item").find("input[name='cod_emp']").val(cod_emp);
        $("#view-item").find("input[name='nome_emp']").val(nome_emp);
        $("#view-item").find("input[name='senha']").val(senha);
        $("#view-item").find("input[name='sede_emp']").val(sede_emp);
        $("#view-item").find("select[name='areaat_emp']").val(areaat_emp);
        $("#view-item").find("textarea[name='desc_emp']").val(desc_emp);
        $("#view-item").find("input[name='email_emp']").val(email_emp);
        $("#view-item").find("input[name='site_emp']").val(site_emp);
        $("#view-item").find("input[name='tel_emp']").val(tel_emp);
        $("#view-item").find("input[name='cnpj_emp']").val(cnpj_emp);
    });

    $(".crud-submit-edit").click(function (e) {

        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");

        var nome_emp = $("#edit-item").find("input[name='nome_emp']").val();
        var senha = $("#edit-item").find("input[name='senha']").val();
        var sede_emp = $("#edit-item").find("input[name='sede_emp']").val();
        var areaat_emp = $("#edit-item").find("select[name='areaat_emp']").val();
        var desc_emp = $("#edit-item").find("textarea[name='desc_emp']").val();
        var email_emp  = $("#edit-item").find("input[name='email_emp']").val();
        var site_emp  = $("#edit-item").find("input[name='site_emp']").val();
        var tel_emp  = $("#edit-item").find("input[name='tel_emp']").val();
        var cnpj_emp  = $("#edit-item").find("input[name='cnpj_emp']").val();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: {cod_emp: cod_emp, nome_emp: nome_emp, senha: senha, sede_emp: sede_emp, areaat_emp: areaat_emp, desc_emp: desc_emp, email_emp: email_emp, site_emp: site_emp, tel_emp: tel_emp, cnpj_emp: cnpj_emp}

        }).done(function (data) {

            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg, 'Alerta de Sucesso', {timeOut: 5000});
        });


    });

    function getDataSelect() {

        $.ajax({
            dataType: 'json',
            url: 'get/getAreaat.php',
            data: {}
        }).done(function (data) {

            var htmlSelect = '';
            $.each(data.data, function (key, value) {
                htmlSelect = htmlSelect + '<option value="' + value.cod_area + '"> ' + value.desc_area + '</option>';
            });
            $("#cod_area").html(htmlSelect);
            $("#cod_area_edit").html(htmlSelect);
            $("#cod_area_view").html(htmlSelect);

        });
    }

});
