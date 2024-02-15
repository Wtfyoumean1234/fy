<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "format.php"?>
</head>
<body>
    <div class="insert">
        <h3>創建帳號</h3><br>
        <form action=<?php echo basename(__FILE__)?> method="post">
            <label for="a">帳號</label><input type="text" name="account" id="a"><br>
            <label for="b">密碼</label><input type="password" name="password" id="b"><br>
            <label for="b">確認密碼</label><input type="password" name="con_password" id="b"><br>
            <button type="submit" name="s_b" value="acc" id="c">創建</button><br>
        </form>
        <p id="d">
        <?php
            function noaccount(){
                echo "沒有帳號<br>";
            }
            function nopass(){
                echo "沒有密碼<br>";
                echo '<script>
                        var x=document.getElementById("a");
                        x.value="'.$_POST["account"].'";
                    </script>';
            }
            function noconpass(){
                echo "請確認密碼<br>";
                echo '<script>
                        var x=document.getElementById("a");
                        var y=document.getElementById("b");
                        x.value="'.$_POST["account"].'";
                        y.value="'.$_POST["password"].'";
                    </script>';
            }
            function passlen(){
                echo "密碼長度需介於8至15個字";
                echo '<script>
                        var x=document.getElementById("a");
                        x.value="'.$_POST["account"].'";
                    </script>';
            }
            function after(){
                if (!isset($_POST["password"])){
                    nopass();
                }
                elseif ($_POST["password"]==""){
                    nopass();
                }
                elseif(strlen($_POST["password"])<8 || strlen($_POST["password"])>15){
                    passlen();
                }
                elseif(!isset($_POST["con_password"])){
                    noconpass();
                }
                elseif($_POST["con_password"]==""){
                    noconpass();
                }
                elseif($_POST["password"]!=$_POST["con_password"]){
                        echo "輸入密碼與確認密碼不相同<br>";
                        echo '<script>
                                var x=document.getElementById("a");
                                x.value="'.$_POST["account"].'";
                            </script>';
                }
                else{
                        return true;   
                    }
                }

            session_start();
            $_SESSION["in"]=true;
            if (!isset($_SESSION["in"])){
                $_SESSION["in"]=true;
            }
            else{
                if (!isset($_POST["s_b"])){
                    session_destroy();
                }
                elseif($_POST["s_b"]!="acc"){
                    session_destroy();
                }
                elseif (!isset($_POST["account"])){
                    noaccount();
                }
                elseif($_POST["account"]==""){
                    noaccount();
                }
                else {
                    $db=new SQLite3("accounts.db");
                    $result=$db->query('select * from "accounts"');
                    $account_exists = false;
                    $power=null;
                    while($row = $result->fetchArray()) {
                        if ($_POST["account"]==$row["account"]){
                            echo "此帳號已存在<br>";
                            $account_exists = true;
                            $power=$row["POWER"];
                            break;
                        }
                    }
                    $db->close();
                    if (!$account_exists) {
                        if (after()) {
                            $db=new SQLite3("accounts.db");
                            $stmt=$db->prepare('insert into "accounts" ("account","password","POWER") values(:variable1,:variable2,0)');
                            $stmt->bindParam(":variable1",$_POST["account"],SQLITE3_TEXT);
                            $stmt->bindParam(":variable2",$_POST["password"],SQLITE3_TEXT);
                            $stmt->execute();
                            $db->close();
                            $_SESSION["account"]=$_POST["account"];
                            setcookie("account",$_POST["account"],time()+86400,"/");
                            setcookie("expire",time()+86400,time()+86400,"/");
                            setcookie("power",$power,time()+86400,"/");
                            setcookie("islogin","true",time()+86400,"/");
                            header("Location: main.php");
                            exit;
                        }
                    }
                }
            }
        ?></p>
        <a href="insert_account.php" id="e">有帳號點這裡</a>
    </div>
</body>
</html>