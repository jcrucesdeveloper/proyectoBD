<! DOCTYPE html>
<html>
    <head>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    </head>
<body>
    <?php
        // \t es tab, \n es new line, . es para concatenar strings.
        echo "<table> \n";
        echo "\t\t <tr> \n"
        echo "\t\t\t <th> columna 1 </th> \n";
        echo "\t\t\t <th> columna 2 </th> \n";
        echo "\t\t </tr> \n";

        class TableRows extends RecursiveIteratorIterator {
            function __construct($it) {
                parent::__construct($it, self::LEAVES_ONLY);
            }
            function current() {
                return "\t\t\t<td>" . parent::current() . "</td>\n";
            }
            function beginChildren() {
                echo "\t\t <tr> \n";
            }
            function endChildren() {
                echo "\t\t </tr> \n";
            }
        }

        try {
           $pdo = new PDO('pgsql:
                           host=localhost;
                           port=5432;
                           dbname=cc3201;
                           user=webuser;
                           password=password_de_webuser');
           $variable1 = $_GET['input1'];
	       $variable2 = $_GET['input2'];
	       $variable3 = $_GET['input3'];
           $stmt = $pdo->prepare('SELECT *
                                  FROM esquema.tabla
                                  WHERE atributo1 = :valor1 
                                  AND   atributo2 = :valor2 
                                  AND   atributo3 = :valor3');
           $stmt->execute([ 'valor1' => $variable1,
                            'valor2' => $variable2, 
                            'valor3' => $variable3]);
           $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

           foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
               echo $v;
           }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
        echo  "\t </table> \n";
    ?>
</body>
</html>

