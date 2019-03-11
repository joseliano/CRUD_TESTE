<?php
class Conexao implements acaoBanco
{
	private $host = DB_HOST;  
	private $user = DB_USER;  
	private $password =DB_PASSWORD;  
	private $database = DB_BASE;  
	
 	private $qSql = "";
	private $link = "";  	
	private $coluna = "";
	private $tabela;
	 
	
	function Conexao(){
		 
	}

	function Conecta(){

		$this->link = mysql_connect($this->host,$this->user,$this->password);

		if (!$this->link){
			die("Problema na Conexão com o Banco de Dados");
		}elseif (!mysql_select_db($this->database,$this->link)){
			die("Problema na Conexão com o Banco de Dados");
		}

	}

	function Desconecta(){
		return mysql_close($this->link);
	}
 
	public function salvaRegistro(){}
	
	public function excluirRegistro( $obj, $id, $colunaWhere=null ){
		$this->tabela = get_class($obj);
		$this->Conecta();
	
		if (!empty($colunaWhere) && isset($colunaWhere) ) {
			$this->coluna  = $colunaWhere;	
		}else{
			$this->coluna  = $this->showColum($this->tabela);	
		}
		
		$this->qSql = " DELETE FROM $this->tabela where $this->coluna='$id' " ; 
	 
		try{
			if ($resultado = mysql_query($this->qSql,$this->link)){
				return $resultado;
			} else {
				return 0;
			}
		
		} catch (Exception $e) {
			return "Houve um erro na String";
		
		}
		
		$this->Desconecta();
	}
	public function updateRegistro( $id ){}
	
	public function execQuery($qSql){
		
		$this->Conecta();
		
		$this->qSql = $qSql;
		try{
			if ($resultado = mysql_query($this->qSql,$this->link)){
				return $resultado;
			} else {
				return 0;
			}
				
		} catch (Exception $e) {
			return "Houve um erro na String";
			 
		}
		
		$this->Desconecta(); 
	}
	
	public function listarRegistro($obj){
	
		$this->tabela = get_class($obj);
 		
		$this->Conecta();	
		
		$this->qSql = "select * from $this->tabela";
	 
		try{
			if ($resultado = mysql_query($this->qSql,$this->link)){
				return $resultado;
			} else {
				return 0;
			}
	
		} catch (Exception $e) {
			return "Houve um erro na String";
	
		}
	
		$this->Desconecta();
	}
	
	public function detalheRegistro($obj,$id,$colunaWhere=null){
		$this->tabela = get_class($obj);			
		$this->Conecta();	

		if (!empty($colunaWhere) && isset($colunaWhere) ) {
			$this->coluna  = $colunaWhere;	
		}else{
			$this->coluna  = $this->showColum($this->tabela);	
		}
		
		$this->qSql = "Select * FROM $this->tabela where $this->coluna='$id' " ; 
	
		try{
			$resultado = array();
			if ($res= mysql_query($this->qSql,$this->link)){
				 	 while($row = mysql_fetch_assoc($res)){
						 
						//echo $row[0];
				 	  $resultado[] = $row;
						//$resultado[] =  $row['idcliente'];
				
				 }
				return  json_encode($resultado);
			} else {
				return 0;
			}
		
		} catch (Exception $e) {
			return "Houve um erro na String";
		
		}
		
		$this->Desconecta();
	
	}
	
	private function showColum($tabela){
	
		$this->qSql = "	SELECT COLUMN_NAME FROM information_schema.COLUMNS 
						WHERE TABLE_SCHEMA = '".$this->database."'
						  AND TABLE_NAME = '$tabela'
						  AND COLUMN_KEY ='PRI'" ; 
 
		$this->Conecta();
		
		$resultado = mysql_query($this->qSql,$this->link);
		 
		if(mysql_num_rows($resultado) > 0){
				
			while($row = mysql_fetch_assoc($resultado)) {
				return  $row['COLUMN_NAME'];
			}
				
		}
		
		$this->Desconecta();
		
	}
	
	

}