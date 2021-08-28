<?php

function dbConnection(){
    $hostName = "msit-devops-db.c7uzlidaqpu2.ap-southeast-1.rds.amazonaws.com";
    $port = "3306";
    $dbName    = "parking-lot";
    $userName   = "panharith";
    $password   = "msitdevops";
    try{
        $dbConn = new PDO("mysql:host=$hostName; port=$port; dbname=$dbName", $userName, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConn;
    }
    catch(PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }

}

function getAll() {
    $conn       = dbConnection();
    $strQuery   = "SELECT * FROM parkings";
    $resultSet  = $conn->query($strQuery);
    $data       = $resultSet->fetchAll(PDO::FETCH_ASSOC);
       
    $conn = null;
    return $data;
}

function get($id){
    $conn = dbConnection();
    $strQuery = "SELECT * FROM parkings WHERE id=" . $id . ";";
    $result  = $conn->query($strQuery);
    $data = $result->fetch(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}

function store($params = []) {
    $conn    = dbConnection();
    $obj    = new StdClass();
    $stmt   = $conn->prepare("INSERT INTO parkings(plate_number, vehicle_type, check_in, check_out, parking_fee, status) VALUES(?,?,?,?,?,?)");
    $stmt->bindParam("ssssds", $obj->plate_number, $obj->vehicle_type, $obj->check_in, $obj->check_out, $obj->parking_fee, $obj->status);
    
    $obj->plate_name        = $params['plate_number'];
    $obj->vehicle_type      = $params['vehicle_type'];
    $obj->check_in          = $params['check_in'];
    $obj->check_out         = $params['check_out'];
    $obj->parking_fee       = $params['parking_fee'];
    $obj->status            = $params['status'];
    $stmt->execute();

    $conn = null;
    
    echo "<h3>Data successful inserted!";
}

function update($params = [], $id) {
    $conn = dbConnection();
    $stmt = $conn->prepare("UPDATE parkings SET plate_number=?, vehicle_type=?, check_in=?, check_out=?, parking_fee=?, status=? WHERE id=?");
    $stmt->bind_param("ssssdsi", $plate_number, $vehicle_type, $check_in, $check_out, $parking_fee, $status, $id);
        
    $plate_name        = $params['plate_number'];
    $vehicle_type      = $params['vehicle_type'];
    $check_in          = $params['check_in'];
    $check_out         = $params['check_out'];
    $parking_fee       = $params['parking_fee'];
    $status            = $params['status'];
        
    $conn = null;
}

function destroy($id) {
    $conn    = dbConnection();
    $obj    = new StdClass();
    $stmt   = $conn->prepare("DELETE FROM parkings WHERE id=?;");
    $stmt->bindParam("i", $obj->id);
    
    $obj->id                = $id;
    $stmt->execute();

    $conn = null;
    
    echo "<h3>Data successful updated!";
}

?>
