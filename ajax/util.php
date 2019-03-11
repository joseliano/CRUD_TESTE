<?php
include ("../config.php");
      
 if(isset($_GET)) {

 	$metodo = (isset($_GET['metodo'])) ? $_GET['metodo'] : '';
 	 $data = "";
	 
  	 	
 	if ($metodo=="uf"){
	 	$uf = new UF();
	 	$result = $uf->listarUF ();
		
	 	if(mysql_num_rows($result) > 0)
	 	{
	 		$number = 1;
	 		$data .= '<select id="us_uf"  class="form-control" placeholder="UF" >';
	 		$data .= '<option> </option>';
	 		
	 		while($row = mysql_fetch_assoc($result))
	 		{
	 			$data .= '<option value="'.$row['UF'].'">'.$row['UF'].'</option>';
	 			
	 		}
	 		$data .= '</select>';
	 	}
 	
 	}else if ($metodo=="localidade"){
 		$idlocalidade =0;
 		if (isset($_GET["uf"])){  $uf = $_GET['uf'];	}
		if (isset($_GET["idlocalidade"])){  $idlocalidade = $_GET['idlocalidade'];	}
 		 		
 		$loc = new Localidade();
 		$result = $loc->listarLocalidade ($uf);
 		
 		if(mysql_num_rows($result) > 0)
 		{
 			$number = 1;
 			$data .= '<select id="us_localidade"  class="form-control" placeholder="Localidade" >';
 			$data .= '<option> </option>';
 		
 			while($row = mysql_fetch_assoc($result))
 			{
				if ($idlocalidade ==$row['id'] ) {
					$data .= '<option value="'.$row['id'].'" selected>'.$row['nome'].'</option>';
				}else{
					$data .= '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
				}
 				
 			 	
 			}
 			$data .= '</select>';
 		}  
 	}
  }	
	echo $data;
?>