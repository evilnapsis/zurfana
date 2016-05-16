<?php

$cat = CouponData::getById($_GET["id"]);
$cat->del();

Core::redir("./index.php?view=coupons");
?>