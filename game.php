<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>遊戲</title>
</head>
<body>
    <div class="QNA">
        <p id="level"></p>
        <p id="Q"></p>
        <form action=<?php echo basename(__FILE__);?> method="post">
            <input type="input" name="A" id="A"></input>
        </form>
    </div>
    <?php
        if(isset($_POST["A"])){
            
        }
    ?>
</body>
</html>
<style>
    .QNA #A{
        position: absolute;
        background-color: rgba(200,200,200,0.7);
        border:3px solid black;
        border-radius: 5px;
        height:30px;
        top:80%;
        left:50%;
        transform: translate(-50%,-80%);
        font-size: large;
    }
</style>