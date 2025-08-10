<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    require_once APPPATH."/third_party/fpdf/fpdf.php";

    class Reporte extends FPDF {

        function Header() {
            $this->SetFont('Arial', 'B', 6.5);
            $this->Cell(160);
            $this->Cell(25, 5, 'SOFT. TECSUR', 1, 0, 'C');
			$this->Ln(3);
            $this->Cell(177);
            $this->Cell(5, 9, 'REPORTE', 0, 0, 'C');
            $this->Ln(3);
            $this->Cell(139);
            date_default_timezone_set('America/Lima');
            $date = date('d/m/Y h:i:s a', time());
            $this->Cell(0, 9, 'FECHA Y HORA : '.$date, 0);
            $this->Ln(20);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 0, utf8_decode('REPORTE DE INCIDENCIA - TECSUR'), 0, 0, 'C');
            $this->Ln(10);
        }

        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,'Pagina '.$this->PageNo().' - {nb}',0,0,'C');
        }

        var $widths;
        var $aligns;

        function SetWidths($w) {
            $this->widths=$w;
        }

        function SetAligns($a) {
            $this->aligns=$a;
        }

        function Row($data) {
            $nb=0;
            for($i=0;$i<count($data);$i++)
                $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
            $h=5*$nb;
            $this->CheckPageBreak($h);
            for($i=0;$i<count($data);$i++) {
                $w=$this->widths[$i];
                $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
                $x=$this->GetX();
                $y=$this->GetY();
                $this->Rect($x,$y,$w,$h);
                $this->MultiCell($w,5,$data[$i],0,$a);
                $this->SetXY($x+$w,$y);
            }
            $this->Ln($h);
        }

        function CheckPageBreak($h) {
            if($this->GetY()+$h>$this->PageBreakTrigger)
                $this->AddPage($this->CurOrientation);
        }

        function NbLines($w,$txt) {
            $cw=&$this->CurrentFont['cw'];
            if($w==0)
                $w=$this->w-$this->rMargin-$this->x;
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
            $s=str_replace("\r",'',$txt);
            $nb=strlen($s);
            if($nb>0 and $s[$nb-1]=="\n")
                $nb--;
            $sep=-1;
            $i=0;
            $j=0;
            $l=0;
            $nl=1;
            while($i<$nb) {
                $c=$s[$i];
                if($c=="\n") {
                    $i++;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                    continue;
                }
                if($c==' ')
                    $sep=$i;
                $l+=$cw[$c];
                if($l>$wmax) {
                    if($sep==-1) {
                        if($i==$j)
                            $i++;
                    }
                    else
                        $i=$sep+1;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                }
                else
                    $i++;
            }
            return $nl;
        }

        function informacion($response) {
			$x_estado = $response['x_estado'];
            $this->SetFont('Arial', '', 10);
            $this->Ln(5);
			$this->Cell(190,7,utf8_decode("FECHA DE REGISTRO: ".$response['f_registro']),0);
            $this->Ln(6);
            $this->Cell(190,7,utf8_decode("FECHA DE REPORTE: ".$response['f_reporte']),0);
            $this->Ln(6);
            $this->Cell(190,7,utf8_decode("ESTADO: ".$x_estado),0);
            $this->Ln(6);
            $this->Cell(190,7,utf8_decode("TIPO: ".$response['x_tipo_estandar']),0);
			$this->Ln(6);
			$this->Cell(190,7,utf8_decode("CATEGORÍA: ".$response['x_categoria']),0);
			$this->Ln(6);
			$this->Cell(190,7,utf8_decode("ÁREA QUE REGISTRA: ".$response['x_area_registra']),0);
			$this->Ln(6);
			$this->Cell(190,7,utf8_decode("ÁREA QUE ATIENDE: ".$response['x_area_atiende']),0);
			$this->Ln(6);
			$this->Cell(190,7,utf8_decode("USUARIO QUE REGISTRA: ".$response['x_usuario_registra']),0);
			$this->Ln(6);
			if ($x_estado != 'PENDIENTE') {
				$this->Cell(190,7,utf8_decode("USUARIO QUE ATIENDE: ".$response['x_usuario_atiende']),0);
				$this->Ln(6);
			}
			$this->Cell(190,7,utf8_decode("N° SST: ".$response['n_sst']),0);
			$this->Ln(6);
			$this->Cell(190,7,utf8_decode("UBICACIÓN: ".$response['x_ubicacion']),0);
			$this->Ln(6);
			$this->Cell(190,7,utf8_decode("ELEMENTO: ".$response['x_elemento']),0);
			$this->Ln(6);
			$this->MultiCell(190, 7, utf8_decode("DESCRIPCIÓN: ".$response['x_descripcion']), 0, 'L', 0);
			if ($x_estado != 'PENDIENTE') {
				$this->MultiCell(190, 7, utf8_decode("RECOMENDACIÓN: ".$response['x_recomendacion']), 0, 'L', 0);
			}
			$this->Ln(10);
			$this->Cell(190,7,'ARCHIVO ADJUNTO:',0);
			$this->Image('upload/'.$response['x_documento'], 10, 160, 150);
        }
    }

?>
