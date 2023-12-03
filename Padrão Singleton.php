<?php
//Padrão Singleton
class RegistroUsuarios {
    private static $instancia;
    private $usuarios = [];

    private function __construct() {
    }

    public static function obterInstancia(): RegistroUsuarios {
        if (!isset(self::$instancia)) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function adicionarUsuario($nome, $email) {
        $this->usuarios[$email] = $nome;
        echo "Usuário $nome adicionado com o email $email.<br>";
    }

    public function listarUsuarios() {
        echo "Lista de usuários registrados:<br>";
        foreach ($this->usuarios as $email => $nome) {
            echo "Nome: $nome, Email: $email<br>";
        }
    }
}

$registro = RegistroUsuarios::obterInstancia();

$registro->adicionarUsuario("João", "joao@example.com");
$registro->adicionarUsuario("Maria", "maria@example.com");

$registro->listarUsuarios();
?>