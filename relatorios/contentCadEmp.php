<page backcolor="#FEFEFE" backtop="0" backbottom="30mm" footer="date;time;page" style="fontsize: 12pt">
    <bookmark title="Lettre" level="0"></bookmark>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 25%;">
            </td>
            <td style="width: 50%; color: #111199; font-size: 16pt; font-weight: bold;">
                Relatório de Cadastro de Empresa
            </td>
            <td style="width: 25%;"></td>
        </tr>
    </table>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 12pt;">
        <thead>
            <tr style="font-size: 14pt; font-weight: bold; border-spacing: 100pt;">
                <td style="width:25%;"></td>
                <td style="width:40%;">Empresa</td>
                <td style="width:15%">Data do Cadastro</td>
            </tr>
        </thead>
        <br>
        <br>
        <tbody>
            <?php
            include './bd/conn.php';
            $sql = "SELECT cod_emp, nome_emp, DATE_FORMAT(data_registro_emp, '%d-%m-%Y') as data_registro FROM empresa ORDER BY data_registro_emp";
            $result = $conn->query($sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $conn->close();
            foreach ($rows as $linha) {
                ?>
                <tr>
                    <td style="width:25%;">
                        <barcode dimension="1D" type="S25" value="<?php echo $linha['cod_emp'] ?>" label="label"
                            style="width:25mm; height:6mm; color: #0000FF; font-size: 4mm" />
                    </td>
                    <td style="width:4%;"><?php echo $linha['nome_emp'] ?></td>
                    <td style="width:15%"><?php echo $linha['data_registro'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <br>
</page>