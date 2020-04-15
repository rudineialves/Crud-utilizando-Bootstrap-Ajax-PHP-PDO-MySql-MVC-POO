

/**
 * Neste arquivo são configurados os plugins utilizados no sistema
 * são criados métodos padrões e os plugins são configurados dentro deles 
 * no caso de mudança ou atualização de algum plugin 
 * configurando-os nestes métodos servirá à todo o sistema sem a necessidade 
 * de sair "caçando" os códigos onde são utilizados
 */


/* ------------------------------------------------------------------------------------------------------- */
/* DEFAULT NOTIFY */
/* utilizando o plugin toast-r */
/* ------------------------------------------------------------------------------------------------------- */
defaultNotify = function(options){	
	
	//opções padrão deste método
	var settings = $.extend({
		title   : '',
		message : '',
		type    : 'info', //info, warning, success, error
		icon    : ''		
	}, options);

	//configurando o plugin convertendo as opções padrão do método 
	//para as opções padrão do plugin
	toastr.options.closeButton = true;
	toastr[settings.type](settings.message, settings.title);
}



/* ------------------------------------------------------------------------------------------------------- */
/* DEFAULT CONFIRM - Custom Confirm */
/* utilizando p-notify */
/* ------------------------------------------------------------------------------------------------------- */
/*defaultConfirm = function(options){	

	//opções padrão deste método
	var settings = $.extend({
		title     : 'Confirme!',
		icon      : 'fa fa-question-circle',
		message   : "Você tem certeza que deseja excluir este item?",
		onCancel  : function(){},
		onConfirm : function(){}
	}, options);

	//configurando o plugin convertendo as opções padrão do método para as opções padrão do plugin
	new PNotify({
		title: settings.title,
		text: settings.message,
		icon: settings.icon,
		hide: false,
		type: 'info',
		confirm: {
			confirm: true
		},
		buttons: {
			closer: false,
			sticker: false
		},
		history: {
			history: false
		},
		addclass: 'stack-modal',
		stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
	}).get()
	.on('pnotify.confirm', settings.onConfirm)
	.on('pnotify.cancel', settings.onCancel);	
}*/