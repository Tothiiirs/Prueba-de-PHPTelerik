<?php 
//AVISO: Es mejor usar comandos preparados en PHP.
//Esto proporciona protección contra la inyección de SQL.       
//              http://php.net/manual/en/pdo.prepared-statements.php
 
// obtener el ID de empleado de la petición. escapar de ella para proteger contra la inyección de SQL
$employeeID = mysql_real_escape_string($_REQUEST["filter"]["filters"][0]["value"]);    
$link = mysql_pconnect("localhost", "root", "12345678") or die("No puede conectarse a la Base de Datos");   
mysql_select_db("pruebasphp") or die("No puede conectarse a la Base de Datos pruebasphp");  
$arr = array(); 
$rs = mysql_query("SELECT TRIM(t.TerritoryDescription) AS TerritoryDescription 
					FROM territories t                 
                    INNER JOIN employeeTerritories et ON t.TerritoryID = et.TerritoryID                   
                    INNER JOIN employees e ON et.EmployeeID = e.EmployeeID           
                    WHERE e.EmployeeID = " .$employeeID);    

while($obj = mysql_fetch_object($rs)) { 
	$arr[] = $obj;
}
header("Content-type: application/json");  
echo "{\"data\":" .json_encode($arr). "}";   
?>
 