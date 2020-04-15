<?php 

    class User {
        
        private $id;
        private $name;
        private $email;
        private $login;
        private $password;
        private $active;

        private $conn;
        private $message;

        function __construct($pId=''){
            
            $this->setName('');
            $this->setEmail('');
            $this->setLogin('');
            $this->setPassword('');
            $this->setActive(1);
            
            //carrega os atributos caso tenha sido passado o id no construct
            if(!empty($pId)){
                $this->setId($pId);
                $this->load();
            }
        }


        /**
         * CONNECT
         * conecta ao banco de dados
         */
        public function connect(){  

            $dbType     = "mysql";
            $dbHost     = "localhost";
            $port       = "3306";
            $dbUser     = "root";
            $dbPassword = "";
            $dbName     = "codshare_crud_users";

            // conecta ao banco
            if(empty($this->conn)){
                try{
                    $this->conn = new PDO($dbType.":host=".$dbHost.";port=".$port.";dbname=".$dbName.";charset=utf8", $dbUser, $dbPassword);
                } catch(PDOException $e) {
                    $this->message = $e->getMessage();
                    $this->conn = 'ERROR';
                }   
            }                                   
             
            return $this->conn;
        }


        /**
         * LOAD
         * carrega o objeto com os dados do DB
         */ 
        public function load(){

            if($this->connect() != 'ERROR'){            

                $sql = "SELECT * FROM `users` WHERE `id` = ? LIMIT 1";
                $params = array($this->getId());

                $query = $this->connect()->prepare($sql);
                $query->execute($params);
                $res = $query->fetchAll(PDO::FETCH_OBJ);

                //se retornou algo
                if(count($res)>0){

                    //pega o primeiro (e único) item
                    $row = $res[0];
                    
                    //seta os valores dos atributos  com o resultado obtido
                    $this->setId($row->id);
                    $this->setName($row->name);
                    $this->setEmail($row->email);
                    $this->setLogin($row->login);
                    $this->setPassword($row->password);
                    $this->setActive($row->active);
                } 
            }           
        }


        /**
         * INSERT
         */ 
        public function insert(){

            $insertId = 0;
            
            if($this->connect() != 'ERROR'){ 

                $sql  = "INSERT INTO `users` ";
                $sql .= "(`name`, `email`, `login`, `password`, `active`) ";
                $sql .= "VALUES (?, ?, ?, ?, ?)";
                $params = array($this->getName(), $this->getEmail(), $this->getLogin(), $this->getPassword(), $this->getActive());

                $query = $this->connect()->prepare($sql);
                $insert = $query->execute($params);
                
                //caso sucesso no insert, retorna o last id
                if($insert === true){
                   $insertId = $this->connect()->lastInsertId();
                }
            }

            //se retornou o insert id, seta o atributo id do objeto
            if($insertId > 0){
                $this->setId($insertId);
                return true;
            }
            else {
                return false;
            }
        }


        /**
         * UPDATE
         */ 
        public function update(){

            $update = false;

            if($this->connect() != 'ERROR'){ 

                $sql  = "UPDATE `users` SET ";
                $sql .= "`name` = ?, `email` = ?, `login` = ?, `password` = ?, `active` = ? ";
                $sql .= "WHERE `id` = ? LIMIT 1";
                $params = array($this->getName(), $this->getEmail(), $this->getLogin(), $this->getPassword(), $this->getActive(), $this->getId());
                $query = $this->connect()->prepare($sql);
                $update = $query->execute($params);
            }

            return $update;
        }


        /**
         * APPLY UPDATE
         * Decide se é insert ou update
         */ 
        public function applyUpdate(){
            //se o objeto possuir id, chama o update 
            //senão chama o método insert
            $thisId = $this->getId();
            if(!empty($thisId)){
                return $this->update();
            }
            else {
                return $this->insert();
            }
        }


        /**
         * DELETE
         */ 
        public function delete(){

            $deleted = 0;

            if($this->connect() != 'ERROR'){ 

                $sql  = "DELETE FROM users WHERE id = ? LIMIT 1";
                $params = array($this->getId());
                $query = $this->connect()->prepare($sql);
                $deleted = $query->execute($params); //retorna o num de itens afetados
            }

            if($deleted > 0){
                return true;
            }
            else {
                return false;
            }
        }

        /**
         * SETTERS
         */ 
        
        public function setId($id){$this->id = $id;}
        public function setName($name){$this->name = $name;}
        public function setEmail($email){$this->email = $email;}
        public function setLogin($login){$this->login = $login;}
        public function setPassword($password){$this->password = $password;}
        public function setActive($active){$this->active = $active;}

        /**
         * GETTERS
         */ 
        
        public function getId(){return $this->id;}
        public function getName(){return $this->name;}
        public function getEmail(){return $this->email;}
        public function getLogin(){return $this->login;}
        public function getPassword(){return $this->password;}
        public function getActive(){return $this->active;}

    }




    class UsersList {
      
        private $filter;
        private $params;


        function __construct(){ 
            
        }


        /**
         * CONNECT
         * conecta ao banco de dados
         */
        public function connect(){  

            $dbType     = "mysql";
            $dbHost     = "localhost";
            $port       = "3306";
            $dbUser     = "root";
            $dbPassword = "";
            $dbName     = "codshare_crud_users";

            // conecta ao banco
            if(empty($this->conn)){
                try{
                    $this->conn = new PDO($dbType.":host=".$dbHost.";port=".$port.";dbname=".$dbName.";charset=utf8", $dbUser, $dbPassword);
                } catch(PDOException $e) {
                    $this->message = $e->getMessage();
                    $this->conn = 'ERROR';
                }   
            }                                   
             
            return $this->conn;
        }


        /**
         * GET LIST
         */
        public function getList(){

            $result    = array();

            if($this->connect() != 'ERROR'){

                $sql  = "SELECT id FROM users WHERE 1 ";
                $sql .= $this->getFilter();
                $sql .= "ORDER BY id DESC"; 
                $query = $this->connect()->prepare($sql);
                $query->execute($this->getParams());
                $list = $query->fetchAll(PDO::FETCH_OBJ);
                
                foreach($list as $item){
                    $obj = new User($item->id);
                    $result[] = $obj;
                }
            }

            return $result;
        }     


        /**
         * GETTERS
         */       
        public function getFilter(){return $this->filter;}
        public function getParams(){return $this->params;}
        

        /**
         * FILTERS
         */
        public function filterByKey($key){
            $fields = array('name', 'login');
            if(count($fields) > 0 && !empty($key)){
                $i      = 0;
                $filter = '';
                foreach($fields as $field){
                    if($i>0){$filter .= " OR ";}$i++;
                    $filter .= $field." LIKE :key".$i;
                    $this->params['key'.$i] = '%'.$key.'%';
                }
                $this->filter = $filter ? "AND ($filter) " : "";
            }
        }
    }

?>