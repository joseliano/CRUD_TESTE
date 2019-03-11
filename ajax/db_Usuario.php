<?php
include ("../config.php");
if(isset($_POST)) {
	
$metodo = (isset($_POST['metodo'])) ? $_POST['metodo'] : ''; 
$modulo = (isset($_POST['us_modulo'])) ? $_POST['us_modulo'] : ''; 
  
	if($metodo == "inup"){

			$us_nome 		 = $_POST['us_nome'];
			$us_dtNascimento = $_POST['us_dtNascimento'];
			$us_email 		 = $_POST['us_email'];
			$us_uf 			 = $_POST['us_uf'];
			$us_localidade 	 = $_POST['us_localidade'];
			$us_user_id 	 = $_POST['us_user_id'];			
			$us_telefone 	 = $_POST['us_telefone']; 
					
			parse_str($us_telefone,$new_data);
			 			
			$usuario = new Usuario(
					$us_nome ,
					$us_dtNascimento ,
					$us_email,
					$us_uf,
					$us_localidade,
					$us_user_id ); 
					
			if ($modulo=="in"){
				$retorno = $usuario->salvar ();
				
				$UsuarioTelefone = new UsuarioTelefone(
					$new_data ,
					$retorno ); 

				$result = $UsuarioTelefone->salvar (); 

			}else if ($modulo=="up"){
				$result = $usuario->alterar ();
				
				$UsuarioTelefone = new UsuarioTelefone();
				$result = $UsuarioTelefone->excluir ($us_user_id);

				$UsuarioTelefone = new UsuarioTelefone(
					$new_data ,
					$retorno ); 

			}
			echo $result; 
	}
	
	if($metodo == "list"){
			$usuario = new Usuario();			
			$result  = $usuario->listarUsuario ();
			
			$data = '<table class="table table-bordered table-striped">
							<tr>
								<th>#</th>
								<th>Nome</th>
								<th>Dt Nascimento</th>
								<th>Email</th>
								<th>#</th>
								<th>#</th>
							</tr>';
			
			if(mysql_num_rows($result) > 0)	{
			
				while($row = mysql_fetch_assoc($result)){
					$data .= '<tr>
					<td>'.$row['idcliente'].'</td>
					<td>'.$row['nome'].'</td>
					<td>'.$row['dtnascimento'].'</td>
					<td>'.$row['email'].'</td>
					<td>
						<button onclick="Jpascript.detalheRegistro('.$row['idcliente'].')" 
						 class="btn btn-warning" 					
						>Alterar</button>
					</td>
					<td>
						<button onclick="Jpascript.delRegistro('.$row['idcliente'].')" class="btn btn-danger">Excluir</button>
					</td>
	    		</tr>';
				}
			}else{
				// records now found
				$data .= '<tr><td colspan="6">Nenhum Registro encontrado </td></tr>';
			}
			
			$data .= '</table>'; 
			echo $data;
		 
	}
	
	if($metodo == "delet"){
		
		$usuario = new Usuario();
		$id = $_POST['id'];		
		$result = $usuario->excluir ($id);			
		
		$UsuarioTelefone = new UsuarioTelefone();
		$result = $UsuarioTelefone->excluir ($id);
	}	

	if($metodo == "detalhe"){
	
		$usuario = new Usuario();
		$id = $_POST['id'];
		$result = $usuario->consultarUsuario ($id); 
		
		echo $result;
	}

}
	
?>