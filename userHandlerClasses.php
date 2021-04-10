<?php
    #this file of php contain all the classes require for the change inside the user intefaces.
    include_once('db.php');

    class userChange{
        public static function handleAnyQuery($con,$query){
            $result=mysqli_query($con,$query);
            return $result;
        }
        public $makeChange;
        public function allowToChange($con,$query){
            $table=mysqli_query($con,$query);
            $row=$table->fetch_assoc();
            if($row['userRole']!="admin" && $row['userRole']!="manager"){
                $this->makeChange=TRUE;
                return $this->makeChange;
            }else{
                $this->makeChange=FALSE;
                return $this->makeChange;
            }
        }
    }
    //handle website members log in
    class handleUsers{
        
        public function loginUser($table,$email,$password){
            if($table){
                $result='Wrong Credentials';
                $valid=FALSE;
                session_start();
                while($row=$table->fetch_assoc()){
                    if($row['userEmail']==$email){
                        $dbObj=new dbConnection();
                        $roleObj=new UserRoleQuery();
                        $dbObj->connectDb();
                        $roleObj->selectWithRoleId($row['roleId']);
                        $roleTableResult=mysqli_query($dbObj->con,$roleObj->myQuery);
                        $rowRoleTable=$roleTableResult->fetch_assoc();
                        if($rowRoleTable['roleCategory']=="admin"){
                            if($row['userPassword']==$password){
                                $_SESSION['userRole']=$rowRoleTable['roleCategory'];
                                $_SESSION['userId']=$row['userId'];
                                $result="Location:mainInterface.php?home=true";
                                $valid=TRUE;
                            }else{
                                $result="Please Enter a Valid Password";
                                $valid=FALSE;
                            }
                        }elseif($rowRoleTable['roleCategory']=="manager"){
                            if($row['userPassword']==$password){
                                if($row['valid']=="yes"){
                                    $_SESSION['userRole']=$rowRoleTable['roleCategory'];
                                    $_SESSION['userId']=$row['userId'];
                                    $result="Location:managerInterface.php?home=true";
                                    $valid=TRUE;
                                }else{
                                    $result = "Your account is not approved!";
                                    $valid=FALSE;
                                }
                            }else{
                                $result="Please Enter a Valid Password";
                                $valid=FALSE;
                            }
                        }elseif($rowRoleTable['roleCategory']!="admin" && $rowRoleTable['roleCategory']!="manager"){
                            if($row['userPassword']==$password){
                                if($row['valid']=="yes"){
                                    $_SESSION['userId']=$row['userId'];
                                    $_SESSION['userRole']=$rowRoleTable['roleCategory'];
                                    $result="Location:staffInterface.php?home=true";
                                    $valid=TRUE;
                                }else{
                                    $result = "Your account is not approved!";
                                    $valid=FALSE;
                                }
                            }else{
                                $result="Please Enter a Valid Password";
                                $valid=FALSE;
                            }
                        }
                    }
                }
                return array($valid,$result);
            }
        }
    }
    // echo 'allclasses is working perfectly'
?>
