<?php
require_once 'Libros.php';
$host='localhost';
$user = 'root';
$password= '';
$database= 'libros';

/**
 * Consulta todos los autores en la base de datos
 * @return object Devuelve el objeto de la consulta si es correcto, de lo contrario devuelve null        
 *  */
function get_listado_autores(){    
    $object = new Libros();
    global $host, $user, $password, $database;
    $conect= $object->conexion($host, $user, $password, $database);  
    $lista_autores = $object->consultarAutores($conect);
    return $lista_autores;
}
/**
 * Consulta todos los libros de un autor
 * @param int $id identificador de autor
 * @return object Devuelve el objeto de la consulta si es correcto, de lo contrario devuelve null
 */
function get_datos_autor($id){
    $object = new Libros();
    global $host, $user, $password, $database;
    $conect= $object->conexion($host, $user, $password, $database);  
    $info_libro = $object->consultarLibros($conect, $id);

    //Buscamos los datos personales del autor
    $datos_personales = $object->consultarAutores($conect, $id);
   
    $info_autor = new stdClass();
    $info_autor->datos = $datos_personales;
    $info_autor->libros = $info_libro;
    

    
    return $info_autor;
}
/** 
 *   Consulta todos los libros en la base de datos
 *   @return object Devuelve el objeto de la consulta si es correcto, de lo contrario devuelve null
 */
function get_listado_libros(){
    $object = new Libros();
    global $host, $user, $password, $database;
    $conect= $object->conexion($host, $user, $password, $database);  
    
    $lista_libro = $object->consultarLibros($conect);
    
    return $lista_libro;
}

/**
 * Consulta los datos de un libro en específico por id
 * @param int $id_libro Id del libro
 * @return object Devuelve el objeto de la consulta si es correcto, de lo contrario devuelve null 
 */
function get_datos_libro($id){
    $object = new Libros();
    global $host, $user, $password, $database;
    $conect= $object->conexion($host, $user, $password, $database);   
    
    $datos_libro = array();
    //Busca los datos de l libro
    $query_1 = "SELECT titulo, f_publicacion FROM libro WHERE {$id} = id";
    
    $res_1 = $conect->query($query_1);
    if($res_1->num_rows == 0){
        echo " El ID que ingresaste no existe, intenta con uno diferente ";
        $datos_libro = null;
    }else{    
        $datos_libro = $res_1->fetch_object();
        $datos_libro->f_publicacion = fecha($datos_libro->f_publicacion);
    }
    $res_1->free();
    
    //Busca los datos del autor
    $datos_autor = array();
    $query_2 = "SELECT autor.nombre, autor.apellidos, autor.id FROM autor INNER JOIN libro ON autor.id = libro.id_autor WHERE libro.id={$id}";
    
    $res_2 = $conect->query($query_2);
    if($res_2->num_rows == 0){
        echo " El ID que ingresaste no existe, intenta con uno diferente ";
        $datos_autor = null;
    }else{    
        $datos_autor = $res_2->fetch_object();
    }
    $res_2->free();
    $conect->close();
    //creamos clase 
    $todos_datos = new stdClass();
    $todos_datos->libro = $datos_libro;
    $todos_datos->autor = $datos_autor;
    
    return $todos_datos;
    
}


$posibles_URL = array("get_listado_autores", "get_datos_autor", "get_listado_libros", "get_datos_libro");

$valor = "Ha ocurrido un error";

if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL))
{
  switch ($_GET["action"])
    {
      case "get_listado_autores":
        $valor = get_listado_autores();
        break;
      case "get_datos_autor":
        if (isset($_GET["id"]))
            $valor = get_datos_autor($_GET["id"]);
        else
            $valor = "Argumento no encontrado";
        break;
      case "get_listado_libros":
          $valor= get_listado_libros();
          break;
      case "get_datos_libro":
          if (isset($_GET["id"]))
            $valor = get_datos_libro($_GET["id"]);
        else
            $valor = "Argumento no encontrado";
          break;
    }
}

//devolvemos los datos serializados en JSON
exit(json_encode($valor));
?>
