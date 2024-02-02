<?php 

require "vendor/autoload.php"; 

ob_start(); //(BUFFER de saida) fala pro php nao exibir esse conteudo que vem depois dela na pagina pois vai ter uma funcao para ele
    require_once('./conteudo-pdf.php');
$html = ob_get_clean(); //insere esse conteudo ja renderisado na variavel HTML

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();