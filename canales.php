<?php

class Canales{
    private $tipo_canal;
    private $importe;
    private $esHd;
    private $refCliente;

    //construct
    public function __construct( $tipo_canal,  $importe,  $esHd,  $refCliente){$this->tipo_canal = $tipo_canal;$this->importe = $importe;$this->esHd = $esHd;$this->refCliente = $refCliente;}
	
    //getters
    public function getTipoCanal() {return $this->tipo_canal;}

	public function getImporte() {return $this->importe;}

	public function getEsHd() {return $this->esHd;}

	public function getRefCliente() {return $this->refCliente;}

    //setters
	public function setTipoCanal( $tipo_canal): void {$this->tipo_canal = $tipo_canal;}

	public function setImporte( $importe): void {$this->importe = $importe;}

	public function setEsHd( $esHd): void {$this->esHd = $esHd;}

	public function setRefCliente( $refCliente): void {$this->refCliente = $refCliente;}

    public function __toString(){
    return
        "Tipo Canal: " . $this->getTipoCanal() . 
        ", Importe: " . $this->getImporte() . 
        ", HD: " . ($this->getEsHd() ? "Sí" : "No") . 
        ", Cliente: " . $this->getRefCliente();
}
}