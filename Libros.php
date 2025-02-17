<?php
/**
 * Cambia el formato de la fecha de sql.
 * @param date $fecha fecha obtenida de la base de datos Libros
 * @return date formato de fecha modificado
  */
    function fecha($fecha) {
        return date('d/m/Y', strtotime($fecha));
    }
        
    class Libros{
        private $host='localhost';
        private $user = 'root';
        private $password= '';
        private $database= 'libros';
/**
 * Conecta con la base de datos
 * @param string $servidor Es el servidor en donde se encuentra la base de datos
 * @param string $usuario Nombre de usuario para acceder a la base da datos
 * @param string $contrasena Contraseña de acceso a la base de datos
 * @param string $bd Nombre de la base de datos
 * @return object Devuelve el objeto de conexion si es correcto, de vlo contrario devulve null
 */        
        function conexion($servidor, $usuario, $contrasena, $bd){
            try{
                $conection = new mysqli($servidor, $usuario, $contrasena, $bd);
                
                if(!$conection){
                    $conection= null;
                }
            return $conection;   
            
            } catch (mysqli_sql_exception $ex) {
                echo $ex->getMessage();
            }
                
        }
/**
 * Consulta todos los autores o un autor por id, en la base de datos
 * @param object $conect Objeto de conexion con la base de datos
 * @param int $id_autor Id del autor
 * @return object Devuelve el objeto de la consulta si es correcto, de lo contrario devuelve null
 */            
        //funcion con parametro predeterminado
        function consultarAutores($conect, $id_autor= null){
            try{
                $info = array();
                $conect = $this->conexion($this->host,$this->user, $this->password, $this->database);
                if($id_autor == null){
                    $query = "SELECT * FROM autor" ;
                    $res = $conect->query($query);

                    while ($fila = $res->fetch_object()){                        
                        $info[] = $fila;
                    }
                        $res->free();
                        $conect->close();                    
                    
                }else{
                    $query = "SELECT * FROM autor WHERE id = {$id_autor}" ;
                    $res = $conect->query($query);                  
                        //comprueba que el id existe. Sino existe, devuelve num_rows == 0
                        if($res->num_rows == 0){
                            echo " El ID que ingresaste no existe, intenta con uno diferente ";
                            $info = null;
                        }
                            
                            $fila = $res->fetch_object();
                            $info = $fila;
 
                        
                    $res->free();
                    $conect->close();                           
                        
                    }
                                
            return $info; 

            } catch (Exception $ex) {
                //echo $ex->getMessage();
                return null;
            }
            
        }
/**
 * Consulta todos los libros o un libro por id, en la base de datos
 * @param object $conect Objeto de conexion con la base de datos
 * @param int $id_autor Id del autor
 * @return object Devuelve el objeto de la consulta si es correcto, de lo contrario devuelve null
 */        
        function consultarLibros($conect, $id_autor= null){
            try{
                $info =array();
                //$conect = $this->conexion($this->host,$this->user, $this->password, $this->database);

                if($id_autor == null){
                    $query = "SELECT * FROM libro";

                    $res = $conect->query($query);

                    while($fila = $res->fetch_object()){                        
                        $fila->f_publicacion = fecha($fila->f_publicacion);
                        $info[] = $fila;
                    }
                    $res->free();
                    $conect->close();
                }else{
                    $query = "SELECT * FROM libro WHERE {$id_autor} = id_autor";
                    $res =$conect->query($query);

                    if($res->num_rows == 0){
                            echo " El ID que ingresaste no existe, intenta con uno diferente ";
                            $info = null;
                        }

                    while($fila = $res->fetch_object()){                        
                        $fila->f_publicacion = fecha($fila->f_publicacion);
                        $info[] = $fila;                        
                    }
                    $res->free();
                    $conect->close();
                } 
                return $info;
            } catch (Exception $ex) {
                //echo $ex->getMessage();
                return null;
            }                                     
            
        }
/**
 * Consulta los datos de un libro en específico por id
 * @param object $conect Objeto de conexion con la base de datos
 * @param int $id_libro Id del libro
 * @return object Devuelve el objeto de la consulta si es correcto, de lo contrario devuelve null 
 */       
        function consultarDatosLibro($conect, $id_libro = null){
            try{
                //$conect = $this->conexion($this->host,$this->user, $this->password, $this->database);
                $info = array();
                
                if($id_libro == null){
                    return null;
                    $conect->close();
                }else{
                    $query = "SELECT * FROM libro WHERE id = {$id_libro}";

                    $res = $conect->query($query);

                    if($res->num_rows == 0){
                        echo " El ID que ingresaste no existe, intenta con uno diferente ";
                        return null;
                        $res->free();
                        $conect->close();
                    }else{
                        $row = $res->fetch_object();                        
                        $row->f_publicacion = fecha($row->f_publicacion);
                        $res->free();
                        $conect->close();
                    }  
                }               
                 
            return $row;   

            } catch (Exception $ex) {
                //echo $ex->getMessage();
                $info = null;
            }
          
        }
 
}    

?>

