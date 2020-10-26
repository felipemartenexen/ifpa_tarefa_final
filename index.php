<?php

$page_title = "Home";

include 'includes/header.html';

include 'includes/navbar.html';

if (isset ($_SESSION ['username'])){
	echo "Entrou como '" . $_SESSION['username'] . "'. Você pode <a href='logout.php'>sair</a>";
}
else{
	echo "Por favor " . "<a href='login.php'>Entrar</a>";
}

include 'includes/footer.html';
?>