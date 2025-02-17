<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores y Libros</title>
    <style>
        h1{
            text-align: center;
            font-family: sans-serif;
            background-color: #5a59a2;
            color: #e7e7e7;
            border: 1px solid transparent;
            border-radius: 5px;
        }
        h2{
            font-family: sans-serif;
            color: #5a59a2;
        }
        li{
            list-style: none;
        }
        .volver{
            position: relative;
            top: 200px;
            float: right;
            padding: 10px;
            margin: 5px;
            background-color: lightgray;
        }
        li a, a{
            font-family: sans-serif;
            text-decoration: none;
        }
        p{
            font-family: sans-serif;
        }
        .autores-lista{
            margin-top: 80px;
            width: 13%;
            border: 1px solid gray;
            border-radius: 10px;
            padding-bottom: 30px;
            -webkit-box-shadow: 1px -2px 14px 6px rgba(171,171,171,0.47);
            -moz-box-shadow: 1px -2px 14px 6px rgba(171,171,171,0.47);
            box-shadow: 1px -2px 14px 6px rgba(171,171,171,0.47);
        }
        .libros-lista{
            width: 13%;
            border: 1px solid grey;
            border-radius: 10px;
            padding-bottom: 30px;
            -webkit-box-shadow: 1px -2px 4px 4px rgba(204,204,204,0.48);
            -moz-box-shadow: 1px -2px 4px 4px rgba(204,204,204,0.48);
            box-shadow: 1px -2px 4px 4px rgba(204,204,204,0.48);
        }
        .lista-1{
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-around;
            align-items: baseline;
        }
        .datos-libro, .autor-libro, .autor, .libros-de-autor{
            border: 1px solid grey;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px; 
            -webkit-box-shadow: 1px -2px 4px 4px rgba(204,204,204,0.48);
            -moz-box-shadow: 1px -2px 4px 4px rgba(204,204,204,0.48);
            box-shadow: 1px -2px 4px 4px rgba(204,204,204,0.48);
        }

        
        .lista-1 ul li, .libros-de-autor li{
            padding-top: 8px;
        }
        p a{
            position: absolute;
            top: 30px;
            color: whitesmoke;
            margin-left: 10px;
            font-family: sans-serif;
        }
        footer{
            position: absolute;
            bottom: 0px;
            width: 99%;
            background-color: grey;
        }
        footer p{
            color: whitesmoke;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <header class="header">        
        
    </header>
        
        <main>
            <?php require 'cliente.php'; ?>


        </main>
    </div>
    
    <p>
        <a href="DOCS/index.html">Documentación</a>
    </p>
    <footer>
        <p>Página elaborada por: Andrea Ariadna Goitía Rodríguez</p>
    </footer>
</body>
</html>


