<?php
    include('./resources/db.php');
    $dbObj=new dbConnection();
    $dataObj=new createDataQuery();
    $taskObj=new createTaskQuery();
    $taskCatObj=new taskCategoryQuery();
    $roleObj=new UserRoleQuery();
    $dbObj->connectDb();
    $dataObj->selectAllData();
    var_dump($dataObj);
    echo "</br>";
    $taskObj->selectAllData();
    var_dump($taskObj);
    echo "</br>";
    $taskCatObj->selectAllData();
    var_dump($taskCatObj);
    echo "</br>";
    $roleObj->selectAllData();
    var_dump($roleObj);
    echo "</br>";
    $dataResult=mysqli_query($dbObj->con,$dataObj->myQuery);
    var_dump($dataResult);
    echo "</br>";
    $taskResult=mysqli_query($dbObj->con,$taskObj->myQuery);
    var_dump($taskResult);
    echo "</br>";
    $taskCatResult=mysqli_query($dbObj->con,$taskCatObj->myQuery);
    var_dump($taskCatResult);
    echo "</br>";
    $roleResult=mysqli_query($dbObj->con,$roleObj->myQuery);
    var_dump($roleResult);
    echo "<hr/>";
    while($dataRow=$dataResult->fetch_assoc()){
        var_dump($dataRow);
        echo "</br>";
    }
    echo "<hr/>";
    while($taskRow=$taskResult->fetch_assoc()){
        var_dump($taskRow);
        echo "</br>";
    }
    echo "<hr/>";
    while($taskCatRow=$taskCatResult->fetch_assoc()){
        var_dump($taskCatRow);
        echo "</br>";
    }
    echo "<hr/>";
    while($roleRow=$roleResult->fetch_assoc()){
        var_dump($roleRow);
        echo "</br>";
    }
    echo "<hr/>";
    echo "</br>";
    echo "</br>";
    echo "</br>";


?>  