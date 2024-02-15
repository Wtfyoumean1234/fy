<style class="style">
    @keyframes move{
        from{
            transform: translateX(-500px);
            opacity: 0;
        }
        to{
            transform: translateX(-62.5px);
            opacity: 1;
        }
    }
    @keyframes hovered {
        from{
            font-size: large;
            width: 125px;
            height: 75px;
            background-color: rgba(200,200,200,0.7);
        }
        to{
            font-size: larger;
            width: 150px;
            height: 90px;
            background-color: rgb(200,20,20);
        }
    }
    @keyframes reversed{
        from{
            font-size: larger;
            width: 150px;
            height: 90px;
            background-color: rgb(200,20,20);
        }
        to{
            font-size: large;
            width: 125px;
            height: 75px;
            background-color: rgba(200,200,200,0.7);
        }
    }
    @keyframes imgmove{
        from{
            left:0%;
            opacity: 0;
        }
        to{
            left:50%;
            opacity: 1;
            transform: translateX(-50%);
        }
    }
    #timer{
        font-size: larger;
        position: fixed;
        right:10px;
        top:15px;
        background-color: rgba(200,200,200,0.7);
        border-radius: 5px;
        padding: 5px;
        
    }
    .button{
        font-size: large;
        position: relative;
        left:50%;
        margin-top: 200px;
        transform: translateX(-50%);
        margin-top: 200px;
        border:none;
        border-radius:5px ;
        width:125px;
        height: 75px;
        text-align: center;
        opacity: 0;
    }
    .button:hover{
        font-size: larger;
        animation:hovered 0.5s ease-out;
        background-color: rgb(200,20,20);
        width: 150px;
        height: 90px;
    }
    .start{
        animation: move 0.7s ease-out;
    }
    .after{
        animation: reversed 0.5s ease-in-out;
    }
    .img{
        position:absolute;
        top:0px;
        margin-top:50px;
        left: 50%;
        transform: translateX(-50%);
        width: 300px;
        opacity:0;
    }
    .imgmove{
        animation: imgmove 0.7s ease-out;
    }
    #login{
        align-content: center;
        width: 70px;
        height: 50px;
        right:50px;
        margin-right: 50px;
        bottom: 50px;
        margin-bottom: 50px;
        position: absolute;
        background-color: rgba(200,200,200,0.7);
        border: none;
        border-radius:5px;
        font-style: normal;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    #login:hover{
        border: 2px solid rgba(200,200,200,1);
    }
    #accou{
        display: grid;
        grid-template-columns: auto;
        grid-template-rows: auto;
        place-items: center;
        position: absolute;
        right:30px;
        top: 100px;
        width:100px;
        height:50px;
        background-color: rgba(200,200,200,0.7);
        border:none;
        border-radius: 5px;
    }
    #accou p{
        font-size: medium;
    }
    .setQ{
        position: absolute;
        top:0;
        left:0;
        background-color: gray;
        width:1500px;
        height: 900px;
    }
    #accou p,#accou,#login,.button,#timer{
        z-index:1;
    }
    .setQ{
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .setQ h2{
        left:50%;
        top:8%;
        position: absolute;
        transform: translateX(-50%);
    }
    .setQ #text{
        background-color: rgba(200,200,200,1);
        border-radius: 5px;
        border: none;
        margin-left: 10%;
        width: 100px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 25px;
    }
    .setQ #text:hover{
        background-color: rgba(200,200,200,0.7);
    }
</style>
<script>
    window.onload = function() {
        var image=document.getElementsByClassName("img")[0];
        image.classList.add("imgmove");
        image.addEventListener("animationend",function(){
            image.classList.remove("imgmove");
            image.style.opacity="1";
        });
        var buttons=document.querySelectorAll(".button");
        var x=-1;
        buttons.forEach(function(button){
            x+=1
            setTimeout(function(){
                button.classList.add("start");
                button.addEventListener("animationend",function(){
                    button.classList.remove("start");
                    button.style.opacity="1";
                },{once:true});
                button.addEventListener("mouseenter",function(){
                    button.classList.add("after");
                },{once:true});
            },500+x*100);
        });
        setTimeout(function(){
            document.getElementsByClassName("setQ")[0].style.zIndex=0
        },1500);
    }
    
</script>
