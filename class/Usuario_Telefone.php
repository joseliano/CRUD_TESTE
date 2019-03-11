<?php

class UsuarioTelefone  extends  Conexao {
	  
	private $contatos ;	 
	private $idUsuario;
	private $idTelefone;
	
	function __construct(){
		  
		$a = func_get_args();
		$i = func_num_args();
		
		if (method_exists($this,$f='__construct'.$i)) {
			call_user_func_array(array($this,$f),$a);
		}
	}

	function __construct2(
			$contatos,
			$idUsuario ){			 
		$this->contatos = $contatos; 
		$this->idUsuario = $idUsuario ;			
	}
		 
	function __construct3(
			$contatos,
			$idUsuario,
			$idTelefone ){			

		$this->contatos = $contatos; 
		$this->idUsuario = $idUsuario;
		$this->idTelefone = $idTelefone;			
	}
	
	public function  excluir($id){		
		return	$this->excluirRegistro($this , $id, "id_usuario");
	}
	
	
	public function  salvar(){ 
 
		foreach ($this->contatos as $key=>$arrayTel) {
			foreach ($arrayTel as $data => $user_data)	{			 
				$telefone =$user_data["telefone"] ;
				$contato = $user_data["contato"];
				
				$sql =  "INSERT INTO  usuariotelefone (id_usuario,contato,numero_tel) VALUES ('$this->idUsuario', '$contato', '$telefone'  )"; 
				echo $sql . "<br>" ;
				$this->execQuery($sql); 
			}
		  
		}   
	}
	
	
	public function  listarContato(){	 
		return	$this->listarRegistro($this);
	}
	
	public function  consultarContato($id){  
		return	$this->DetalheRegistro($this , $id, "id_usuario");
	}
}
