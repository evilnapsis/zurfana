<?php
class CouponData {
	public static $tablename = "coupon";


	public function CouponData(){
		$this->title = "";
		$this->content = "";
		$this->image = "";
		$this->user_id = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function getProduct(){ return $this->product_id!=null ? ProductData::getById($this->product_id) : null; }

	public function add(){
		$sql = "insert into ".self::$tablename." (name,description,is_active,val,product_id,is_multiple,start_at,finish_at,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->description\",$this->is_active,\"$this->val\",$this->product_id,\"$this->is_multiple\",\"$this->start_at\",\"$this->finish_at\",$this->created_at)";
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

// partiendo de que ya tenemos creado un objecto CouponData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",description=\"$this->description\",is_active=\"$this->is_active\",val=\"$this->val\",product_id=$this->product_id,is_multiple=\"$this->is_multiple\",start_at=\"$this->start_at\",finish_at=\"$this->finish_at\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CouponData());
	}

	public static function getByName($id){
		$sql = "select * from ".self::$tablename." where name=\"$id\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CouponData());
	}

	public static function getByPreffix($id){
		$sql = "select * from ".self::$tablename." where short_name=\"$id\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CouponData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CouponData());
	}

	public static function getPublics(){
		$sql = "select * from ".self::$tablename." where is_active=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CouponData());
	}

}

?>