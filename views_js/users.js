
//fechamos o código em um método anônimo 
//à fim de evitar conflitos de métodos e atributos
(function($){

	// Importante definir os principais containeres
	// para o caso de ser necessário modificar um id 
	// para reaproveitamento de código
	// ou simplesmente para melhor organização
	 
	//criamos as vars em escopo global (porém fechadas em nosso método anônimo)
	var usersHolder; //container
	var usersFilter; //form
	var usersList;	 //list holder	
	var targetUrl = 'controllers/Users.php';
	//criamos um método para definir os containers
	//este método deverá ser chamado no onload da página
	//para evitar definir um objeto que ainda não tenha sido criado pelo dom
	function defineContainers(){
		usersHolder = $('#users');
		usersFilter = usersHolder.find('#users-filter');
		usersList   = usersHolder.find('#users-data-table');			
	}


	/**
	 * *******************************************************************************************
	 * LISTA USERS
	 * *******************************************************************************************
	 */
	function getListUsers(){		

		usersList.find("tbody").html('');//limpa a lista atual
		usersHolder.find(".data-loader").fadeIn(); //mostra o loader
		//usersFilter.find(".btn-src-send").enable(false); //bloqueia o botão até o retorno da chamada para evitar chamadas duplicadas

		$.ajax({
			type: "post", //metodo de envio
			data : {'act' : 'Listar', //ação à ser executada pelo controller	
					'key' : usersFilter.find('#key').val() //pega o valor do campo de busca (se houver)
				   },
			url: targetUrl, //url do controller
			dataType: 'json', //tipo de retorno
			success: function(result) {	

				//faz um each no resultado montando o html 
				//utiliza o metodo usersString para melhor organização e evitar código duplicado
				//este método é utilizado também no update de uma única linha ao editar o item evitando o refresh da lista toda
				var content = '';						
				$.each(result, function(i, item){
					content += usersString(item);
				});
				usersList.find("tbody").append(content);				

				//esconde o loader e reativa o botão
				usersHolder.find(".data-loader").fadeOut();
				//usersFilter.find(".btn-src-send").enable(true);					
			},
			error: function() {
				//no caso de erro, esconde o loader e reativa o botão			
				usersHolder.find(".data-loader").fadeOut();
				//usersFilter.find(".btn-src-send").enable(true);	
			}
		}); 
		
	}

	/**
	 * ******************************************************************************
	 * USERS STRING
	 * monta o html
	 * ******************************************************************************
	 */
	function usersString(data){

		/* recebe o objeto e monta o html de cada linha */
		var item = '';
		item += '<tr id="item-'+data.id+'" class="data-item '+(data.active?'disabled':'')+'">';
        item +=     '<td>'+data.name+'</td>';
        item +=     '<td>'+data.email+'</td>';
        item +=     '<td>'+data.login+'</td>';
        item +=     '<td>'+data.password+'</td>';
        item +=     '<td>'+(data.active?'Ativo':'Inativo')+'</td>';
		item +=     '<td class="text-right">';
		item +=         '<a href="javascript:;" onclick="openPopEditUsers('+data.id+')" class="item-edit" title="Editar"><img src="images/edit.png"></a> &nbsp;';
		item +=         '<a href="'+data.id+'" class="item-delete" title="Excluir"><img src="images/close.png"></a>';
		item +=	    '</td>';
		item += '</tr>';

		return item;
	}


	/** 
	 * ******************************************************************************
	 * UPDATE LIST LINE
	 * Atualiza os dados de uma linha da lista
	 * ******************************************************************************
	 */
	function usersUpdateListLine(e, obj, pItemId){
		
		// se possuir id, atualiza a linha, senão adiciona o item no topo da lista
		if(pItemId){
			// se recebeu o objeto como parâmetro adiciona, senão busca os dados
			if(obj){
				usersList.find("tbody #item-"+pItemId).replaceWith(usersString(obj));
			}
			else {
				$.post(targetUrl, {'act': 'Selecionar', 'id': pItemId}, function(obj){
				 	usersList.find("tbody #item-"+pItemId).replaceWith(usersString(obj));
				}, 'json');
			}			
		}
		else {
			usersList.find("tbody").prepend(usersString(obj));
		}
	}
	
	


	/**
	 * ******************************************************************************
     * DELETE USERS
     * ******************************************************************************
     */
	function deleteUsers(itemId){
		//ideal ter um confirm aqui, deixei sem para não fazer uso de outro plugin
		$.ajax({
			type: 'post',
			data: {
				'act' : 'Excluir',
				'id'  : itemId,
			},
			url: targetUrl,
			success: function(data){
				if(data == true){						
					usersList.find("#item-"+itemId).fadeOut('fast',function(){$(this).remove()});
				}
			}
		});		
	}

	/**
	 * ******************************************************************************
	 * INIT
	 * inicia as funções 
	 * ******************************************************************************
	 */
	$(function(){

		defineContainers();

		getListUsers(); /* carrega a listagem ao iniciar a página */
		
		//adiciona o listener - quando houver alteração/edição do item chama o método de atualização da linha
		$(document).on('UsersUpdated', usersUpdateListLine); 	

		/** Eventos dos botões */
		usersFilter.find(".btn-src-send").click(getListUsers);
		
		//como os itens ainda não existem, adiciona o listener na própria usersList
		usersList.on('click', '.item-delete', function(e){
			e.preventDefault();
			deleteUsers($(this).attr('href'));
		});

	});

})(jQuery);