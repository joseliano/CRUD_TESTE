$(document).ready(function() {
	$('#us_uf').change(function() { 
		Jpascript.readLocalidade($(this).val(),0);
	});
});	

var Jpascript = new function() { // INICIO CLASS
var _class = this;
var regExData = /^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])      [\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/;
var regExEmail=/^.+@.+\..{2,}$/;	
	
	var validarCampos = function(){
		var retorno=true; 

		$('.form-group').each(function() {
	    	idData = $(this).attr('data-id');
	    	 if ((idData==1)||(idData==2) || (idData==3) ){    		 
	    		 valor = $(this).find( "input, select").val();  
				 console.log ($(this).find( "input, select"));
				 console.log (valor);
	    		 if ((valor=="") || (valor==null)){
	    			 att = $(this).find( "input, select").attr('placeholder');   
	    			 $("#msg").html("O Campo " + att + " é obrigatório " );
	    			 retorno=false; 	
	    			 return false;
	    		 } else if (idData==2) {
					if (!((valor.match(regExData)) && (valor.value!=''))) {
						$("#msg").html("Data de Nascimento inválida " );
						retorno=false; 	
						return false;
					}
	    		 } else if (idData==3) {
					if (!((valor.match(regExEmail)) &&  (regExEmail.test(valor)))) {
						$("#msg").html("Por favor, informe um email válido. " );
						retorno=false; 	
						return false;
					}					 
				 }
	    	 }
	    });	 
		
    	
		
		return retorno;
	}
 
	var get = function ($obj,$url,$par=null){	 
		$.get($url, $par , function(data, status) {
		 	$($obj).html(data);
		});	
	}
	
	var post = function ($obj,$url,$par=null){	 
		$.post($url, $par , function(data, status) {
			$($obj).html(data);
		});	
	}

	this.readRecords = function() {		 
		 post(".list_registro","ajax/db_Usuario.php", {"metodo":'list'} );	 
	}

	this.readUF = function() {		
		 get("#us_uf","ajax/util.php", {"metodo":'uf'} );	  
	}

	this.readLocalidade  = function (uf,idlocalidade) {		
		  var vpar =  {"metodo":'localidade', "uf": uf, "idlocalidade": idlocalidade};
		  get("#us_localidade","ajax/util.php", vpar );		 
	}	
 	 
	this.addRegistro  = function () {			  
		retorno = validarCampos();
		 if (!retorno){
			 return false;
		 }
		 
		var hidden_user_id = $("#hidden_user_id").val();

		var us_nome 		;
		var us_dtNascimento ;
		var us_email 		;
		var us_uf 			;
		var us_localidade 	;	
		var us_user_id ;		
		var us_telefone 	;
		var us_contato 	;
		
		us_nome 		= $("#us_nome").val();
		us_dtNascimento = $("#us_dtNascimento").val();
		us_email 		= $("#us_email").val();
		us_uf 			= $("#us_uf").val();
		us_localidade 	= $("#us_localidade").val();
		us_user_id 		= $("#hidden_user_id").val();
		us_telefone 	= $("#us_telefone").val();

		var us_telefone = $('.form-group').find('input[name^="us_telefone"]').serialize();
 
		if(hidden_user_id==""){
			us_modulo		= "in";			
		}else{
			us_modulo		= "up";		 
		}		
		
		console.log (us_modulo);
		
		$.post("ajax/db_Usuario.php", {
			metodo: 'inup',
			us_modulo: us_modulo,
			us_nome: us_nome,
			us_dtNascimento: us_dtNascimento,
			us_email: us_email,
			us_uf: us_uf,
			us_localidade: us_localidade,
			us_user_id: us_user_id	,
			'us_telefone': us_telefone 		
		}, function (data, status) {
		   
			 if (data!=0){    		 
				 alert("Registro Salvo com sucesso ! ");
				 if(us_modulo=='in'){
					_class.limparCampos();
				 }					
					_class.readRecords();
					
			 }else{
				 alert("Registro não foi salvo, houve um erro ");
			 } 
		});
	}

	this.delRegistro  = function (id) {
		var conf = confirm("Confirma a exclusão do Registro ");
		if (conf == true) {
			$.post("ajax/db_Usuario.php", {metodo: 'delet',	id: id	},
				function (data, status) {
					_class.readRecords();
				}
			);
		}
	} 
	this.novoRegistro  = function () {	
		
		_class.limparCampos();
		$("#add_registro_modal").modal("show");
	}
	this.detalheRegistro  = function (id) {		

	

	    $.post("ajax/db_Usuario.php", {metodo: 'detalhe', id: id},
		
			function (data, status) {
			   
			   var obj = jQuery.parseJSON(data);  
			   
               $("#hidden_user_id").val(obj[0].idcliente);
			   $("#us_nome").val(obj[0].nome); 
			   
			   $("#us_dtNascimento").val(obj[0].dtnascimento);
			   $("#us_email").val(obj[0].email);
			   $("#us_uf").val(obj[0].UF);  
			   				
			   _class.readLocalidade(obj[0].UF,obj[0].id_localidade); 

			   $.post("ajax/db_Usuario_Telefone.php", {metodo: 'detalhe', id: obj[0].idcliente},		
					function (data, status) {
						var objTel = jQuery.parseJSON(data);
 
						_class.addContato(objTel);
					}
		  		);
			 

			   	
			   $("#add_registro_modal").modal("show");
        	}
	    );	
 
	}
	this.limparCampos  = function (){
		$("#hidden_user_id").val();
		$("#add_registro_modal").modal("hide");				 
		$("#us_nome").val("");
		$("#us_dtNascimento").val("");
		$("#us_email").val("");
		$("#us_uf").val("");
		$("#us_localidade").val("");
	}
	
	this.addContato  = function (obj){
		dDiv = "";
		jQuery('#dvContato').html('');
		divRequirido = 'data-id="1"';

		$.each(obj, function(i, item) {
			console.log(obj[i].numero_tel);

			dDiv += "<div class='col-xs-4' " + divRequirido + " >";
			dDiv +="<div class='form-group'>";
			dDiv +="<label for='us_email'>Telefone</label>";
			dDiv +="<input type='text' id='us_telefone' name='us_telefone["+ obj[i].id +"][telefone]'   placeholder='Telefone' value='"+ obj[i].numero_tel +"'  class='tel form-control' pattern='\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}'/>"
			dDiv +="</div>";;
			dDiv +="</div>";
			
			dDiv +="<div class='col-xs-6'>";
			dDiv +="<div class='form-group'  " + divRequirido + " >";
			dDiv +="<label for='us_email'>Contato</label>";
			dDiv +="<input type='text' id='us_contato' name='us_telefone["+ obj[0].id +"][contato]' placeholder='Contato' value='"+ obj[i].contato +"' class='form-control'/>" 
			dDiv +="</div>";
			dDiv +="</div>" ;
			  divRequirido ="";
		  });

		$("#dvContato").append(dDiv);
		$(".tel").mask("(00) 0000-00009");
	}
	this.addDivContato  = function (){
		var dDiv = "";
		var i=1;
		$("input[id='us_telefone']").each(function(){
			i++;
		 });

		dDiv = "<div class='col-xs-4'>"
		dDiv +="<div class='form-group'>"
		dDiv +="<label for='us_email'>Telefone</label>"
		dDiv +="<input type='text' id='us_telefone' name='us_telefone["+i+"][telefone]'   placeholder='Telefone'  class='tel form-control' pattern='\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}'/>"
		dDiv +="</div>"
		dDiv +="</div>"
		
		dDiv +="<div class='col-xs-6'>"
		dDiv +="<div class='form-group'>"
		dDiv +="<label for='us_email'>Contato</label>"
		dDiv +="<input type='text' id='us_contato' name='us_telefone["+i+"][contato]' placeholder='Contato' class='form-control'/>" 
		dDiv +="</div>";
		dDiv +="</div>"
		
		
		$("#dvContato").append(dDiv);
		$(".tel").mask("(00) 0000-00009");
		
	}

} // FIM CLASS
 

$(document).ready(function () {
	Jpascript.readUF() ;
    Jpascript.readRecords();  
});