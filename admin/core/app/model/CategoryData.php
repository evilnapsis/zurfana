<?php
class CategoryData {
	public static $tablename = "category";


	public $id, $name, $short_name, $in_home, $in_menu, $is_active;
	public function __construct(){
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name,short_name,is_active) ";
		$sql .= "value (\"$this->name\",\"$this->short_name\",$this->is_active)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",short_name=\"$this->short_name\",is_active=\"$this->is_active\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CategoryData());
	}

	public static function getByPreffix($id){
		$sql = "select * from ".self::$tablename." where short_name=\"$id\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CategoryData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}

	public static function getPublics(){
		$sql = "select * from ".self::$tablename." where is_active=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}

	public function getProductCount(){
		$sql = "select count(*) as c from product where category_id=$this->id";
		$query = Executor::doit($sql);
		$r = $query[0]->fetch_assoc();
		return $r['c'];
	}


}


?>