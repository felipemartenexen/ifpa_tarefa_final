<?php

$page_title = 'Login';

include 'includes/header.html';

include 'includes/navbar.html';

if (isset ($_SESSION['username'])){
	echo "Usuário Entrou! Você pode " . "<a href='logout.php'>" . "Sair" . "</a>";
}
else{
?>

<div class="container-left">
<form action="check_login.php" method="POST">
    Nome:<br>
    <input type="text" name="username"><br>
    Senha:<br>
    <input type="password" name="pass"><br><br>
    <input type="submit" value="Entrar">
</form>
</div> <!-- end of <div class="container-left"> -->

<?php
}

include 'includes/footer.html';



?>

