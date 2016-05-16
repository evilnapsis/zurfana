<?php
if(!empty($_POST)){
	if(isset($_POST["coupon"]) && $_POST["coupon"]!=""){
		$coupon=CouponData::getByName($_POST["coupon"]);
		if($coupon==null || ($coupon!=null&&!$coupon->is_active)){
			Core::alert("El cupon no existe!");
		}else{
			$date = date("Y-m-d");
			if($date<$coupon->start_at){
				Core::alert("El cupon no puede usarse!");
			} else if($date>$coupon->finish_at){
				Core::alert("El cupon ha expirado!");
			}else{
				// el cupon esta listo
				if($coupon->product_id==null){
					$_SESSION["coupon"] = $coupon->id;
				}else{
					//print_r($_SESSION["cart"]);
					$found =  false;
					foreach($_SESSION["cart"] as $c){
						if($c["product_id"]==$coupon->product_id){
							$found = true;
							break;
						}
					}
					if($found){
					$_SESSION["coupon"] = $coupon->id;						
					}else{
						Core::alert("El cupon no fue aplicado. Producto(s) Invalido(s)");
					}
				}
			}

		}
	}
	Core::redir("./?view=mycart");
}

?>