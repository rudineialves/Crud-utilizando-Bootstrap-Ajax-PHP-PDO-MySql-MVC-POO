
<div id="users" class="container">

	<h3 class="mt-3 mb-3">Crud utilizando Bootstrap - Ajax - PHP - PDO - MySql - MVC - POO</h3>
	<div id="users-filter" class="card card-default content-header">	
		<div class="card-header">
			<div class="row">									
		        <div class="form-group col-sm-8 col-md-6 col-lg-5 col-xl-4">
		            <div class="input-group">
		                <input id="key" name="key" class="form-control" type="text">
		                <span class="input-group-append">
		                    <button class="btn btn-primary btn-src-send" type="button">Buscar</button>
		                </span>
		            </div>
		        </div>
				<div class="d-sm-none d-md-block col-md-3 col-lg-4 col-xl-6"></div>
				<div class="form-group col-sm-4 col-md-3 col-xl-2">								
				<button id="newUsersBtn" onclick="openPopEditUsers('')" class="btn btn-primary btn-block">Cadastrar Novo</button>
				</div>						
			</div>
		</div>			
	</div>
	
	<div id="data-holder" class="table-responsive">
		<table id="users-data-table" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Email</th>
					<th>Login</th>
					<th>Senha</th>
					<th>Status</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>	
				<!-- a lista será carregada aqui via ajax -->
			</tbody>
		</table>
		<div class="data-loader alert alert-info" style="display:none">buscando dados... <img src="images/loader.gif" alt="buscando dados..." /></div>
	</div>
	
	<!-- inclui o javascript que controla o view -->
	<script src="views_js/users.js"></script>
	<!-- inclui a janela de edição ou criação de usuário -->
	<?php include_once('views/users/popEditUsers.php');?>
</div>

