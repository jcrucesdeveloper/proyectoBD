<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
            <title>Consultas loleras</title>

            <style>
                .b {
                    font-weight: bold;
                }
            </style>


    </head>
    <body>

        <div class="container p-5">
            <h3 class="fw-bolder b"> <a href="./" style="font-size:1.2em; margin: 30px;"><</a>Bienvenido a nuestras consultas loleras 🤖</h1>
            <hr>

            <div class="container">

          
         
              <div>

              </div>


            </div>
            <p>
                Proyecto de base de datos realizados por Jorge Cruces y Tomas Vatel. 
            </p>

    <?php
         try {

           $campeon = $_GET["campeon"];
           $pdo = new PDO('pgsql:
                           host=localhost;
                           port=5432;
                           dbname=cc3201;
                           user=cc3201;
                           password=cacatua123');
            
            $stmt = $pdo->prepare("SELECT COUNT(*) AS conteo
            FROM teambans
            WHERE championid = (SELECT id FROM champs
            WHERE nombre=:campeon);");
            $stmt->bindValue(':campeon', $campeon); // Se enlaza al valor Morgan
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
         }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    ?>
            <h3 class="b"> Resultados consulta # 1: Cuantas veces fue baneado el campeon <?php isset($_GET["campeon"]) ? print $_GET["campeon"] : ""; ?>? </h3>
            <table class="table">
            <thead>
            <tr>
                <th scope="col">Nombre de campeon</th>
                <th scope="col">Veces baneado </th>
            </tr>
            </thead>
            <tbody>
                <?php
            while ($row = $stmt->fetch()){

                    echo '<tr>';
                    echo '<th scope="row">' .  $campeon.'</th>';
                    echo '<td>' .$row["conteo"] . '</td>';
                    echo '</tr>';

            }
                ?>
            </tbody>
            </table>

        
   
        <scripts>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>
            <script
                src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                crossorigin="anonymous"></script>
            <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                crossorigin="anonymous"></script>
        </scripts>
    </body>
</html>

