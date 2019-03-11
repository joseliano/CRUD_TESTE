<?php
interface acaoBanco {
	
 public function Conecta();		
 public function salvaRegistro();
 public function excluirRegistro($tabela,$id );
 public function updateRegistro( $id );
 public function execQuery($qSql);
 public function listarRegistro($tabela);
 public function detalheRegistro($tabela, $id );
}


?>