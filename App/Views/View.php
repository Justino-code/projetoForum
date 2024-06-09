<?php /*session_unset();
echo $_SESSION['user_name'].'<br>';
echo $_SESSION['user_email'].'<br>';
echo $_SESSION['user_id'];
if($_SERVER['REQUEST_METHOD'] == 'GET' && ($_SERVER['REQUEST_URI'] != '/APLP/')){
	http_response_code(403);
	$uri = $_SERVER['REQUEST_URI'];
	//header('Location: http://localhost:8082/APLP/');
	//echo $_SERVER['REQUEST_URI'];
}else{
	echo 'Estou aqui';
}

var_dump($_SERVER['REQUEST_METHOD'] == 'GET' && ($_SERVER['REQUEST_URI'] == '/APLP/'))*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->getTitle();?></title>
    <link rel="stylesheet" href=<?php echo DIRPAGE."/public/css/style2.css";?>>
    <?php echo $this->renderHead()?>
   <script src ="<?php //echo DIRPAGE."/public/js/user.js"?>"></script>
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <div class="header-container">
            <div class="logo">
	    <img src=<?php echo DIRPAGE."/public/img/logo2.png"?> alt="Logotipo do Fórum">
	</div>
<?php 
if(isset($_SESSION['user_name'])){
	$nome = $_SESSION['user_name'];
	echo "<div id='perfil'><h2>{$nome[0]}</h2></div>";
}
?>
            <nav class="nav-menu">
                <ul>
                    <li><a href="home">Início</a></li>
                    <li><a href="post">Tópicos</a></li>
                    <li><a href="user">Usuários</a></li>
		    <li><a href="about">Sobre</a></li>
		<?php if(!isset($_SESSION['user_name']))
		echo "<li id='login'>Login</li>";
else
	echo "<li id='logout'>Sair</li>";
?>
                </ul>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Pesquisar...">
            </div>
        </div>
        <?php echo $this->renderHeader();?>
    </header>

    <!-- Conteúdo principal -->
    <main id="content">
      <?php echo $this->renderMain();?>
        
    </main>
    
    <aside>
      <?php echo $this->renderAside();?>
    </aside>
     
    <!-- Rodapé -->
    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <a href="#termos">Termos de Uso</a>
                <a href="#privacidade">Política de Privacidade</a>
                <a href="#contato">Contato</a>
            </div>
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">LinkedIn</a>
            </div>
        </div>
	<?php echo $this->renderFooter();?>
<script src ="
	<?php 
	if(!isset($_SESSION['user_name'])){
		echo DIRPAGE."/public/js/userLogin.js";
	}else{
		echo DIRPAGE."/public/js/userLogout.js";
	}

?>

"></script>
<script src="<?php echo DIRPAGE."/public/js/post.js";?>"></script>
<?php if($_SESSION){
$dir = DIRPAGE."/public/js/createPost.js";
echo "<script src='{$dir}'></script>";	
	}?>
    </footer>
</body>
</html>
