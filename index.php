<html>
<head>
    <title>Joseliano</title> 
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/>
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script> 
		<script type="text/javascript" src="js/jquery.mask.min.js"></script> 		
		 
		<script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script> 
		<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<script type="text/javascript">

	$("#us_dtNascimento").mask("00/00/0000");
	$("#us_telefone").mask("(00) 0000-00009");
	
</script>
<div class="container">    
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal"  
				onclick="Jpascript.novoRegistro()" 
				>Novo Registro</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Registros :</h3> 
            <div class="list_registro"></div>
        </div>
    </div>
</div> 

<div class="modal fade" id="add_registro_modal" tabindex="-1" role="dialog" aria-labelledby="addRegistro">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="form">
            <div class="modal-header">                
                <h4 class="modal-title" id="addRegistro">Novo Registro</h4>
                 <font color=red><label id="msg"> </label></font>
            </div>
			<div class="col-xs-12">
            <div class="modal-body">
				<div class="col-xs-12">
					<div class="form-group" data-id="1">
						<label for="us_nome">Nome <font color=red>*</font> </label>
						<input type="text" id="us_nome" placeholder="Nome" class="form-control" />
					</div>
				</div>
				<div class="col-xs-6">
                <div class="form-group" data-id="2">
                    <label for="us_dtNascimento">Data Nascimento<font color=red>  *</font></label>
                    <input type="text" id="us_dtNascimento" placeholder="Data Nascimento" class="form-control"/>
                </div>
				</div>
				<div class="col-xs-6">
					<div class="form-group" data-id="3">
						<label for="us_email">Email<font color=red>  *</font></label>
						<input type="text" id="us_email" placeholder="Email" class="form-control"/>
					</div>
				</div>
				
				<div class="form-group" id="dvContato">
					<div class="col-xs-4">
						<div class="form-group" data-id="1">
							<label for="us_telefone">Telefone<font color=red>  *</font></label>
							<input type="text" id="us_telefone"  name="us_telefone[1][telefone]"  placeholder="Telefone" class="form-control" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}"/>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group" data-id="1">
							<label for="us_email">Contato<font color=red>  *</font></label>
							<input type="text" id="us_contato"  name="us_telefone[1][contato]"   placeholder="Contato" class="form-control"/>
						</div>
					</div>
					 <button class="btn btn-success" onclick="Jpascript.addDivContato()">add</button>		
					
				</div>
				
				 <div class="col-xs-3">
					 <div class="form-group" data-id="1">
	                    <label for="us_uf">UF <font color=red> *</font></label>
	                    <select id="us_uf" placeholder="UF"  class="form-control"> </select> 
	                </div>
				</div>
				 <div class="col-xs-8">
					 <div class="form-group" data-id="1">
	                    <label for="us_localidade">Localidade<font color=red> *</font></label>
	                    <select id="us_localidade"  placeholder="Localidade"  class="form-control"> </select> 
	                </div>
				</div>
             
				 
                <div class="col-xs-12">
                    <label><font color="red">*</font> Campos São Obrigatórios</label> 
                </div> 
            </div>
			 </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="Jpascript.addRegistro()">Salvar</button>				
                <button type="button" class="btn btn-default" data-dismiss="modal">cancelar</button>
				<input  type="hidden"  id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
  
 


 
</body>
</html>
