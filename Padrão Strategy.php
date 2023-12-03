<?php
//Padrão Strategy
interface EstrategiaOrdenacao {
    public function ordenar(array $lista): array;
}

class BubbleSort implements EstrategiaOrdenacao {
    public function ordenar(array $lista): array {
        $tamanho = count($lista);
        for ($i = 0; $i < $tamanho - 1; $i++) {
            for ($j = 0; $j < $tamanho - $i - 1; $j++) {
                if ($lista[$j] > $lista[$j + 1]) {
                    $temp = $lista[$j];
                    $lista[$j] = $lista[$j + 1];
                    $lista[$j + 1] = $temp;
                }
            }
        }
        return $lista;
    }
}

class QuickSort implements EstrategiaOrdenacao {
    public function ordenar(array $lista): array {
        $this->quickSort($lista, 0, count($lista) - 1);
        return $lista;
    }

    private function quickSort(&$lista, $esquerda, $direita) {
        if ($esquerda < $direita) {
            $indicePivo = $this->particionar($lista, $esquerda, $direita);
            $this->quickSort($lista, $esquerda, $indicePivo - 1);
            $this->quickSort($lista, $indicePivo + 1, $direita);
        }
    }

    private function particionar(&$lista, $esquerda, $direita) {
        $pivo = $lista[$direita];
        $i = ($esquerda - 1);
        for ($j = $esquerda; $j < $direita; $j++) {
            if ($lista[$j] < $pivo) {
                $i++;
                $temp = $lista[$i];
                $lista[$i] = $lista[$j];
                $lista[$j] = $temp;
            }
        }
        $temp = $lista[$i + 1];
        $lista[$i + 1] = $lista[$direita];
        $lista[$direita] = $temp;

        return ($i + 1);
    }
}

class Ordenador {
    private $estrategia;

    public function __construct(EstrategiaOrdenacao $estrategia) {
        $this->estrategia = $estrategia;
    }

    public function setEstrategia(EstrategiaOrdenacao $estrategia) {
        $this->estrategia = $estrategia;
    }

    public function ordenarLista(array $lista): array {
        return $this->estrategia->ordenar($lista);
    }
}

$lista = [8, 3, 1, 5, 9, 2, 6, 4, 7];
$ordenador = new Ordenador(new BubbleSort());
echo "Lista original: " . implode(", ", $lista) . "<br>";

$ordenadaBubbleSort = $ordenador->ordenarLista($lista);
echo "Lista ordenada com Bubble Sort: " . implode(", ", $ordenadaBubbleSort) . "<br>";

$ordenador->setEstrategia(new QuickSort());
$ordenadaQuickSort = $ordenador->ordenarLista($lista);
echo "Lista ordenada com Quick Sort: " . implode(", ", $ordenadaQuickSort) . "<br>";
?>