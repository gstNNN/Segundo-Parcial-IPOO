<?php

class Cliente{
    private $tipo_doc;
    private $num_doc;


    public function __construct( $tipo_doc,  $num_doc){$this->tipo_doc = $tipo_doc;$this->num_doc = $num_doc;}
	
    public function getTipoDoc() {return $this->tipo_doc;}

	public function getNumDoc() {return $this->num_doc;}

    public function setTipoDoc( $tipo_doc): void {$this->tipo_doc = $tipo_doc;}

	public function setNumDoc( $num_doc): void {$this->num_doc = $num_doc;}

	public function __toString()
    {
        return "tipo doc: " . $this->getTipoDoc() . "\n" . 
        "num doc: " . $this->getNumDoc() . "\n";
    }

}