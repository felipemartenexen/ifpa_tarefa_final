<?php

$page_title = "Registration";

include 'includes/header.html';

include 'includes/navbar.html';

if (isset ($_SESSION['username'])){
	echo "Usuário entrou como '" . $_SESSION['username'] . "'. Você pode <a href='logout.php'>Sair</a>";
}
else{

?>
<div class="container-left">
<form action="check_registration.php" method="POST">
    Nome:<br>
    <input type="text" name="username"><br>
    Senha:<br>
    <input type="password" name="pass"><br><br>
    <input type="submit" value="Registrar">
</form>
</div>

<?php

include 'includes/footer.html';

}

?>