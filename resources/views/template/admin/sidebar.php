<body id="page-top">
<?php

use App\Models\AdminModel;

$set_arr = AdminModel::getSysSet();
foreach ($set_arr as $row){
    $system_name = $row['system_name'];
    $system_version = $row['system_version'];
}
 ?>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-white sidebar sidebar-light accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon rotate-n-15">
                <img src="//<?= HLEB_MAIN_DOMAIN;?>/images/ktzh_logo.jpg" alt="..." class="img-circle" width="32px" height="32px">
            </div>
            <div class="sidebar-brand-text mx-3"><?=$system_name?><sup class="text-danger"> <i><?= $system_version ?></i></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Админка</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/users">
                <i class="fas fa-fw fa-user-alt"></i>
                <span>Управление пользователями</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/systemsettings">
                <i class="fas fa-fw fa-cog"></i>
                <span>Настройка системы</span></a>
        </li>
        <!-- Nav Item - Users -->
        <li class="nav-item" hidden >
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
                <i class="fas fa-fw fa-table"></i>
                <span>Управление пользователями</span></a>
            <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Управление пользователями</h6>
                    <a class="collapse-item" href="/admin/userAdd">Создать пользователя</a>
                    <a class="collapse-item" href="/admin/userEdit">Изменить пользователя</a>
                    <a class="collapse-item" href="/admin/userView">Просмотреть пользователя</a>
                    <a class="collapse-item" href="/admin/userBan">Заблокировать пользователя</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
