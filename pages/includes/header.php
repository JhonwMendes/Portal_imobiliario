<?php
	$parametros = \views\mainView::$par;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Portal Imobiliario</title>
	<meta charset="viewport" content="width=device-width;initial-scale=1.0;maximum-scale=1.0">
	<link rel="stylesheet" href=" <?php echo INCLUDE_PATH ?>css/style.css">
	<link rel="stylesheet" href=" <?php echo INCLUDE_PATH ?>css/font-awesome.min.css">
</head>
<body>
	<base base="<?php echo INCLUDE_PATH; ?>">

<header>

	<div class="container">
		<div class="logo"><a style="color:inherit;" href="<?php echo INCLUDE_PATH; ?>">Portal Imobi</a></div>
		<nav class="desktop">
			<ul>
				<?php
					$selectEmpreend = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` ORDER BY order_id ASC");
					$selectEmpreend->execute();
					$empreendimentos = $selectEmpreend->fetchAll();
					foreach($empreendimentos as $key => $value){
				?>
				<li><a href="<?php echo INCLUDE_PATH.$value['slug']; ?>"><?php echo $value['nome']; ?></a></li>
			<?php } ?>
			</ul>
		</nav>
		<div class="clear"></div>
	</div>

</header>

<section class="search1">
	<div class="container">
		<h2>O que voçê procura?</h2>
		<input type="text" name="texto-busca">
	</div>
</section>

<section class="search2">
	<div class="container">
		<form method="post" action="<?php echo INCLUDE_PATH ?>ajax/formularios.php">
			<div class="form-group">
				<label>Área Minima:</label>
				<input placeholder="0" name="area_minima" type="number" min="0" max="100000" step="100">
			</div>

			<div class="form-group">
				<label>Área Maxima:</label>
				<input placeholder="0" name="area_maxima" type="number" min="0" max="100000" step="100">
			</div>

			<div class="form-group">
				<label>Preço min:</label>
				<input placeholder="0" name="preco_min" type="text">
			</div>

			<div class="form-group">
				<label>Preço Max:</label>
				<input placeholder="0" name="preco_max" type="text">
			</div>
			<?php
				if(isset($parametros['slug_empreendimento'])){
					echo '<input type="hidden" nome="slug_empreendimento" value="'.$parametros['slug_empreendimento'].'">';
				}
			?>
			<div class="clear"></div>
		</form>
	</div>
</section>
