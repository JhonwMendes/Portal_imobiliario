<?php
	verificarPermissaoPagina(2);
?>

<div class="box-content">
	<h2><i class="fa fa-user"></i> Adicionar Usuário</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){
				$login = $_POST['login'];
				$nome = $_POST['nome'];
				$senha = $_POST['password'];
				$imagem = $_FILES['imagem'];
				$cargo = $_POST['cargo'];

				if($login == ''){
					Painel::alert('erro','O login está vázio!');
				}else if($nome == ''){
					Painel::alert('erro','O nome está vázio!');
				}else if($senha == ''){
					Painel::alert('erro','A senha está vázia!');
				}else if($cargo == ''){
					Painel::alert('erro','O cargo precisa estar selecionado!');
				}else if($imagem['name'] == ''){
					Painel::alert('erro','A imagem precisa estar selecionada!');
				}else{
					if($cargo >= $_SESSION['cargo']){
						Painel::alert('erro','Você precisa selecionar um cargo menor que o seu!');
					}else if(Painel::imagemValida($imagem) == false){
						Painel::alert('erro','O formato especificado não está correto');
					}else if(Usuario::userExists($login)){
						Painel::alert('erro','O login já existe, selecione outro por favor!');;
					}else{
						$usuario = new Usuario();
						$imagem = Painel::uploadFile($imagem);
						$usuario->cadastrarUsuario($login,$senha,$imagem,$nome,$cargo);
						Painel::alert('sucesso','O cadastro do usuário '.$login.'foi feito com sucesso!');
					}
				}
				
				
				if($imagem['name'] != ''){

					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_autal);
						$imagem = Painel::uploadFile($imagem);
						if($usuario->atualizarUsuario($nome,$senha,$imagem)){
							$_SESSION['img'] = $imagem;
							Painel::alert('sucesso','Atualizado com sucesso junto com a imagem!');
						}else{
							Painel::alert('sucesso','Ocorreu um erro ao atualizar junto com a imagem');
						}
					}else{
						Painel::alert('erro','O formato da imagem não é válido');
					}
				}else{
					$imagem = $imagem_atual;
					if($usuario->atualizarUsuario($nome,$senha,$imagem)){
						Painel::alert('sucesso','Atualizado com sucesso!');
					}else{
						Painel::alert('sucesso','Ocorreu um erro ao atualizar...');
					}
				}
			}

		?>

		<div class="form-group">
			<label>Login:</label>
			<input type="text" name="login">
		</div><!--form-group-->
		
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome">
		</div><!--form-group-->

		<div class="form-group">
			<label>Senha:</label>
			<input type="password" name="password">
		</div><!--form-group-->

		<div class="form-group">
			<label>Cargo:</label>
			<select name="cargo">
				<?php
					foreach(Painel::$cargos as $key => $value) {
						if($key < $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
					}
				?>
			</select>
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem" >
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->
	</form>
</div><!--box-content-->