<?php
//Padrão Decorator
interface Relatoriointerface {
    public function gerar();
}

class Relatoriosimples implements Relatoriointerface {
    public function gerar() {
        return "Relatório simples gerado.";
    }
}

abstract class Decorator implements Relatoriointerface {
    protected $relatorio;

    public function __construct(Relatoriointerface $relatorio) {
        $this->relatorio = $relatorio;
    }

    public function gerar() {
        return $this->relatorio->gerar();
    }
}

class FormatacaoCaixaAlta extends Decorator {
    public function gerar() {
        $relatorio = parent::gerar();
        return strtoupper($relatorio);
    }
}

class AdicionarData extends Decorator {
    public function gerar() {
        $relatorio = parent::gerar();
        return $relatorio . " Data: " . date("Y-m-d");
    }
}

$relatorioSimples = new Relatoriosimples();

$relatorioDecorado = new Adicionardata(new FormatacaocaixaAlta($relatoriosimples));

echo $relatorioDecorado->gerar();
?>