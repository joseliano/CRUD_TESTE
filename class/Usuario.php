<?php

class Usuario  extends  Conexao {
	 
	private $nome;
	private $dtNascimento;
	private $email;
	private $Uf;
	private $localidade; 
	private $idCliente;
 
	
	function __construct(){
		  
		$a = func_get_args();
		$i = func_num_args();
		
		if (method_exists($this,$f='__construct'.$i)) {
			call_user_func_array(array($this,$f),$a);
		}
	}
	
	 
		 
	function __construct6(			  
			  $nome,
			  $dtNascimento,
			  $email,
			  $Uf,
			  $localidade,
			  $idCliente=null){			
		
			$this->nome = $nome;
			$this->dtNascimento = $dtNascimento;
			$this->email = $email;
			$this->Uf = $Uf;
			$this->localidade = $localidade;	
			$this->idCliente = $idCliente;	
			
	}
	
	public function  excluir($id){		
		return	$this->excluirRegistro($this , $id);
	}
	
	
	public function  salvar(){		
		$sql =  "INSERT INTO  usuario (nome,dtnascimento,email,id_localidade,UF) VALUES ('$this->nome', '$this->dtNascimento', '$this->email', '$this->localidade', '$this->Uf'   ) "; 
		$this->execQuery($sql); 
		return  mysql_insert_id();
	}
	
	public function  alterar(){	
			$sql =  "UPDATE 
						usuario
						SET
						nome = '$this->nome',
						dtnascimento = '$this->dtNascimento',
						email = '$this->email',
						id_localidade = '$this->localidade',
						UF = '$this->Uf' 
						WHERE `idcliente` = '$this->idCliente'" ;
						
		return	$this->execQuery($sql); 
	}
	
	
	public function  listarUsuario(){	 
		return	$this->listarRegistro($this);
	}
	
	public function  consultarUsuario($id){ 
		return	$this->DetalheRegistro($this , $id);
	}
}
