<?php
class ContactData {
	public static $tablename = "contact";


	public function ContactData(){
		$this->title = "";
		$this->content = "";
		$this->image = "";
		$this->user_id = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function getUser(){ return UserData::getById($this->user_id); }

	// solo para la funcion: getAnsInboxByUserId 
	public function getClient(){ return UserData::getById($this->client_id); }

	public function add(){
		$sql = "insert into ".self::$tablename." (user_id,message,product_id,created_at) ";
		$sql .= "value ($this->user_id,\"$this->message\",$this->product_id,NOW())";
		Executor::doit($sql);
	}

	public function add_question(){
		$sql = "insert into ".self::$tablename." (user_id,message,product_id,is_question,created_at) ";
		$sql .= "value ($this->user_id,\"$this->message\",$this->product_id,1,NOW())";
		Executor::doit($sql);
	}


	public function answer(){
		$sql = "insert into ".self::$tablename." (contact_id,user_id,message,product_id,is_answer,created_at) ";
		$sql .= "value ($this->contact_id,$this->user_id,\"$this->message\",$this->product_id,1,NOW())";
		Executor::doit($sql);
	}

	public function answer_question(){
		$sql = "insert into ".self::$tablename." (contact_id,user_id,message,product_id,is_answer,is_question,created_at) ";
		echo $sql .= "value ($this->contact_id,$this->user_id,\"$this->message\",$this->product_id,1,1,NOW())";
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

// partiendo de que ya tenemos creado un objecto ContactData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",short_name=\"$this->short_name\",is_active=\"$this->is_active\" where id=$this->id";
		Executor::doit($sql);
	}

	public function updateValFromName($name,$val){
		$sql = "update ".self::$tablename." set val=\"$val\" where name=\"$name\"";		
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ContactData());
	}

	public static function getByPreffix($id){
		$sql = "select * from ".self::$tablename." where name=\"$id\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ContactData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ContactData());
	}

	public static function getQuestionsByProduct($id){
		$sql = "select * from ".self::$tablename." where is_question=1 and product_id=$id and is_answer=0";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ContactData());
	}

	public static function getAnswersByContact($id){
		$sql = "select * from ".self::$tablename." where is_answer=1 and contact_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ContactData());
	}

	public static function getInboxByUserId($id){
		$sql = "select contact.message as message,contact.contact_id as contact_id, product.id as product_id,contact.id as id,contact.user_id as client_id,contact.created_at as created_at from ".self::$tablename." inner join product on (contact.product_id=product.id) where product.user_id=$id and is_answer=0 and is_question=0";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ContactData());
	}

	public static function getAnsInboxByUserId($id){
		$sql = "select contact.message as message,contact.contact_id as contact_id, product.id as product_id,contact.id as id,contact.user_id as client_id,contact.created_at as created_at from ".self::$tablename." inner join product on (contact.product_id=product.id) where product.user_id=$id and is_answer=0 and is_question=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ContactData());
	}


	public static function getOrdersByUserId($id){
		$sql = "select * from ".self::$tablename." inner join product on (product.id=contact.product_id) where contact.user_id=$id and is_answer=1 and is_question=0";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ContactData());
	}

	public static function getAnswersByUserId($id){
		$sql = "select * from ".self::$tablename." inner join product on (product.id=contact.product_id) where contact.user_id=$id and is_answer=1 and is_question=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ContactData());
	}

	public static function getPublics(){
		$sql = "select * from ".self::$tablename." where is_active=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ContactData());
	}

}

?>