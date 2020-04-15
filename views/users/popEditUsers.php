<div id="popEditUsers" class="modal fade" data-backdrop="static">
	
	<div id="mainPopEditUsers" class="modal-dialog">
		<div class="modal-content">	
			<div class="modal-header">
				<button id="closeEditUsersBtn" type="button" class="close">×</button>
				<h3 class="modal-title">&nbsp;</h3>
			</div>
			<div class="modal-body">
				<div class="row">						
					<form id="formEditUsers" class="col-12">						
						<div class="form-group col-sm-6">
						    <label>Nome</label>
						    <input id="name" name="name" class="input-field form-control" type="text">
						</div>
						<div class="form-group col-sm-6">
						    <label>E-mail</label>
						    <input id="email" name="email" class="input-field form-control" type="text">
						</div>
						<div class="form-group col-sm-6">
						    <label>Login</label>
						    <input id="login" name="login" class="input-field form-control" type="text">
						</div>
						<div class="form-group col-sm-6">
						    <label>Senha</label>
						    <input id="password" name="password" class="input-field form-control" type="password">
						</div>
					</form>						
				</div>				
			</div>
			<div class="modal-footer">		
				<button id="cancelEditUsersBtn" class="btn btn-default cancel-btn">Fechar</button> 
				<button id="saveEditUsersBtn" class="btn btn-primary save-btn">Salvar</button> 
			</div>
		</div>
		<div class="loaderContent" style="display:none"></div>
	</div>
		
</div>

<script src="views_js/users/popEditUsers.js"></script>


