<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="image-container">
                                <img id="imgProfile" src="<?=RenderUserAvatar($_SESSION['account']['f_name'],$_SESSION['account']['l_name']);?> " style="width: 150px; height: 150px" class="img-thumbnail" />
                            </div>
                            <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);"> </a></h2>
                                <h6 class="d-block"> "АО"НК"КТЖ" - "<a href="javascript:void(0)"><?=$_SESSION['account']['region']?></a>"</h6>
                                <h6 class="d-block"><a href="javascript:void(0)"> </a></h6>
                                <h6 class="d-block"><a href="javascript:void(0)"> </a></h6>
                            </div>
                            <div class="col-4 text-right">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);"> </a></h2>
                            </div>
                            <div class="ml-auto">
                                <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Основная информация</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Персональные сведения</a>
                                </li>
                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Ф. И. О.</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?=$_SESSION['account']['l_name'].'   '.$_SESSION['account']['f_name'].'   '.$_SESSION['account']['m_name']?>
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">E-Mail</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <a href="mailto:<?=$_SESSION['account']['email']?>"><?=$_SESSION['account']['email']?></a>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Телефон</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?=$_SESSION['account']['mobile_phone']?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Должность</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?=$_SESSION['account']['company_post']?>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                                <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Табельный</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?=$_SESSION['account']['tab_num']?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">ИИН</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?=$_SESSION['account']['inn']?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">IP адрес входа</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?=$_SESSION['account']['INET_NTOA(ip)']?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Дата последней смены пароля</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?=$_SESSION['account']['date_password']?>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
