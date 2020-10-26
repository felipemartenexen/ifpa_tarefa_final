<?php
$page_title = "Adicionar Imagem";


if (isset ($_SESSION['username'])){
    header('location: index.php');
}
else{

    include 'mysqli_connect.php';

    include 'includes/header.html';

    include 'includes/navbar.html';

    include 'includes/navbar_pictures.html';

?>

<div class="container">
    <div class="container-left">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" accept="uploads/*" onchange="loadPicture(event)"> <br>
            <input type="submit" value="Inserir">
        </form>
    </div>
    <br>
    <div class="new-picture">
        <img id="showPicture">
    </div>

<?php

$target_dir = "uploads/";

if (!empty ($_FILES["fileToUpload"]["name"])){
   echo "fileToUpload " . $_FILES["fileToUpload"]["name"] . "<br>";
   $target_file = $target_dir . basename ($_FILES["fileToUpload"]["name"]);
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   // Verificar se a imagem é um arquivo de imagem
   if(isset($_POST["submit"])) {
       $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
       if($check !== false) {
           echo "O arquivo é uma imagem - " . $check["mime"] . ".";
           $uploadOk = 1;
       } else {
           echo "O arquivo não é uma imagem.";
           $uploadOk = 0;
       }
   }
   // Verificar se a imagem já existe
   if (file_exists($target_file)) {
       echo "Esta imagem já existe.";
       $uploadOk = 0;
   }
   // Verificar o tamanho da imagem
   if ($_FILES["fileToUpload"]["size"] > 500000) {
       echo "Imagem é muito grande.";
       $uploadOk = 0;
   }
   // Formatos de imagens permitidos
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
       echo "Somente JPG, JPEG, PNG e GIF são permitidos.";
       $uploadOk = 0;
   }
   // 
   if ($uploadOk == 0) {
       echo "Arquivo não inserido.";
       // Tentativa de upload
   } else {
       if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
           $picture_name = basename ($_FILES['fileToUpload']['name']);
           echo "O arquivo ". $picture_name . " foi inserido.";
           $username = $_SESSION['username'];
           $sql1 = "SELECT users_id FROM users WHERE users_username = '{$username}'";
           $result1 = mysqli_query ($connection, $sql1) or die (mysqli_error ($connection));

           if (mysqli_num_rows ($result1) > 0){
               while ($row = mysqli_fetch_assoc ($result1)){
                   $users_id = $row['users_id'];
                   $sql2 = "INSERT INTO pictures (pictures_name, id_users) VALUES ('{$picture_name}', '{$users_id}')";
                   $result2 = mysqli_query ($connection, $sql2) or die (mysqli_error ($connection));
                   if ($result2){
                       echo "Nova imagem adicionada!";
                   }
                   else{
                       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                   }
               }
           }
       }
       else {
           echo "Ocorreu um erro no processo.";
       }
   }
}//end of first if (!empty ($_FILES["fileToUpload"]["name"]){

mysqli_close ($connection);
unset ($connection);

}
?>

<script src="javascript/index.js"></script>

<?php

include 'includes/footer.html';

?>
