<?php
//Padrão Observer
interface Observador {
    public function receberNotificacao(string $mensagem);
}

class Notificador {
    private $observadores = [];

    public function adicionarObservador(Observador $observador) {
        $this->observadores[] = $observador;
    }

    public function removerObservador(Observador $observador) {
        $indice = array_search($observador, $this->observadores);
        if ($indice !== false) {
            unset($this->observadores[$indice]);
        }
    }

    public function notificarObservadores(string $mensagem) {
        foreach ($this->observadores as $observador) {
            $observador->receberNotificacao($mensagem);
        }
    }

    public function enviarMensagem(string $mensagem) {
        echo "Mensagem enviada: $mensagem<br>";
        $this->notificarObservadores($mensagem);
    }
}

class Assinante implements Observador {
    private $nome;

    public function __construct(string $nome) {
        $this->nome = $nome;
    }

    public function receberNotificacao(string $mensagem) {
        echo "Assinante $this->nome recebeu a seguinte notificação: $mensagem<br>";
    }
}

$notificador = new Notificador();

$assinante1 = new Assinante("Alice");
$assinante2 = new Assinante("Bob");

$notificador->adicionarObservador($assinante1);
$notificador->adicionarObservador($assinante2);

$notificador->enviarMensagem("Nova atualização disponível!");

$notificador->removerObservador($assinante1);

$notificador->enviarMensagem("Outra atualização importante!");
?>