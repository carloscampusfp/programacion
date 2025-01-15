<?php
class ConversorMoneda {
    private $dolaraeuro = 0.85;
    private $euroadolar = 1.18;

    public function convertirDolaresAEuros($dolares) {
        return $dolares * $this->dolaraeuro;
    }

    public function convertirEurosADolares($euros) {
        return $euros * $this->euroadolar;
    }
}

// Crear una instancia de la clase y realizar varias conversiones
$conversor = new ConversorMoneda();
echo "100 dólares son " . $conversor->convertirDolaresAEuros(100) . " euros.\n";
echo "100 euros son " . $conversor->convertirEurosADolares(100) . " dólares.\n";
