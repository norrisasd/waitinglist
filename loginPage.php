<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maui Snorkeling</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
    <style>
        body{
            background: url(http://mymaplist.com/img/parallax/back.png);
            background-color: #444;
            background: url(http://mymaplist.com/img/parallax/pinlayer2.png),url(http://mymaplist.com/img/parallax/pinlayer1.png),url(http://mymaplist.com/img/parallax/back.png);    
        }

        .vertical-offset-100{
            padding-top:100px;
        }
    
    </style>
</head>
<body>
    <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please sign in</h3>
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form" action="" method="post" onsubmit="return setLogin();">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" id="username" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" id="password" type="password" value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                </label>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Login" name="login">
                        </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function setLogin(){
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
          $.ajax({
            type: 'post',
            url: './php/login.php',
            data:{
              username:username,
              password:password,
            },
            success:function(response){
              
              if(response == ''){
                  window.location.href="index.php";
              }else{
                  alert(response);
              }
            }
          });
          return false;
    }
    $(document).ready(function(){
    $(document).mousemove(function(e){
        TweenLite.to($('body'), 
            .5, 
            { css: 
                {
                    backgroundPosition: ""+ parseInt(event.pageX/8) + "px "+parseInt(event.pageY/'12')+"px, "+parseInt(event.pageX/'15')+"px "+parseInt(event.pageY/'15')+"px, "+parseInt(event.pageX/'30')+"px "+parseInt(event.pageY/'30')+"px"
                }
            });
    });
    });

</script>


</html>