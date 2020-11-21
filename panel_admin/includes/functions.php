<?php 
	date_default_timezone_set('America/Bogota'); 
	
	function fechaC(){
		
 
		$diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		 
		return $diassemana[date('N')+1]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')." " ;
	   
		 
		
	}


 ?>