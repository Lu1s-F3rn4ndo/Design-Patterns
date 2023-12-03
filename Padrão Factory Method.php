<?php
//Padrão Factory Method
interface FormaGeometrica {
    public function calcularArea(): float;
}

class Retangulo implements FormaGeometrica {
    private $largura;
    private $altura;

    public function __construct(float $largura, float $altura) {
        $this->largura = $largura;
        $this->altura = $altura;
    }

    public function calcularArea(): float {
        return $this->largura * $this->altura;
    }
}

class Circulo implements FormaGeometrica {
    private $raio;

    public function __construct(float $raio) {
        $this->raio = $raio;
    }

    public function calcularArea(): float {
        return pi() * $this->raio * $this->raio;
    }
}

interface FabricaFormas {
    public function criarForma(): FormaGeometrica;
}

class FabricaRetangulo implements FabricaFormas {
    private $largura;
    private $altura;

    public function __construct(float $largura, float $altura) {
        $this->largura = $largura;
        $this->altura = $altura;
    }

    public function criarForma(): FormaGeometrica {
        return new Retangulo($this->largura, $this->altura);
    }
}

// Factory Method para criar círculos
class FabricaCirculo implements FabricaFormas {
    private $raio;

    public function __construct(float $raio) {
        $this->raio = $raio;
    }

    public function criarForma(): FormaGeometrica {
        return new Circulo($this->raio);
    }
}

$fabricaRetangulo = new FabricaRetangulo(5, 10);
$retangulo = $fabricaRetangulo->criarForma();
echo "Área do retângulo: " . $retangulo->calcularArea() . "<br>";

$fabricaCirculo = new FabricaCirculo(7);
$circulo = $fabricaCirculo->criarForma();
echo "Área do círculo: " . $circulo->calcularArea() . "<br>";
?>
