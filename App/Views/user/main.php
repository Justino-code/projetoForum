  <h1>Perfil do Usuário</h1>
  <nav id="menu-user">
    <div id="menu-conta">
       <h3 id="conta-d">Minha Conta</h3>
       <ul>
         <li class='option'>Actualizar Info</li>
         <li class='option'>Verificar Conta</li>
         <li class='option'>Remover Conta</li>
      </ul>
    </div>
    
    <div id="menu-post">
       <h3 id="post-d">Meus Posts</h3>
       <ul>
         <li class='option'>Ver Posts</li>
         </ul>
      </div>
  </nav>
  
  <div class="profile">
    <div class="profile-image">
      <div id="image">
      <img src="
<?php 
	if(FOTO_PERFIL){
		echo DIRPAGE."public/img/".FOTO_PERFIL."";
	}else{
		echo DIRPAGE."public/img/default.png";
	}
?>

" alt="Foto de Perfil">
        </div>
    </div>
    <div class="profile-info">
<?php
	if(isset($_SESSION['user_name'])){
		if(POST_NOTIFY == 'Não'){
			$class = 'active';
			$btn = 'Activar';
			$value = 1;
		}else{
			$class = 'unactive';
			$btn = 'Desativar';
			$value = 0;
		}
echo "	
      <h2>".NOME." ".SOBRENOME."</h2>
	<h3>".ALCUNHA."</h3>
      <p><strong>Email: </strong>".EMAIL."</p>
	<p><strong>Telefone: </strong>".TELEFONE."</p>
	<p><strong>Status: </strong>".STATUS."</p>
	<p><strong>Verificação: </strong>".VERIFY."</p>
	<p><strong>Notificação: </strong>".POST_NOTIFY." <button id='btn-active' value = {$value} class={$class}>{$btn}</button></p>
	<p><strong>Aniversario: </strong>".DATE_OF_BIRTH."</p>
      <p><strong>Data de Criação: </strong>".CREATE_DATE."</p>
      <p><strong>Data da Ultima Actualização: </strong>".UPDATE_DATE."</p>
	<p><strong>Ultimo login: </strong>".LAST_LOGIN."</p>
";
}?>
      <p><strong>Redes Sociais:</strong></p>
      <ul>
        <li><a href="https://www.facebook.com/johndoe" target="_blank">Facebook</a></li>
        <li><a href="https://www.instagram.com/johndoe" target="_blank">Instagram</a></li>
        <li><a href="https://www.twitter.com/johndoe" target="_blank">Twitter</a></li>
      </ul>
    </div>
  </div>

<script src="<?php echo DIRPAGE."/public/js/UserProfile2.js";?>"></script>
