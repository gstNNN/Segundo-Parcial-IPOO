<?php

class Contrato{
    private $inicio;
    private $vencimiento;
    private $plan;
    private $estado;
    private $costo;
    private $renovo;
    private $refCliente;
    private $cod_contrato;

    //construct
    public function __construct( $inicio,  $vencimiento,  $plan,  $estado,  $costo,  $renovo,  $refCliente, $cod_contrato)
    {$this->inicio = $inicio;$this->vencimiento = $vencimiento;$this->plan = $plan;$this->estado = $estado;$this->costo = $costo;$this->renovo = $renovo;$this->refCliente = $refCliente; $this->cod_contrato = $cod_contrato;}
	
    //getters
    public function getInicio() {return $this->inicio;}

	public function getVencimiento() {return $this->vencimiento;}

	public function getPlan() {return $this->plan;}

	public function getEstado() {return $this->estado;}

	public function getCosto() {return $this->costo;}

	public function getRenovo() {return $this->renovo;}

	public function getRefCliente() {return $this->refCliente;}

	public function getCod_Contrato() {return $this->cod_contrato;}

    //setters
	public function setInicio( $inicio): void {$this->inicio = $inicio;}

	public function setVencimiento( $vencimiento): void {$this->vencimiento = $vencimiento;}

	public function setPlan( $plan): void {$this->plan = $plan;}

	public function setEstado( $estado): void {$this->estado = $estado;}

	public function setCosto( $costo): void {$this->costo = $costo;}

	public function setRenovo( $renovo): void {$this->renovo = $renovo;}

	public function setRefCliente( $refCliente): void {$this->refCliente = $refCliente;}

	public function setCod_Contrato( $cod_contrato): void {$this->cod_contrato = $cod_contrato;}

	public function __toString()
    {
        return
        "Inicio: " . $this->getInicio() . "\n" . 
        "Vencimiento: " . $this->getVencimiento() . "\n" . 
        "Plan: " . $this->getPlan() . "\n" . 
        "Estado: " . $this->getEstado() . "\n" . 
        "Costo: " . $this->getCosto() . "\n" . 
        "Renovo: " . ($this->getRenovo() ? "si" : "no") . "\n" . 
        "Cliente: " . $this->getRefCliente() . "\n" . 
        "Codigo Contrato : " . $this->getCod_Contrato() . "\n"; 
    }


    public function diasContratoVencido($contrato){
        $fechaVencimiento = new DateTime($contrato->getVencimiento());
        $hoy = new DateTime();
        $diferenciaDias = 0;

        if ($hoy > $fechaVencimiento) {
            $diferenciaDias = $fechaVencimiento->diff($hoy)->days;
        }
        return $diferenciaDias;
    }
    public function actualizarEstadoContrato(){
        $diasVencido = $this->diasContratoVencido($this);
        if($diasVencido > 0 && $diasVencido < 11){ //preguntar
            $estado = "moroso";
        } elseif($diasVencido > 10){
            $estado = "suspendido";
        } else {
            $estado = "al dia";
        }
        $this->setEstado($estado);
        return $estado;
    }   
    
    public function calcularImporte(){
        $importe = $this->getPlan()->getImporte();
        $canales = $this->getPlan()->getCanales();
        $importe_canales = 0;

        foreach($canales as $canal){
            $importe_canales += $canal->getImporte();
        }
        return $importe + $importe_canales;
    }
    
}

