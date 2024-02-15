<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "format.php"?>
</head>
<body>
    <div class="insert">
        <h3>登入</h3><br>
        <form action=<?php echo basename(__FILE__); ?> method="post">
            <label for="a">帳號</label><input type="text" name="account" id="a"><br>
            <label for="b">密碼</label><input type="password" name="password" id="b"><br>
            <button type="submit" name="s_b" value="acc" id="c">登入</button><br>
        </form>
        <button onclick=guess() id="c" style="margin-top:15px;width:70px;">訪客模式</button>
        <p id="d"><?php
        setcookie("expire","",time()-10,"/");
        setcookie("account","",time()-10,"/");
        setcookie("power","",time()-10,"/");
        setcookie("islogin","",time()-10,"/");
    function noaccount(){
        echo "沒有帳號<br>";
    }
    function nopass(){
        echo "沒有密碼<br>";
        if (isset($_POST["account"])){
            echo '<script>
                    var x=document.getElementById("a");
                    x.value="'.$_POST["account"].'";
                </script>';
        }
    }
    function passwrong(){
        echo  "密碼錯誤";
        if (isset($_POST["account"])){
            echo '<script>
                    var x=document.getElementById("a");
                    x.value="'.$_POST["account"].'";
                </script>';
        }
    }
    function after(){
        if (!isset($_POST["password"])){
            nopass();
        }
        elseif ($_POST["password"]==""){
            nopass();
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
            $account_exist=false;
            $truepass=null;
            $power=null;
            while ($row=$result->fetchArray()){
                if ($_POST["account"]==$row["account"]){
                    $account_exist=true;
                    $truepass=$row["password"];
                    $power=$row["POWER"];
                    break;
                }
            }
            if ($account_exist){
                if (after()){
                    if ($_POST["password"]==$truepass){
                        setcookie("expire",time()+86400,time()+86400,"/");
                        setcookie("account",$_POST["account"],time()+86400,"/");
                        setcookie("power",$power,time()+86400,"/");
                        setcookie("islogin","true",time()+86400,"/");
                        header("Location: main.php");
                        exit;
                    }
                    else{
                        passwrong();
                    }
                }
            }
            else{
                echo "帳號不存在";
            }
            $db->close();
        }
    }
    ?></p>
    
        <a href="add_account.php" id="e">沒帳號點這裡</a>
    </div>
    <script>
        function guess(){
            document.cookie="account="+'<?php 
                $db=new SQLite3("accounts.db");
                $rel=$db->query('select count(*) from "accounts"');
                $row=$rel->fetchArray();
                $rnum=$row[0];
                $randnum=rand(100000,1000000000);
                echo "player".strval($rnum*$randnum%1000000)?>'+";";
            document.cookie="expire="+<?php echo time()+86400?>+";";
            document.cookie="power=0;"
            document.cookie="islogin=false;"
            window.location.href="main.php"
        }
    </script>
</body>
</html>