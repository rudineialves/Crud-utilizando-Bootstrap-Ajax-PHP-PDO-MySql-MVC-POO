<?php

	require_once('../models/Users.class.php');

	$id  = '';
	$key = '';

	//pega os valores POST e transforma em variáveis
	foreach($_POST as $postField => $postValue){
		$$postField = trim(strip_tags(addslashes($postValue)));
	}

	//verifica a ação à ser tomada
	switch($act){
		
		/** 
		 * ****************************************************************************
		 * SALVAR
		 * ****************************************************************************
		 */	
		case 'Salvar':					

			$res  = false;
			$item = array();

			if(empty($name)){die(json_encode(array('result'=>'Informe o campo NOME.')));}
			if(empty($email)){die(json_encode(array('result'=>'Informe o campo EMAIL.')));}
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){die(json_encode(array('result'=>'Informe um EMAIL válido.')));}
			if(empty($login)){die(json_encode(array('result'=>'Informe o campo LOGIN.')));}
			if(empty($password)){die(json_encode(array('result'=>'Informe o campo SENHA.')));}

			$user = new User($id);				
			
            $user->setName($name);
            $user->setEmail($email);
            $user->setLogin($login);
            $user->setPassword($password);		

			$res = $user->applyUpdate();

			$item = formatResult($user);		

			$result['result'] = $res;	
			$result['item']   = $item;
			
			echo json_encode($result);
	
		break;
		
		
		/** 
		 * ****************************************************************************
		 * LISTAR
		 * ****************************************************************************
		 */			
		case 'Listar':	
			
			$result = array();

			$usersList = new UsersList();			
            $usersList->filterByKey($key);
			$getList = $usersList->getList();

			foreach($getList as $item){
				$result[] = formatResult($item);
			}

			echo json_encode($result);
			
		break;	


		/** 
		 * ****************************************************************************
		 * SELECIONAR
		 * ****************************************************************************
		 */		
		case 'Selecionar':		
			//cria o objeto passando o parametro id 
			$item = new User($id); 
			echo json_encode(formatResult($item));	

		break;		
		
		
		/** 
		 * ****************************************************************************
		 * EXCLUIR
		 * aqui pode ser substituido por setar o campo active para zero
		 * ****************************************************************************
		 */		
		case 'Excluir':	

			$obj = new User($id);
			$res = $obj->delete();

			echo $res;
		break;		

	}


	/** 
	 * ****************************************************************************
	 * FORMAT RESULT
	 * formata o resultado transformando o objeto em array para o retorno do json
	 * ****************************************************************************
	 */
	function formatResult($obj){

		$item = array();
		
        $item['id']       = $obj->getId();
        $item['name']     = $obj->getName();
        $item['email']    = $obj->getEmail();
        $item['login']    = $obj->getLogin();
        $item['password'] = $obj->getPassword();
        $item['active']   = $obj->getActive();		

		return $item;
	}

?>