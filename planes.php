<?php

class Planes{
    private $codigo;
    private $canales;
    private $importe;
    private $incluyeMG;

    public function __construct( $codigo,  $importe,  $canales = [], $incluyeMG = 100){$this->codigo = $codigo;$this->canales = $canales;$this->importe = $importe;$this->incluyeMG = $incluyeMG;}
	
    public function getCodigo() {return $this->codigo;}

	public function getCanales() {return $this->canales;}

	public function getImporte() {return $this->importe;}

	public function getIncluyeMG() {return $this->incluyeMG;}

	public function setCodigo( $codigo): void {$this->codigo = $codigo;}

	public function setCanales( $canales): void {$this->canales = $canales;}

	public function setImporte( $importe): void {$this->importe = $importe;}

	public function setIncluyeMG( $incluyeMG): void {$this->incluyeMG = $incluyeMG;}

	
}