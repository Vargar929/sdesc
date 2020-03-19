<style type="text/css">
    .login-container{
        margin-top: 10%;
        margin-bottom: 10%;
        margin-left: 10%;
    }
    .login-form{
        padding: 5%;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
    }
    .login-form h3{
        text-align: center;
        color: #333;
    }
    .login-container form{
        padding: 10%;
    }
    .btnSubmit
    {
        width: 50%;
        border-radius: 1rem;
        padding: 1.5%;
        border: none;
        cursor: pointer;
    }
    .login-form .btnSubmit{
        font-weight: 600;
        color: #fff;
        background-color: #0062cc;
    }
    #icon{
        width:328px ;
        height:60px ;
    }
    .password {
        margin: 15px auto;
        position: relative;
    }

    .password-control {
        position: absolute;
        top: 11px;
        right: 6px;
        display: inline-block;
        width: 20px;
        height: 20px;
        background: url(//<?= HLEB_MAIN_DOMAIN;  ?>/svg/view.svg) 0 0 no-repeat;
    }
    .password-control.view {
        background: url(//<?= HLEB_MAIN_DOMAIN;  ?>/svg/no-view.svg) 0 0 no-repeat;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6 text-center">
            <div class="login-container">
                <div class="login-form">
                    <div id="formContent">
                        <form action="/login" method="GET">
                            <div class="logo">
                                <img src="//<?= HLEB_MAIN_DOMAIN;  ?>/images/ktzh.png"   id="icon" alt="User Icon" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Ваш логин"  name="login" value="" />
                            </div>

                            <div class="form-group password">
                                <input type="password" id="password-input" class="form-control" placeholder="Введите пароль" name="password" value="" />
                                <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>

                            </div>
                            <div class="form-group">
                                <input type="submit" class="btnSubmit" value="Login" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</div>


<script>
    function show_hide_password(target){
        var input = document.getElementById('password-input');
        if (input.getAttribute('type') === 'password') {
            target.classList.add('view');
            input.setAttribute('type', 'text');
        } else {
            target.classList.remove('view');
            input.setAttribute('type', 'password');
        }
        return false;
    }
</script>