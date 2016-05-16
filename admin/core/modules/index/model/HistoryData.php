<?php
class HistoryData {
	public static $tablename = "history";


	public function HistoryData(){
		$this->title = "";
		$this->content = "";
		$this->image = "";
		$this->user_id = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function getStatus(){ return StatusData::getById($this->status_id); }

	public function add(){
		$sql = "insert into ".self::$tablename." (buy_id,status_id,created_at) ";
		$sql .= "value (\"$this->buy_id\",$this->status_id,NOW())";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto HistoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new HistoryData());
	}

	public static function getByPreffix($id){
		$sql = "select * from ".self::$tablename." where short_name=\"$id\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new HistoryData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new HistoryData());
	}

	public static function getAllByBuyId($id){
		$sql = "select * from ".self::$tablename." where buy_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new HistoryData());
	}

	public static function getPublics(){
		$sql = "select * from ".self::$tablename." where is_public=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new HistoryData());
	}

}

?>