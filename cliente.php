<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API DWES</title>
 <body>

<?php
// Si se ha hecho una peticion que busca informacion de un autor "get_datos_autor" a traves de su "id"...
if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_autor") 
{
    //Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
    $app_info = file_get_contents('http://localhost/simpleLibrary/api.php?action=get_datos_autor&id=' . $_GET["id"]);
    // Se decodifica el fichero JSON y se convierte a array
    //var_dump($app_info);
    $app_info = json_decode($app_info);
    
    ?>  
     <div class="autor">
        <h2>Datos de Autor</h2>
	<p>
		<td>Nombre: </td><td> <?php echo $app_info->datos->nombre; ?></td>
	</p>
	<p>
		<td>Apellidos: </td><td> <?php echo $app_info->datos->apellidos; ?></td>
	</p>
	<p>
		<td>Fecha de nacimiento: </td><td> <?php echo $app_info->datos->nacionalidad; ?></td>
	</p>
    </div>
     <ul class="libros-de-autor">
    <!-- Mostramos los libros del autor -->
    <h2>Libros escritos por este Autor</h2>
    <?php foreach($app_info->libros as $libro): ?>
        <li>
            
            <a href="<?php echo "http://localhost/simpleLibrary/index.php?action=get_datos_libro&id=" . $libro->id  ?>">   
            <?php echo $libro->titulo; ?>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>	
    <br />
    <!-- Enlace para volver a la lista de autores -->
    <a href="http://localhost/simpleLibrary/index.php?action=get_listado_autores" alt="Lista de autores" class="volver">Volver a la lista de autores</a>
    <!--Imprimimos datos especificado del libro -->
<?php }else if(isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_libro") {
            //Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
            $app_info = file_get_contents('http://localhost/simpleLibrary/api.php?action=get_datos_libro&id=' . $_GET["id"]);
            //decodificar JSON, a array
            $app_info = json_decode($app_info);
?>
    <div class="datos-libro">
        <h2>Datos del libro</h2>
        <p>Título: <?php echo $app_info->libro->titulo; ?></p>
        <p>Fecha de Publicación: <?php echo $app_info->libro->f_publicacion; ?></p>
        </br>
    </div>
    <div class="autor-libro">
    <a href="<?php echo "http://localhost/simpleLibrary/index.php?action=get_datos_autor&id=" . $app_info->autor->id  ?>">
    <h2>Datos de su autor</h2>
    <p>Nombre: <?php echo $app_info->autor->nombre; ?></p>
    <p>Apellidos: <?php echo $app_info->autor->apellidos; ?></p>
    </a>
    </div>
    </br>
    <a href="http://localhost/simpleLibrary/index.php?action=get_listado_autores" alt="Lista de autores" class="volver">Volver a la lista de autores</a>

    
<?php
}
else //sino muestra la lista de autores
{
    // Pedimos al la api que nos devuelva una lista de autores. La respuesta se da en formato JSON
    $lista_autores = file_get_contents('http://localhost/simpleLibrary/api.php?action=get_listado_autores');
    // Convertimos el fichero JSON en array
	//var_dump($lista_autores);
    $lista_autores = json_decode($lista_autores);
    
    //Pedimos lista de libros
    $lista_libros = file_get_contents('http://localhost/simpleLibrary/api.php?action=get_listado_libros');
    //Convertimos JSON en array
    $lista_libros = json_decode($lista_libros);
?>
    <h1>Listas</h1>
    <div class="lista-1">
    <ul class="autores-lista">
        <h2>Autores</h2>
    <!-- Mostramos una entrada por cada autor -->
    <?php foreach($lista_autores as $autores): ?>
        <li>
            <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
            <a href="<?php echo "http://localhost/simpleLibrary/index.php?action=get_datos_autor&id=" . $autores->id  ?>">
            <?php echo $autores->nombre . " " . $autores->apellidos ?>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>
    
    <ul class="libros-lista">
        <h2>Libros</h2>
        <?php foreach ($lista_libros as $libros) { ?>
            <li>
                <a href="<?php echo "http://localhost/simpleLibrary/index.php?action=get_datos_libro&id=" . $libros->id  ?>">
            <?php echo $libros->id . " " . $libros->titulo ?>
            </a>
            </li>
        <?php } ?>
    </ul>
    </div>
  <?php
} ?>
    
 </body>
</html>
