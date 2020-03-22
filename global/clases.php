<?php 

class db{

	private $connect;

	function db_open(){

		try {

			$this->connect = new PDO(
				'mysql:host=' . SERVIDOR . '; dbname=' . BD . '',
				USUARIO,
				PASSWORD,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
			);

		} catch (PDOException $e) {
			echo "<script>alert('Error al conectar...')</script>";
		}
	}

	function db_close(){
		$this->connect = null;
	}

	function db_sql($sql){

		$this->db_open();

		$result = $this->connect->prepare($sql); 
		$result->execute();

		$this->db_close();

		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	function newRow($sql){

		$this->db_open();

		$result = $this->connect->exec($sql);

		$this->db_close();

		return $result;
	}
}

class seguridad extends db{

	function logueo_sesiones($account){
		
		$username = $account[0]['username'];
		$email = $account[0]['email'];
		$team = $account[0]['team'];
		$id = $account[0]['id'];

		if ($this->logueo_autorizado() == "nosesion") {
			$usuario = array(
				'username' => $username,
				'team' => $team,
				'email' => $email,
				'id' => $id
			);

			$_SESSION['SESION'][0] = $usuario;
			echo "
			<script>
				location.reload();
			</script>";
		}

		$acceso = "UPDATE `usuario` SET `status` = '1' WHERE `usuario`.`username` = '$username'";
		db::newRow($acceso); 
		
		echo "
		<script>
			alert('Bienvenido ".$username."');
			window.location.href='home.php?item=tasks';
		</script>";
	}

	function logueo_autorizado(){

		if(!isset($_SESSION['SESION'])){
			return "nosesion";
		}else if(isset($_SESSION['SESION'])){
			return "sesion";
		}
	}

	function salir(){

        $username = $_SESSION['SESION'][0]['username'];
    
		$acceso = "UPDATE `usuario` SET `status` = '0' WHERE `usuario`.`username` = '$username'";
		db::newRow($acceso);
		
        session_destroy();
        echo "
        <script>
            alert('Session closed, thanks for consult us.');
            location.reload();
        </script>";
	}
}