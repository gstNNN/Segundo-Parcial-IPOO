<?php

class EmpresaCable{
    private $planes;
    private $canales;
    private $clientes;
    private $contratos;

    public function __construct( $planes = [],  $canales = [],  $clientes = [],  $contratos = [])
    {$this->planes = $planes;$this->canales = $canales;$this->clientes = $clientes;$this->contratos = $contratos;}
	
    public function getPlanes() {return $this->planes;}

	public function getCanales() {return $this->canales;}

	public function getClientes() {return $this->clientes;}

	public function getContratos() {return $this->contratos;}

	public function setPlanes( $planes): void {$this->planes = $planes;}

	public function setCanales( $canales): void {$this->canales = $canales;}

	public function setClientes( $clientes): void {$this->clientes = $clientes;}

	public function setContratos( $contratos): void {$this->contratos = $contratos;}


    public function incorporarPlan($nuevoPlan){
        $seIncorporo = true;
        $planes = $this->getPlanes();
        foreach($planes as $planExistente){
            if($planExistente->getIncluyeMG() == $nuevoPlan->getIncluyeMG() && count($nuevoPlan->getCanales()) == count($planExistente->getCanales())){
                $seIncorporo = false;
            }
        }
        if($seIncorporo){
            $this->planes[] = $nuevoPlan;
        }
        return $seIncorporo;
    }

    public function buscarContrato($tipo_doc, $num_doc){
        $tiene = null;
        $i = 0;
        $cantidad = count($this->getClientes());
        $clientes = $this->getClientes();
        while($i < $cantidad && !$tiene){
            if($clientes[$i]->getTipoDoc() == $tipo_doc && $clientes[$i]->getNumDoc() == $num_doc){
                $tiene = $clientes[$i]->getContrato(); //verificar el get contrato
            }
            $i++;
        }
        return $tiene;
    }

    public function incorporarContrato($plan, $refCliente, $inicio, $vencimiento, $tipo_contrato){
        //Si tipo_contrato es true es via web
        foreach($this->getContratos() as $contrato){
            if($refCliente == $contrato->getRefCliente() && $contrato->getEstado() != "finalizado"){
                $contrato->setEstado("finalizado");
                }
            } 
            $cod_contrato = uniqid();
            if($tipo_contrato == true){
                $incorporo = new ContratoWeb($inicio, $vencimiento, $plan, "activo", 0, "si", $refCliente, 0.10, $cod_contrato);
            } else {
                $incorporo = new Contrato($inicio, $vencimiento, $plan, "activo", 0, "si", $refCliente, $cod_contrato);
            }
        $importe = $incorporo->calcularImporte();
        $incorporo->setCosto($importe);
        $this->contratos[] = $incorporo;
        }
        //Segun el enunciado no retorno nada?

        public function retornarPromImporteContratos($cod_plan){
            $cantidad_acumulador = 0;
            $total_importes = 0;
            foreach($this->getContratos() as $contrato){
                if($contrato->getPlan()->getCodigo() == $cod_plan){
                    $cantidad_acumulador++;
                    $total_importes += $contrato->getCosto();
                }
            }
            $promedio = $total_importes / $cantidad_acumulador;
            return $promedio;
        }

        public function pagarContrato($cod_contrato){
            $importe_pagar = 0;
            $cant_contratos = count($this->getContratos());
            $i = 0;
            $encontrado = false;
            $contrato = $this->getContratos();
            while($i < $cant_contratos && !$encontrado){
                if($contrato[$i]->getCod_Contrato() == $cod_contrato){
                    $importe_pagar = $contrato[$i]->calcularImporte();
                    $encontrado = true;
            }
            $i++;
            }
            return $importe_pagar;
        }
}
