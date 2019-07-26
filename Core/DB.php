<?php
define("BD_HOST","localhost");
define("BD_USER","root");
define("BD_PASS","");
define("BD_NAME","cajaexpress_v3");
/*define("BD_HOST","localhost");
define("BD_USER","root");
define("BD_PASS","mysql");
define("BD_NAME","baseiot2018");*/
class BaseDatos {
	private $bd;
	public $error=false;
	public $message;
	public function __construct(){
		try {
		 	$this->bd = new PDO("mysql:dbname=".BD_NAME.";host=".BD_HOST,BD_USER,BD_PASS);
		 } catch (Exception $e) {
		 	echo $e->getMessage();
		 	$this->error=true;
		 }
	}
	
	public function insert($tabla, $campos, $valores) {
		$campos2 = array();
		$comodines = array();
		$consulta = "INSERT INTO $tabla(";
		foreach ($campos as $c) {
			$campos2[] = $c;
		}
		$strcampos = implode(",", $campos2);
		$consulta .= $strcampos.") VALUES (";
		foreach ($valores as $v ) {
			$comodines[] = "?";
		}
		$strcomodines = implode(",", $comodines);
		$consulta .= $strcomodines . ")";
		$sql = $this->bd->prepare($consulta);
		if($sql->execute($valores))
			return 1;
		else
			return $sql->errorInfo();
	}
	public function selectGeneral($tabla){
		$sql = $this->bd->prepare("SELECT * FROM $tabla");
		$sql->execute();
		$results = $sql->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	//Funcion solo tuilizable con datos fijos ya que es vulnerable a inyecciones sql
	public function ejecutar($sqlR){
		$sql = $this->bd->prepare($sqlR);
	    if($sql->execute()){
	        $conteo=$sql->rowCount();
	        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
	        if($conteo==0)
	          return 0;
	        else
	          return $results;
	    }
	    else{
	    	$x=$sql->errorInfo();
	      	return "Error en la consulta: $x[2]";//.$sql->errorInfo();
	    }
  	}
	
	public function login($usuario,$clave) {
		$sql = $this->bd->prepare("SELECT * FROM docente WHERE carnet=:carnet AND clave=:clave AND estado='Activo' AND accesosistemas='1' AND esadministrador='1'");
		$sql->bindParam(':carnet',$usuario,PDO::PARAM_STR);
		$sql->bindParam(':clave',$clave,PDO::PARAM_STR);
		if($sql->execute()){
			$filas = $sql->fetchAll(PDO::FETCH_ASSOC);
			if(count($filas)>0) {
				return 'true';
			} else {
				return 'false';
			}
		} else {
			return 'false';
		}
	}
	public function TesteoRegistrarUsuario($carnet,$nombres) {
		$sql = $this->bd->prepare("INSERT into Usuario values(:carnet,:nombres,:apellidos,:clave,:edad,:sexo,:fechaNacimiento,:cargo,:rango,:correo,:permisos,:telefono,1)");
		$sql->bindParam(':carnet',$usuario,PDO::PARAM_STR);
		$sql->bindParam(':clave',$clave,PDO::PARAM_STR);
		if($sql->execute()){
			$filas = $sql->fetchAll(PDO::FETCH_ASSOC);
			if(count($filas)>0) {
				return 'true';
			} else {
				return 'false';
			}
		} else {
			return 'false';
		}
	}

	//**   FUNCIONES GENERALES ADICIONALES  */

	public function deleteGeneral($tabla,$campo,$id){
		$sql = $this->bd->prepare("DELETE FROM $tabla WHERE $campo = $id");

		if($sql->execute())
			return 1;
		else
			return $sql->errorInfo();
	}
	public function selectbyidGeneral(){
		$sql = $this->bd->prepare("SELECT * FROM $tabla WHERE $campo = $id");
			if($sql->execute()){
			$results = $sql->fetchAll(PDO::FETCH_ASSOC);
				return 	$results;
			}
			else
			{
				return $sql->errorInfo();
		}
	}
}
?>