<?php

class Localidade  extends  Conexao {
			 
	function listarLocalidade ($uf){
		return	$this->execQuery("select * from localidade where uf=\"" .$uf. "\" order  by nome");
	}
	
}
