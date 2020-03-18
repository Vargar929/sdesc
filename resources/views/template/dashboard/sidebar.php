<?php
//use App\Models\AdminModel;
//$set_arr = AdminModel::getSysSet();
//foreach ($set_arr as $row){
//    $system_name = $row['system_name'];
//    $system_version = $row['system_version'];
//}
//?>
<!-- Page Wrapper-->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-white sidebar sidebar-light accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon rotate-n-15">
                <img src="//<?= HLEB_MAIN_DOMAIN;?>/images/ktzh_logo.jpg" alt="..." class="img-circle" width="32px" height="32px">
            </div>
            <div class="sidebar-brand-text mx-3"><?=SYSTEM_NAME?></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Рабочая область</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="/ticket">
                <i class="fas fa-fw fa-table"></i>
                <span>Заявки</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/admin">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Панель Администратора</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Nav Item - TaskManager -->
        <li class="nav-item">
            <a class="nav-link" href="/tasks">
                <i class="fas fa-fw fas fa-fw fa-calendar"></i>
                <span>Менеджер задач</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
