<?php
class Usuario
{
    private $cod_usuario;
    private $email;
    private $senha;
    private $cargo;

    public function __construct($cod_usuario, $email, $senha, $cargo)
    {
        $this->cod_usuario = $cod_usuario;
        $this->email = $email;
        $this->senha = $senha;
        $this->cargo = $cargo;
    }

    public function validaEmailSenha($email, $senha)
    {
        return $this->email === $email && $this->senha === $senha;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function getCodUsuario()
    {
        return $this->cod_usuario;
    }
}
?>