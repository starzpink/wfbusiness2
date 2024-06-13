<?php
session_start();
$cod_emp = $_SESSION['cod_emp'];

include './bd/conn.php';
?>
<page backcolor="#FEFEFE" backtop="0" backbottom="30mm" footer="date;time;page" style="fontsize: 12pt">
    <bookmark title="Lettre" level="0"></bookmark>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 25%;">
            </td>
            <td style="width: 50%; color: #111199; font-size: 16pt; font-weight: bold;">
                Relatório de Vagas Fechadas
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
                <td style="width:40%;">Título da Vaga</td>
                <td style="width:15%">Situação</td>
            </tr>
        </thead>
        <br>
        <br>
        <tbody>
            <?php
            $sql = "SELECT cod_vaga, titulo_vaga, situacao_vaga FROM vaga WHERE situacao_vaga = 'Fechada' and cod_emp=" . $cod_emp . " ORDER BY cod_vaga";
            $result = $conn->query($sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $conn->close();
            foreach ($rows as $linha) {
                ?>
                <tr>
                    <td style="width:25%;">
                        <barcode dimension="1D" type="S25" value="<?php echo $linha['cod_vaga'] ?>" label="label"
                            style="width:25mm; height:6mm; color: #0000FF; font-size: 4mm" />
                    </td>
                    <td style="width:4%;"><?php echo $linha['titulo_vaga'] ?></td>
                    <td style="width:15%"><?php echo $linha['situacao_vaga'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <br>
</page>