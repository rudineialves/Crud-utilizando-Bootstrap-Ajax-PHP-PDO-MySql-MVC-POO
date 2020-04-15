

var openPopEditUsers;


(function($){

	var container;
	var dataHolder;
	var formHolder;
	var itemId    = '';
	var targetUrl = 'controllers/Users.php';
		
	function defineContainers(){
		container  = $("#mainPopEditUsers");
		dataHolder = container.find("#popHolder");
		formHolder = container.find("#formEditUsers");
	}

	/**
	 * ABRE O POP UP
	 */
	openPopEditUsers = function(pItemId){			
		clearPopEditUsers();
		container.parent().modal('show');

		if(pItemId){			
			loadEditUsers(pItemId);							
		}
		else {
			container.find(".modal-title").html('Adicionar novo item');
			
		}
	}
	
	
	/**
	 * CARREGA OS DADOS
	 */
	function loadEditUsers(pItemId){

		container.find('.loaderContent').fadeIn();
	
		$.ajax({
			type 	 : 'post',
			data 	 : { 
						 'act' : 'Selecionar', 
                         'id'  : pItemId
					   },
			url 	 : targetUrl,
			dataType : 'json',				
			success	 : function(data){
					
				container.find(".modal-title").html('Editar informações');
				
				itemId = data.id;
                container.find('#name').val(data.name);
                container.find('#email').val(data.email);
                container.find('#login').val(data.login);
                container.find('#password').val(data.password);
                container.find('#active').val(data.active);

				container.find('.loaderContent').fadeOut();
			},
			error : function(){
				defaultNotify({message: 'Houve um erro de resposta', type: 'error'});
				container.find('.loaderContent').fadeOut();
			}
		}); 
	}	


	/**
	 * SALVA OS DADOS
	 */
	function saveEditUsers(){

		container.find('.loaderContent').fadeIn();		
	
		$.ajax({
			type 	: 'post',
			data 	: { 
						'act'      : 'Salvar', 
		                'id'       : itemId,
		                'name'     : container.find('#name').val(),
		                'email'    : container.find('#email').val(),
		                'login'    : container.find('#login').val(),
		                'password' : container.find('#password').val()
					  },
			url 	: targetUrl,	
			dataType: 'json',	
			success	: function(data){					
				container.find('.loaderContent').fadeOut();
				if(data.result == true){
					$(document).trigger('UsersUpdated', [data.item, itemId]);	
					defaultNotify({message:'As informações foram salvas com sucesso.', type: 'success'});				
					closePopEditUsers();
				}
				else {
					defaultNotify({message: data.result });
				}				
			},
			error : function(){
				defaultNotify({message:'Houve um erro de resposta.', type: 'error'});
				container.find('.loaderContent').fadeOut();
			}
		}); 	 
	}
	
	

	/**
	 * FECHA O POP UP
	 */
	function closePopEditUsers(){		
		clearPopEditUsers();
		container.parent().modal('hide');		
	};	


	/**
	 * LIMPA O POP UP
	 */
	function clearPopEditUsers(){
		itemId = '';
		document.forms["formEditUsers"].reset();					
		container.find(".modal-title").html('&nbsp;');
		container.find('.loaderContent').hide();
				
	}


	/** 
	 * INIT
	 */
	$(function(){
		
		defineContainers();
		
		container.find('#closeEditUsersBtn , #cancelEditUsersBtn').click(function(e){
			e.preventDefault();
			closePopEditUsers();
		});	
		container.find('#saveEditUsersBtn').click(function(e){
			e.preventDefault();
			saveEditUsers();
		});
	});
	

})(jQuery);

