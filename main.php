<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
    <?php include "main_format.php";?>
</head>
<body>
    <br>
    <div class="setQ" style="opacity:0;"></div>
    <div class="setQ" style="opacity:0;margin-left:50px;"></div>
    <div id="accou">
    <p><?php
        if (!isset($_COOKIE["account"])){
            $db=new SQLite3("accounts.db");
            $rel=$db->query('select count(*) from "accounts"');
            $row=$rel->fetchArray();
            $rnum=$row[0];
            $randnum=rand(100000,1000000000);
            $db->close();
            $playername="player".strval($rnum*$randnum%1000000);
            setcookie("account",$playername,time()+86400,"/");
            setcookie("expire",time()+86400,time()+86400,"/");
            setcookie("power",0,time()+86400,"/");
            setcookie("islogin","true",time()+86400,"/");
        }
        echo $_COOKIE["account"];
    ?></p>
    </div>
    <div id="timer">您的剩餘時間為<span id="update"><?php
    $t=$_COOKIE["expire"]-time();
    $hr=intdiv($t,3600);
    $min=intdiv($t%3600,60);
    $sec=$t%60;
    echo $hr."小時".$min."分鐘".$sec."秒";
    ?></span></div>
    <?php
    if ($_COOKIE["islogin"]=="false"){
        echo '<button onclick=login() id="login">登入</button>';
    }
    else{
        echo '<button onclick=logout() id="login">登出</button>';
    }
    ?>
    <script>
        function login(){
            window.location.href="insert_account.php"
        }
        function logout(){
            document.cookie="account="+'<?php 
                $db=new SQLite3("accounts.db");
                $rel=$db->query('select count(*) from "accounts"');
                $row=$rel->fetchArray();
                $rnum=$row[0];
                $randnum=rand(100000,1000000000);
                $db->close();
                echo "player".strval($rnum*$randnum%1000000)?>'+";";
            document.cookie="expire="+<?php echo time()+86400?>+";";
            document.cookie="power=0;"
            document.cookie="islogin=false;"
            window.location.href="main.php"
        }
    </script>
    <script>//設定計時器
        var x=0;
        function u() {
            var times=<?php echo $_COOKIE["expire"]-time();?>;
            x+=1;
            if (times-x<=0){
                clearInterval(timer);
                window.location.href="runtimeError.php";
            }
            else if(times-x<=600){
                document.getElementsById("timer").style.color="rgba(200,0,0,0.8)";
            }
            document.getElementById("update").textContent=Math.floor((times-x)/3600)+"小時"+Math.floor((times-x)%3600/60)+"分鐘"+(times-x)%60+"秒";
        }
        timer=setInterval(u,1000);
    </script>
    <script>//處理keyboard
        document.addEventListener("keydown",function(event){
            var x=<?php echo $_COOKIE["power"];?>;
            if (event.key=='m' && event.ctrlKey && x==1){
                window.location.href="power.php";
            }
        })
    </script>
   <img src="QIM_logo.jpg" class="img"> 
    <button onclick=start() class="button">開始</button><br>
    <button onclick=set() class="button" style="margin-top:20px;">設定</button>
    
    <script>
        function set(){
            window.location.href="setting.php";
        }
        function start(){
            var x=document.getElementsByClassName("setQ")[0];
            var y=document.getElementsByClassName("setQ")[1];
            
            x.innerHTML="<h2>選擇難度</h2><br><button id='text'>簡單</button><button id='text'>中等</button><button id='text'>困難</button><button id='text'>無限</button>";
            y.innerHTML="<button id='text' onclick=back() style='height:50px;width:70px;left:10%;bottom;10%;top:10%;transform:translate(-10%,10%);'>返回</button>"
            x.style.opacity=1;
            x.style.zIndex=2;
            y.style.opacity=1;
            y.style.zIndex=2;
        }
    </script>
    <script>//更新width與height
        setInterval(function(){
            var x=document.getElementsByClassName("setQ")[0];
            var y=document.getElementsByClassName("setQ")[1];
            x.style.width=window.innerWidth+'px';
            x.style.height=window.innerHeight+'px';
            y.style.width='100px';
            y.style.height='100px';
            y.style.marginTop=(window.innerHeight-100)+'px';
            var divs=document.querySelectorAll(".gd");
            divs.forEach(function(div){
                div.style.width=intdiv(x.style.width*0.1,1)+'px';
                div.style.height=intdiv(x.style.height*0.1,1)+'px';
            })
        }, 10);
        function back(){
            var x=document.getElementsByClassName("setQ")[0];
            var y=document.getElementsByClassName("setQ")[1];
            x.style.opacity=0;
            x.style.zIndex=0;
            y.style.opacity=0;
            y.style.zIndex=0;
            window.location.href="main.php";
        }
    </script>
</body>
</html>