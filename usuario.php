<?php

class Usuario {

    public $cod_usuario, $senha, $email, $cargo;

    function __construct($cod_usuario, $email, $senha,  $cargo) {
        $this->cod_usuario = $cod_usuario;
        $this->email = $email;
        $this->senha= $senha;
        $this->cargo = $cargo;
    }
    
    function validaEmailSenha($email, $senha) {
        // Verificar se o e-mail está correto
        if ($email == $this->email && $senha == $this->senha) {
                return true;
            }
    }
}

?>