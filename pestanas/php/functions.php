<?php

//funciones para abrir y cerrar conexiones

function connection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tienda_ropa";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return [];
}

function closeConn($conn)
{
    return $conn = null;
}

//---------------------CONSULTA DE INICIO DE LOG EN CLIENTE---------------------

function getNumberUserIfExists($conn, $number_user, $password)
{
    try {
        $valid = true;
        $stmt = $conn->prepare("SELECT ID_CLIENTE FROM cliente WHERE ID_CLIENTE =:user AND CONTRASENA= :password");
        $stmt->bindParam('user', $number_user);
        $stmt->bindParam('password', $password);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $valid = false;
        }
        return $valid;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return [];
}

//funcion crear cookie con valor numero de usuario
function createUserCookie($user)
{
    setcookie('name', $user, time() + (86400 * 30), "/");
}

//funcion crear basket cookie
function createBasketCookie()
{
    $basket = array();
    setcookie('basket', serialize($basket), time() + (86400 * 30), "/");
}

//funciones para comprobar si existe ya una cookie y cookie de compra
function basketCookieExists()
{
    if (isset($_COOKIE['basket'])) {
        return true;
    } else {
        return false;
    }
}

function userCookieExists()
{
    if (isset($_COOKIE['name'])) {
        return true;
    } else {
        return false;
    }
}

//funciones de logout
function closeCookieLogOut()
{
    if (isset($_COOKIE['name'])) {
        unset($_COOKIE['name']);
        setcookie('name', null, -1, '/');
    }
}

function closeCookieBasket()
{
    if (isset($_COOKIE['basket'])) {
        unset($_COOKIE['basket']);
        setcookie('basket', '', time() - 3600, '/');
    }
}
//---------------------REGISTRO DE USUARIOS
function insertClient($conn, $nombre, $apellido, $email, $direc, $telef)
{
    try {
        $stmt = $conn->prepare("INSERT INTO CLIENTE (NOMBRE,APELLIDO,EMAIL,DIRECCION,CONTRASENA,TELEFONO) VALUES (:nombre,:apellido,:email,
    :direccion,:contrasena,:telefono)");
        $stmt->bindParam('nombre', $nombre);
        $stmt->bindParam('apellido', $apellido);
        $stmt->bindParam('email', $email);
        $stmt->bindParam('direccion', $direc);
        $stmt->bindParam('contrasena', $apellido);
        $stmt->bindParam('telefono', $telef);
        $stmt->execute();
        echo "Se ha dado de alta al cliente</br>";
    } catch (PDOException $e) {
        echo $e->getCode();
        if ($error = '2300') {
            echo "NO SE PUEDE DAR DE ALTA <BR>";
        }
    }
}
function getIdNewClient($conn,$nombre,$apellido){
    try {
        $stmt = $conn->prepare("SELECT ID_CLIENTE FROM CLIENTE WHERE NOMBRE=:nombre AND CONTRASENA=:contrasena");
        $stmt->bindParam('nombre', $nombre);
        $stmt->bindParam('contrasena', $apellido);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $resultado=$stmt->fetchAll();
        return $resultado[0][0];
    } catch (PDOException $e) {
        echo $e->getCode();
        if ($error = '2300') {
            echo "NO SE PUEDE DAR DE ALTA <BR>";
        }
    }

}
////---------------------------EJERCICIO 2---------------------------
////informacion de productos cuyo stock sea mayor que cero
//function getInfoProducts($conn)
//{
//    try {
//        $stmt = $conn->prepare("SELECT productCode , productName FROM products  WHERE quantityInStock >0");
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        return $stmt->fetchAll();
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////obtener el ordERnUMBER MAXIMO
//function getMaxOrderNumber($conn)
//{
//    try {
//        $stmt = $conn->prepare("SELECT MAX(orderNumber)FROM orders");
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_NUM);
//        $result = $stmt->fetchAll();
//        return $result[0][0];
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////realizar insert en tabla order
//function addOrder($conn, $customerNumber)
//{
//    try {
//        //incrementamos en uno e order max, será la nueva orden orderNumber++
//        $ordernumber = getMaxOrderNumber($conn) + 1;
//        $date = date("Y-m-d");
//        $status = "pending";
//        $stmt = $conn->prepare("INSERT INTO orders (orderNumber, orderDate, requiredDate,status,customerNumber)
//    VALUES (:ordernumber,:orderdate,:requireddate,:status,:customernumber)");
//        $stmt->bindParam('ordernumber', $ordernumber);
//        $stmt->bindParam('orderdate', $date);
//        $stmt->bindParam('requireddate', $date);
//        $stmt->bindParam('status', $status);
//        $stmt->bindParam('customernumber', $customerNumber);
//        $stmt->execute();
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////funcion para buscar el precio de un producto
//function findPricerOfProduct($conn, $product)
//{
//    try {
//        $stmt1 = $conn->prepare("SELECT products.buyPrice FROM products,orderdetails WHERE products.productCode=orderdetails.productCode
//        AND products.productCode=:product");
//        $stmt1->bindParam('product', $product);
//        $stmt1->execute();
//        $stmt1->setFetchMode(PDO::FETCH_NUM);
//        $result = $stmt1->fetchAll();
//        return $result[0][0];
//
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////funcion para insertar datos de la orden en orderdetails de cada producto
//function addOrderAnDetails($conn, $product, $quantity, $orderLineNumber)
//{
//    try {
//        $price = findPricerOfProduct($conn, $product);
//        $result = getMaxOrderNumber($conn);
//        $stmt = $conn->prepare("INSERT INTO orderdetails  (orderNumber,productCode,quantityOrdered,priceEach,orderLineNumber) VALUES (:ordernumber,:productcode,:quantityordered,:priceeach,:orderlineNumber)");
//        $stmt->bindParam(':ordernumber', $result);
//        $stmt->bindParam(':productcode', $product);
//        $stmt->bindParam(':quantityordered', $quantity);
//        $stmt->bindParam(':priceeach', $price);
//        $stmt->bindParam(':orderlineNumber', $orderLineNumber);
//        $stmt->execute();
//    } catch (PDOException $e) {
//        echo $e->getCode();
//    }
//}
//
////funciones para comprobar que existe en stock los productos pedidos
//function isQuantityEnough($conn, $product, $quantity)
//{
//    $valid = true;
//    //llamamos a la funcion que nos indica el total de stock del producto
//    $total = getWarehousesTotalQuantity($conn, $product);
//    if ($total == 0) {
//        $valid = false;
//        echo "<p style='text-align: center;color: blue'>No hay disponibilidad del producto</p></br>";
//    }
//    if (!is_numeric($quantity)) {
//        $valid = false;
//        echo "<p style='text-align: center;color: red'>Por favor introduzca una cantidad correcta</p></br>";
//    } else if ($quantity > $total) {
//        $valid = false;
//        echo "<p style='text-align: center;color: blue'>No hay existencias suficientes</p></br>";
//    }
//    return $valid;
//}
//
////nos indica el total de stock del producto
//function getWarehousesTotalQuantity($conn, $product)
//{
//    try {
//        $stmt = $conn->prepare("SELECT quantityInStock FROM products where products.productCode=:id_producto");
//        $stmt->bindParam('id_producto', $product);
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_NUM);
//        $res = $stmt->fetchAll();
//        return $res[0][0];
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////realizamos la compra actualizando la tabla de producto restándole la cantidad que se pide en la orden
//function performPurchase($conn, $product, $quantity)
//{
//    $newQuantity = getWarehousesTotalQuantity($conn, $product) - $quantity;
//    try {
//        $stmt = $conn->prepare(" UPDATE products SET quantityInStock=:new_quantity WHERE products.productCode=:product");
//        $stmt->bindParam('new_quantity', $newQuantity);
//        $stmt->bindParam('product', $product);
//        $stmt->execute();
//
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
//// funcion para dejar vacia la basket cookie una vez realizada la compra
//function cleanCookieBasket()
//{
//    $basket = array();
//    setcookie('basket', serialize($basket), time() + (86400 * 30), "/");
//}
//
////validacion del numero check introducido por teclado
//function isvalidCheckNumber($number)
//{
//    $valid = true;
//    $letra = substr($number, 0, 2);
//    $numeros = substr($number, 2, 5);
//    if (strlen($number) == 7) {
//        if (!ctype_alpha($letra)) {
//            echo "<p style='color: red;text-align: center'>Error, los primeros caracteres deben de ser  letras</br></p>";
//            $valid = false;
//        } else if (!is_numeric($numeros)) {
//            echo "<p style='color: red;text-align: center'>Error, deben de ser  digitos los siete siguientes.</p></br>";
//            $valid = false;
//        }
//    } else {
//        $valid = false;
//        echo "<p style='color: red;text-align: center'>Error en longitud. El tamaño es de 7 caracteres</p>";
//    }
//    return $valid;
//}
//
//function getTotalAmount($conn, $basket)
//{
//    $amount = 0;
//    foreach ($basket as $key => $value) {
//        $price = findPricerOfProduct($conn, $key);
//        $amount += $value * $price;
//    }
//    return $amount;
//}
//
//function addPayment($conn, $customerNumber, $paymentNumber, $basket)
//{
//    try {
//        $date = date("Y-m-d");
//        $amount = getTotalAmount($conn, $basket);
//        $stmt = $conn->prepare("INSERT INTO payments  (customerNumber, checkNumber, paymentDate, amount) VALUES (:customerNumber,:checkNumber,:paymentDate,:amount)");
//        $stmt->bindParam(':customerNumber', $customerNumber);
//        $stmt->bindParam(':checkNumber', $paymentNumber);
//        $stmt->bindParam(':paymentDate', $date);
//        $stmt->bindParam(':amount', $amount);
//        $stmt->execute();
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////----------------------------------- EJERCICIO 3 --------------------------------------------------
////generar desplegable de todos los customers de la base de datos
//function getCustomersInfo($conn)
//{
//    try {
//        $stmt = $conn->prepare("SELECT customerNumber,creditLimit FROM customers");
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        return $stmt->fetchAll();
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////mostrar toda la  informacion de order details de manera ascendente del usuario
//function getOrderDetailsInfo($conn, $customerNumber)
//{
//    try {
//        $stmt = $conn->prepare("SELECT orders.orderNumber,orders.orderDate,orders.status,products.productName,orderdetails.orderLineNumber,
//    orderdetails.quantityOrdered,orderdetails.priceEach FROM customers,orders,orderdetails,products
//    WHERE customers.customerNumber=orders.customerNumber AND orders.orderNumber=orderdetails.orderNumber AND
//    orderdetails.productCode=products.productCode AND orders.customerNumber=:customerNumber order by orders.orderNumber,orderdetails.orderLineNumber");
//        $stmt->bindParam(':customerNumber', $customerNumber);
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        return $stmt->fetchAll();
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////imprimimos la informacion order details
//function printOrderInfo($orderInfo)
//{
//    echo "<table style='margin-left:auto;margin-right:auto'>";
//    echo "<tr>";
//    echo "<th>Order Number</th>";
//    echo "<th>Order Date</th>";
//    echo "<th>Status</th>";
//    echo "<th>Product Name</th>";
//    echo "<th>Order Line Number</th>";
//    echo "<th>Quantity Ordered</th>";
//    echo "<th>Price Each</th>";
//    echo "</tr>";
//
//    foreach ($orderInfo as $row) {
//        echo "<tr>";
//        echo "<td>" . $row["orderNumber"] . "</td>";
//        echo "<td>" . $row["orderDate"] . "</td>";
//        echo "<td>" . $row["status"] . "</td>";
//        echo "<td>" . $row["productName"] . "</td>";
//        echo "<td>" . $row["orderLineNumber"] . "</td>";
//        echo "<td>" . $row["quantityOrdered"] . "</td>";
//        echo "<td>" . $row["priceEach"] . "</td>";
//        echo "</tr>";
//    }
//    echo "</table>";
//}
//
////---------------------------------------------EJERCICIO 4-------------------------------------------------
////info de todos los productos sin restringir por stock, lo usamos para generar desplegable
//function getAllProducts($conn)
//{
//    try {
//        $stmt = $conn->prepare("SELECT productCode , productName FROM products");
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        return $stmt->fetchAll();
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////buscar el stock del producto elegido
//function getQuantityProducts($conn, $product)
//{
//    try {
//        $stmt = $conn->prepare("SELECT quantityInStock FROM products WHERE productCode=:productCode");
//        $stmt->bindParam('productCode', $product);
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_NUM);
//        $res = $stmt->fetchAll();
//        return $res[0][0];
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////-------------------------------EJERCICIO 5-------------------------
////listar todos los nombres de linea de productos
//function namesProductLine($conn)
//{
//    try {
//        $stmt = $conn->prepare("SELECT productlines.productLine FROM productlines");
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        return $stmt->fetchAll();
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
////lista todos los productos que pertenecen a una determinada linea de producto, indicando su cantidad
//function getToTalStockOfProductLine($conn, $productLine)
//{
//    try {
//        $stmt = $conn->prepare("SELECT productlines.productLine,products.productName,products.quantityInStock FROM products,productlines
//        WHERE products.productLine=productlines.productLine AND products.productLine=:productline ORDER BY quantityInStock DESC");
//        $stmt->bindParam('productline', $productLine);
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        return $stmt->fetchAll();
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
//function printInfoProductsLine($infoProductsLine)
//{
//    echo "<table style='margin-left:auto;margin-right:auto'>";
//    echo "<tr>";
//    echo "<th>Product Line</th>";
//    echo "<th>Product Name</th>";
//    echo "<th>Quantity In Stock</th>";
//    echo "</tr>";
//    foreach ($infoProductsLine as $row) {
//        echo "<tr>";
//        echo "<td>" . $row["productLine"] . "</td>";
//        echo "<td>" . $row["productName"] . "</td>";
//        echo "<td>" . $row["quantityInStock"] . "</td>";
//        echo "</tr>";
//    }
//    echo "</table>";
//}
//
////-------------------------------EJERCICIO 6---------------
////que muestre las unidades totales de cada uno de los productos vendidos entre dos fechas (orderDate).
//function geTotalUnitProductDate($conn, $date1, $date2)
//{
//    try {
//        $stmt = $conn->prepare("SELECT orderdetails.productCode,quantityOrdered FROM orders,orderdetails,products WHERE orders.orderNumber=orderdetails.orderNumber AND orderdetails.productCode=products.productCode
//        AND orderDate between :date1 AND :date2 order by productName");
//        $stmt->bindParam('date1', $date1);
//        $stmt->bindParam('date2', $date2);
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        $result = $stmt->fetchAll();
//        $info = array();
//        foreach ($result as $value) {
//            if (array_key_exists($value['productCode'], $info)) {
//                $info[$value['productCode']] += intval($value['quantityOrdered']);
//            } else {
//                $info[$value['productCode']] = $value['quantityOrdered'];
//            }
//        }
//        return $info;
//        //$result['total']=$total; //
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//    }
//    return [];
//}
//
//function printInfoGetUnitProductDate($info)
//{
//
//    echo "<table style='margin-left:auto;margin-right:auto'>";
//    echo "<tr><th>Product Code</th><th>Unidades</th></tr>";
//    foreach ($info as $key => $value) {
//        echo "<tr><td>$key</td><td>$value</td></tr>";
//    }
//    echo "</table>";
//}
//
////--------------------------------EJERCICIO 7 ----------------------------------------------------
////que  muestre  para  un  determinado cliente  la relación de pagos realizados entre dos fechas,así como el importe total de
////los mismos.
//function getInfoPaymentsDate($conn, $date1, $date2, $customerNumber)
//{
//    try {
//        $stmt = $conn->prepare("SELECT * FROM payments WHERE customerNumber=:customerNumber AND paymentDate between :date1 AND :date2 order by paymentDate");
//        $stmt->bindParam(':customerNumber', $customerNumber);
//        $stmt->bindParam('date1', $date1);
//        $stmt->bindParam('date2', $date2);
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        $result = $stmt->fetchAll();
//        $totalAmount = 0;
//        foreach ($result as $key => $value) {
//            $totalAmount += $value['amount'];
//        }
//
//        return array($result, $totalAmount);
//        //$result['total']=$total; //
//    } catch (PDOException $e) {
//        echo $e->getCode();
//        return [];
//    }
//
//}
//
////Si no se indicaran las fechas,la información sería el histórico de pagos de dicho cliente
//function getInfoPayments($conn, $customerNumber)
//{
//    try {
//        $stmt = $conn->prepare("SELECT amount,customerNumber,checkNumber,paymentDate FROM payments WHERE customerNumber=:customerNumber order by paymentDate");
//        $stmt->bindParam(':customerNumber', $customerNumber);
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        $result = $stmt->fetchAll();
//        $totalAmount = 0;
//        foreach ($result as $value) {
//            $totalAmount += $value['amount'];
//        }
//        //$result['totalAmount'] = $totalAmount;
//        return array($result, $totalAmount);
//        //$result['total']=$total; //
//    } catch (PDOException $e) {
//        echo $e->getMessage();
//        return [];
//    }
//
//}
//
//function printAllPayments($info)
//{
//    echo "<table style='margin-left:auto;margin-right:auto'>";
//    echo "<tr>";
//    echo "<th>Customer Number</th>";
//    echo "<th>Check Number</th>";
//    echo "<th>Payment Date</th>";
//    echo "<th>Amount</th>";
//    echo "</tr>";
//
//    foreach ($info[0] as $item) {
//        echo "<tr>";
//        echo "<td>" . $item['customerNumber'] . "</td>";
//        echo "<td>" . $item['checkNumber'] . "</td>";
//        echo "<td>" . $item['paymentDate'] . "</td>";
//        echo "<td>" . $item['amount'] . "</td>";
//        echo "</tr>";
//    }
//
//    echo "<tr>";
//    echo "<td colspan='3'>Total</td>";
//    echo "<td>" . $info[1] . "</td>";
//    echo "</tr>";
//
//    echo "</table>";
//}

//funcion para buscar el ultimo ordernumber

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

