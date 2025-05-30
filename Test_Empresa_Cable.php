<?php

require_once 'cliente.php';
require_once 'canales.php';
require_once 'planes.php';
require_once 'contrato.php';
require_once 'contratoWeb.php';
require_once 'empresaCable.php';

$hoy = date("Y-m-d");
$vencimiento = date("Y-m-d", strtotime("+30 days"));

$objEmpresa = new EmpresaCable();

$canal1 = new Canales("Noticias", 8100, false, null);
$canal2 = new Canales("Deportes", 500, true, null);
$canal3 = new Canales("Infantiles", 200, true, null);

$plan1 = new Planes(111, 5000, [$canal1, $canal2]);
$plan2 = new Planes(222, 4500, [$canal2, $canal3]);

$cliente = new Cliente("dni", "46633234");

$contratoEmpresa = new Contrato($hoy, $vencimiento, $plan1, "activo", 0, false, $cliente, 1);
$contratoWeb1 = new ContratoWeb($hoy, $vencimiento, $plan1, "activo", 0, true, $cliente, 0.15, 2);
$contratoWeb2 = new ContratoWeb($hoy, $vencimiento, $plan2, "activo", 0, true, $cliente, 0.10, 3);

echo "Importe Empresa: " . $contratoEmpresa->calcularImporte() . "\n";
echo "Importe Web 1: " . $contratoWeb1->calcularImporte() . "\n";
echo "Importe Web 2: " . $contratoWeb2->calcularImporte() . "\n";

$objEmpresa->incorporarPlan($plan1);
$objEmpresa->incorporarPlan($plan2);

$objEmpresa->incorporarContrato($plan1, $cliente, $hoy, $vencimiento, false);
$objEmpresa->incorporarContrato($plan2, $cliente, $hoy, $vencimiento, true);

$contratos = $objEmpresa->getContratos();
$contratoEmpresa = $contratos[0];
$contratoWeb = $contratos[1];

$importeEmpresa = $objEmpresa->pagarContrato($contratoEmpresa->getCod_Contrato());
echo "Pago contrato (empresa): $" . $importeEmpresa . "\n";

$importeWeb = $objEmpresa->pagarContrato($contratoWeb->getCod_Contrato());
echo "Pago contrato (web): $" . $importeWeb . "\n";

$promedio = $objEmpresa->retornarPromImporteContratos(111);
echo "Promedio importe de contratos del plan 111: $" . $promedio . "\n";
