<?php
include ("../config.php");
if(isset($_POST)) {
	
$metodo = (isset($_POST['metodo'])) ? $_POST['metodo'] : '';  
   
	 	
	if($metodo == "delet"){
		
		$usuarioTel = new UsuarioTelefone();
		$id = $_POST['id'];		
		$result = $usuarioTel->excluir ($id);		
	}	

	if($metodo == "detalhe"){
	
		$usuarioTel = new UsuarioTelefone();
		$id = $_POST['id'];
		$result = $usuarioTel->consultarContato ($id); 
		 
		echo $result;
	}

}
	
?>