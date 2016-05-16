<?php
class ProductData {
	public static $tablename = "product";


	public function ProductData(){
		$this->title = "";
		$this->content = "";
		$this->image = "";
		$this->image2 = "";
		$this->image3 = "";
		$this->image4 = "";
		$this->link = "";
		$this->category_id = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function getUnit(){ return UnitData::getById($this->unit_id);}
	public function getUser(){ return UserData::getById($this->user_id);}
	public function getS(){ return SData::getById($this->s_id);}

	public function add(){
		$sql = "insert into ".self::$tablename." (short_name,name,comments,price,brand,model,y,image,image2,image3,image4,link,category_id,is_public,in_existence,is_featured,s_id,user_id,created_at) ";
		$sql .= "value (\"$this->short_name\",\"$this->name\",\"$this->comments\",\"$this->price\",\"$this->brand\",\"$this->model\",\"$this->y\",\"$this->image\",\"$this->image2\",\"$this->image3\",\"$this->image4\",\"$this->link\",$this->category_id,$this->is_public,$this->in_existence,$this->is_featured,1,$this->user_id,$this->created_at)";
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

// partiendo de que ya tenemos creado un objecto ProductData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",comments=\"$this->comments\",price=\"$this->price\",brand=\"$this->brand\",model=\"$this->model\",y=\"$this->y\",link=\"$this->link\",in_existence=\"$this->in_existence\",is_public=\"$this->is_public\",is_featured=\"$this->is_featured\",category_id=\"$this->category_id\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_image(){
		$sql = "update ".self::$tablename." set image=\"$this->image\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_image2(){
		$sql = "update ".self::$tablename." set image2=\"$this->image2\" where id=$this->id";
		Executor::doit($sql);
	}
	public function update_image3(){
		$sql = "update ".self::$tablename." set image3=\"$this->image3\" where id=$this->id";
		Executor::doit($sql);
	}
	public function update_image4(){
		$sql = "update ".self::$tablename." set image4=\"$this->image4\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_sid(){
		$sql = "update ".self::$tablename." set s_id=\"$this->s_id\" where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductData());
	}

	public static function countBySId($id){
		$sql = "select count(*) as c from ".self::$tablename." where s_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllByUserId($id){
		$sql = "select * from ".self::$tablename." where user_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


	public static function getPublicsByCategoryId($id){
		$sql = "select * from ".self::$tablename." where category_id=$id and is_public=1 and s_id=3 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function get4News(){
		$sql = "select * from ".self::$tablename." where is_new=1 and is_public=1 order by created_at desc limit 4";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function get4Offers(){
		$sql = "select * from ".self::$tablename." where is_offer=1 and is_public=1 order by created_at desc limit 4";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getNews(){
		$sql = "select * from ".self::$tablename." where is_new=1 and is_public=1 order by created_at desc limit 4";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getFeatureds(){
		$sql = "select * from ".self::$tablename." where is_featured=1 and is_public=1 and s_id=3 order by created_at desc limit 6";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where (name like '%$q%' or description like '%$q%') and is_public=1 and s_id=3";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


}

?>