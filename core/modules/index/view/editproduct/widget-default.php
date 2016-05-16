<div class="container">
<?php
$product = ProductData::getById($_GET["product_id"]);
$url = "admin/storage/products/$product->image";
$url2 = "admin/storage/products/$product->image2";
$url3 = "admin/storage/products/$product->image3";
$url4 = "admin/storage/products/$product->image4";
$coin = ConfigurationData::getByPreffix("general_coin")->val;
?>

        <!-- Main Content -->

          <div class="row">
            <div class="col-md-12">
  <!-- Button trigger modal -->
            <h2><?php echo $product->name;  ?> <small>Editar</small></h2>
  <a href="./?view=client" class="btn btn-default">Inicio</a>
  <a href="./?view=myproducts" class="btn btn-default">Mis Productos</a>
  <a href="./?view=newproduct" class="btn btn-default">Agregar Producto</a>
            <?php
            // print_r($_SESSION);
             if(isset($_SESSION["product_updated"])):?>
              <p class="alert alert-info"><i class="fa fa-check"></i> Producto Actualizado Exitosamente</p>
            <?php 
            unset($_SESSION["product_updated"]);
            endif; ?>
            </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-pencil"></i> Editar Producto
                </div>
                <div class="panel-body ">
<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="index.php?action=updateproduct">
  <div class="form-group">


    <label for="inputEmail1" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" name="name" value="<?php echo $product->name; ?>" placeholder="Nombre del producto">
    </div>

  </div>

  <div class="form-group">
    <label for="inputPassword1" class="col-lg-2 control-label">Comentarios</label>
    <div class="col-lg-10">
      <textarea class="form-control" id="inputPassword1" placeholder="Comentarios" rows="6" name="comments"><?php echo $product->comments; ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Precio</label>
    <div class="col-lg-10">
      <div class="input-group">
  <span class="input-group-addon"><?php echo $coin; ?></span>
  <input type="text" class="form-control" placeholder="Precio" value="<?php echo $product->price; ?>" required name="price">
</div>    </div>
  </div>
  <div class="form-group">

    <label for="inputEmail1" class="col-lg-2 control-label">Marca</label>
    <div class="col-lg-2">
      <input type="text" class="form-control" name="brand" value="<?php echo $product->brand; ?>" placeholder="Marca del producto">
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Modelo</label>
    <div class="col-lg-2">
      <input type="text" class="form-control" name="model" value="<?php echo $product->model; ?>" placeholder="Modelo del producto">
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">A&ntilde;o Fab.</label>
    <div class="col-lg-2">
      <input type="text" class="form-control" name="y" value="<?php echo $product->y; ?>" placeholder="A&ntilde;o Fab. del producto">
    </div>

  </div>

<br>  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Imagen</label>

    <div class="col-lg-4">
      <input type="file" name="image">
  <?php if( $product->image!="" && file_exists($url)):?>
<img src="<?php echo $url; ?>" class="img-responsive">
<?php endif; ?>
    </div>

    <label for="inputEmail1" class="col-lg-2 control-label">Imagen 2</label>

    <div class="col-lg-4">
      <input type="file" name="image2">
  <?php if( $product->image2!="" && file_exists($url2)):?>
<img src="<?php echo $url2; ?>" class="img-responsive">
<?php endif; ?>
    </div>
  </div>
<br>  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Imagen 3</label>

    <div class="col-lg-4">
      <input type="file" name="image3">
  <?php if( $product->image3!="" && file_exists($url3)):?>
<img src="<?php echo $url3; ?>" class="img-responsive">
<?php endif; ?>
    </div>

    <label for="inputEmail1" class="col-lg-2 control-label">Imagen 4</label>

    <div class="col-lg-4">
      <input type="file" name="image4">
  <?php if( $product->image4!="" && file_exists($url4)):?>
<img src="<?php echo $url4; ?>" class="img-responsive">
<?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="is_public" <?php if($product->is_public){ echo "checked";} ?> > Es Visible
        </label>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="in_existence" <?php if($product->in_existence){ echo "checked";} ?>> En Existencia
        </label>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="is_featured" <?php if($product->is_featured){ echo "checked";} ?>> Producto destacado
        </label>
      </div>
    </div>

  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria</label>
    <div class="col-lg-10">
<?php
$categories = CategoryData::getAll();
 if(count($categories)>0):?>
<select name="category_id" class="form-control">
<option value="">-- SELECCIONE CATEGORIA --</option>
<?php foreach($categories as $cat):?>
<option value="<?php echo $cat->id; ?>" <?php if($product->category_id==$cat->id){ echo "selected";} ?>><?php echo $cat->name; ?></option>
<?php endforeach; ?>
</select>
 <?php endif; ?>

    </div>
  </div>


  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-6">
      <button type="submit" class="btn btn-success btn-block">Actualizar Producto</button>
    </div>
    <div class="col-lg-4">
      <button type="reset" class="btn btn-default btn-block">Limpiar Campos</button>
    </div>
  </div>
  <input type="hidden" name="id" value="<?php echo $_GET["product_id"];?>">
</form>

                  
                </div>
              </div>
            </div>

          </div>

<br><br>
</div>