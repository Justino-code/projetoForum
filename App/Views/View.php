<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->getTitle();?></title>
    <link rel="stylesheet" href=<?php echo DIRPAGE."/public/css/style.css";?>>
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <div class="header-container">
            <div class="logo">
	    <img src=<?php echo DIRPAGE."/public/img/logo2.png"?> alt="Logotipo do Fórum"> <!-- Substitua pelo caminho do seu logotipo -->
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="home">Início</a></li>
                    <li><a href="post">Tópicos</a></li>
                    <li><a href="user">Usuários</a></li>
		    <li><a href="about">Sobre</a></li>
		<li><a href='home/register'>Login</a></li>
                </ul>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Pesquisar...">
            </div>
        </div>
        <?php echo $this->renderHeader();?>
    </header>

    <!-- Conteúdo principal -->
    <main>
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
    </footer>
</body>
</html>
