<?php $avtar_img = RenderUserAvatar($_SESSION['account']['f_name'],$_SESSION['account']['l_name']);?>
<body>
<div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="//<?= HLEB_MAIN_DOMAIN;?>/"><?=SYSTEM_NAME?></a>
                <div id="close-sidebar">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <div class="sidebar-header"><a href="/profile">
                <div class="user-pic">
                    <img class="img-responsive img-rounded" src="<?=$avtar_img;?>"
                         alt="User picture">
                </div>
                <div class="user-info">
          <span class="user-name">
              <?=$_SESSION['account']['f_name'];?>
            <strong>
                <?=$_SESSION['account']['l_name'];?>
            </strong>
          </span>
                    <span class="user-role">Administrator</span>
                    <span class="user-status ">
                        <i class="fa fa-globe"></i>
                        <span class="text-white">Online</span>
                    </span>
                </div>
                </a>
            </div>
            <!-- sidebar-header  -->
            <div class="sidebar-menu">
                <ul>
                    <li class="header-menu">
                        <span>General</span>
                    </li>
                    <li >
                        <a class="nav-link" href="/">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Рабочая область</span></a>
                    </li>
                    <li>
                        <a class="nav-link" href="/ticket">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Заявки</span></a>
                    </li>

                    <li>
                        <a class="nav-link" href="/admin">
                            <i class="fas fa-fw fa-clipboard-list"></i>
                            <span>Панель Администратора</span></a>
                    </li>
                    <li class="header-menu">
                        <span>Extra</span>
                    </li>
                    <li>
                        <a href="#" class="disabled">
                            <i class="fa fa-book"></i>
                            <span>Documentation</span>
                            <span class="badge badge-pill badge-primary">&#946eta</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tasks">
                            <i class="fas fa-fw fa-calendar"></i>
                            <span>Менеджер задач</span></a>
                    </li>
                </ul>
            </div>

                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-light">
                                <span>&copy
                                    <?php
                                    $fromYear = 2019;
                                    $thisYear = (int)date('Y');
                                    echo $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : '');
                                    ?>
                                     <a href="https://github.com/RycovDenis" class="badge badge-light badge-pill"> <i class="fab fa-github"></i> Denis Rykov</a>
                                  <br>Все права защищены.
                                     <br>Лицензировано <a href="/license" class="badge badge-light badge-pill">  <i class="fas fa-balance-scale"></i>MIT</a>
                        </span>
                    </div>
                </div>
            <!-- sidebar-menu  -->
        </div>
        <!-- sidebar-content  -->
        <div class="sidebar-footer">
            <a href="/tickets">
                <span class="badge badge-light  text-warning"><i class="fa fa-bell"></i>
                <span class="badge badge-pill badge-warning notification"  id="notify">3</span></span>
            </a>
            <a href="/messages">
                <span class="badge badge-light text-success"><i class="fa fa-envelope"></i>
                <span class="badge badge-pill badge-success notification">7</span></span>
            </a>
            <a href="/settings">
                 <span class="badge badge-light text-info"><i class="fa fa-cog"></i>
                     <span class="badge-sonar"></span></span>
            </a>
            <a href="#" data-toggle="modal" data-target="#logoutModal" >
               <span class="badge badge-light text-danger"><i class="fa fa-power-off"></i></span>
            </a>
        </div>
    </nav>
    <!-- sidebar-wrapper  -->
    <main class="page-content">
        <div class="container-fluid">
            <script type="text/javascript">
                function notify() {
                    let ticket_data = '/api/v1/get_all_ticket';
                    $.ajax({
                        type: "GET",
                        url: ticket_data,
                        data: "id=1&status=1",
                        success: function(msg){
                            if (msg === 0) {
                                document.getElementById('notify').setAttribute("hidden","hidden");
                            }else {
                                document.getElementById('notify').innerText = msg;
                            }
                        }
                    });
                }
                setInterval(notify, 10000);
            </script>
