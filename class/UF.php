<?php
 
class UF  extends Conexao    {
	
	function listarUF (){		
		return	$this->listarRegistro($this);	
	}
	
}
