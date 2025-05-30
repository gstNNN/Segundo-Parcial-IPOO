<?php

class ContratoWeb extends Contrato{
    private $descuento;

    //construct
    public function __construct($inicio, $vencimiento, $plan, $estado, $costo, $renovo, $refCliente, $cod_contrato, $descuento = 0.10) {
        parent::__construct($inicio, $vencimiento, $plan, $estado, $costo, $renovo, $refCliente, $cod_contrato);
        $this->descuento = $descuento;
    }
    
    //gett
	public function getDescuento() {return $this->descuento;}

    //set
	public function setDescuento( $descuento): void {$this->descuento = $descuento;}

    public function __toString()
    {
        $cadena = parent::__toString();
        $cadena .= "\nPorcentaje de Descuento: " . ($this->getDescuento() * 100) . "%\n";
        return $cadena;
    }

    public function calcularImporte(){
        $importe = parent::calcularImporte();
        $importe_descuento = $importe * (1 - $this->getDescuento());
        return $importe_descuento;
    }

}
