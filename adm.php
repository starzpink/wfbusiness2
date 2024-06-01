<?php

class Adm {

    public $cod_adm, $nome_adm, $senha_adm, $email_adm, $tel_adm;

    function __construct($cod_adm, $nome_adm, $senha_adm, $email_adm, $tel_adm) {
        $this->cod_adm = $cod_adm;
        $this->nome_adm = $nome_adm;
        $this->email_adm = $email_adm;
        $this->senha_adm= $senha_adm;
        $this->tel_adm = $tel_adm;
    }
    
    function validaEmailSenha($email_adm, $senha_adm) {
        // Verificar se o e-mail está correto
        if ($email_adm == $this->email_adm && $senha_adm == $this->senha_adm) {
                return true;
            }
    }
}

?>