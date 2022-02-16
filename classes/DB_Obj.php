<?php
    //For PDO queries, (using PHP 7_)I had to specify the DB (SELECT * FROM Mydatabase.table)
    //instead of just using SELECT * FROM table
    class DB_Obj{
        private $host = "localhost";
        private $userName = "";
        private $password = "";
        private $dbName = "BFORDMUSICIAN";
        private $dbTable;

        private $dbHandler;
        private $error;
        private $dbStatement;
        private $dbID;

        public function __construct($db_table){
           
	    $this->configure();

	    //set DB table
            $this->dbTable=$db_table;
            //Set PDO
            $dsn = "mysql:host=".$this->host."; dbname=". $this->dbName;
            //set options
            $options=array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            //create new PDO
            try{
                $this->dbHandler=new PDO($dsn, $this->userName, $this->password, $options);
            }
            catch(PDOException $e){
                $this->error = $e->getMessage();

                //echo errors
                echo $this->error."<br>";
            }
        }

        private function configure() {

        	$config_file = "config.ini";
		if (!file_exists($config_file)) {
	           return;
                }
             
                $configs = parse_ini_file($config_file, true);
                $database = $configs['database'];

		$this->host = $database['host'];
		$this->port = $database['port'];
		$this->dbName = $database['dbname'];
		$this->userName = $database['user'];
		$this->password = $database['password'];
        
		return $this;
	}

        public function query($query){
            $this->dbStatement = $this->dbHandler->prepare($query);
        }

        public function bind($param, $value, $type=null){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type=PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type=PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type=PDO::PARAM_NULL;
                        break;
                        default:
                        $type=PDO::PARAM_STR;
                }
            }
            $this->dbStatement->bindValue($param, $value, $type);
        }

        public function exe(){
            return $this->dbStatement->execute();
        }

        public function lastInsertId(){
            return $this->dbHandler->lastInsertId();
        }

        public function setId($id){
            $this->dbID=$id;
        }

        public function getId(){
            return $this->dbID;
        }

        public function getTable(){
            return $this->dbTable;
        }

        public function resultset(){
            $this->exe();
            return $this->dbStatement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function result(){
            $this->exe();
            return $this->dbStatement->fetchAll(PDO::FETCH_COLUMN);
        }

        public function stringSample($str, $len){
            return substr($str,0,$len).'...';
        }
    }
    
?>
