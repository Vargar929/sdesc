<style type="text/css">
    [class*=tracking-status-] p {
        margin:0;
        font-size:1.1rem;
        color:#fff;
        text-transform:uppercase;
        text-align:center
    }
    .tracking-item {
        border-left:1px solid #e5e5e5;
        position:relative;
        padding:.5rem 1.5rem .5rem 2.5rem;
        font-size:.9rem;
        margin-left:3rem;
        /*min-height:3.5rem*/
    }
    .tracking-item:last-child {
        padding-bottom:4rem
    }
    .tracking-item .tracking-date {
        margin-bottom:.5rem
    }
    .tracking-item .tracking-date span {
        color:#888;
        font-size:85%;
        padding-left:.4rem
    }
    .tracking-item .tracking-content {
        padding:.5rem .8rem;

        border-radius:.5rem
    }
    .tracking-item .tracking-content span {
        display:block;
        color:#888;
        background-color:#f4f4f4;
        font-size:90%
    }
    .tracking-item .tracking-icon {
        line-height:2.6rem;
        position:absolute;
        left:-1.3rem;
        width:2.6rem;
        height:2.6rem;
        text-align:center;
        border-radius:100%;
        font-size:1.2rem;
        background-color:#fff;
        color:#fff
    }
    @media(min-width:992px) {
        .tracking-item {
            margin-left:10rem
        }
        .tracking-item .tracking-date {
            position:absolute;
            left:-10rem;
            width:7.5rem;
            text-align:right
        }
        .tracking-item .tracking-date span {
            display:block
        }
        .tracking-item .tracking-content {
            padding:0;
            background-color:transparent
        }
    }
    .widget .card-body { padding:0px; }
    .widget .list-group { margin-bottom: 0; }
    .widget .card-title { display:inline }
    .widget .label-info { float: right; }
    .widget li.list-group-item {border-radius: 0;border: 0;border-top: 1px solid #ddd;}
    .widget li.list-group-item:hover { background-color: rgba(86,61,124,.1); }
    .widget .mic-info { color: #666666;font-size: 11px; }
    .widget .action { margin-top:5px; }
    .widget .comment-text { font-size: 18px; }
    .widget .btn-block { border-top-left-radius:0px;border-top-right-radius:0px; }
</style>
<div class="row">
    <div class="col-md-7 col-lg-7">
        <div class="card">
            <div class="card-header">
                <span class="badge badge-info"><i class="fa fa-bell fa-info"></i></span> <?php echo $title.': ';?><b>№<?php
                    echo $vars['data']['ti_id'];?></b>
            </div>
            <div class="card-body">
                <?php echo'<form action="/ticket/edit/'.$vars['data']['ti_id'].'" method="post">';?>
                    <div class="row">
                        <div class="col-8 h4">
                            <?php
                            if ($vars['data']['priority']=='1') {
                                echo '<input type="text" class="form-control border border-danger rounded bg-light" id="text" name="ticketTitle"  value="'.$vars['data']['title'].'" disabled>';
                            }elseif ($vars['data']['priority']=='2') {
                                echo  '<input type="text" class="form-control border border-danger rounded bg-light" id="text" name="ticketTitle"   value="'.$vars['data']['title'].'" disabled>';
                            }elseif ($vars['data']['priority']=='3') {
                                echo  '<input type="text" class="form-control border border-warning rounded bg-light" id="text" name="ticketTitle"   value="'.$vars['data']['title'].'" disabled>';
                            }elseif ($vars['data']['priority']=='4') {
                                echo '<input type="text" class="form-control border border-info rounded bg-light" id="text" name="ticketTitle"   value="'.$vars['data']['title'].'" disabled>';
                            }else{
                                echo  '<input type="text" class="form-control border border-secondary rounded bg-light" id="text" name="ticketTitle"   value="'.$vars['data']['title'].'" disabled>';
                            }
                            ?>
                        </div>
                        <div class="col-4  text-right">
                            <span class="border  border-secondary rounded text-white bg-secondary">Статус:
                            <?php
                            if ($vars['data']['status']=='1') {
                                echo '<i class="bg bg-danger text-white"> Открыта  ';
                            }elseif ($vars['data']['status']=='2') {
                                echo '<i class="bg bg-warning text-white"> В обработке';
                            }elseif ($vars['data']['status']=='3') {
                                echo '<i class="bg bg-info text-white"> Переадресована';
                            }else{
                                echo '<i class="bg bg-success text-white"> Закрыта ';
                            }
                            echo ' </i>';
                            ?>
                        </span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                                <label for="TicketDesc"> <span class="badge badge-danger">*</span> Описание проблемы</label>
                                <textarea class="form-control border  border-secondary rounded" id="TicketDesc" name="TicketDesc" rows="4" required oninput="getCount()" aria-describedby="TicketDescHelpBlock" ><?php echo $vars['data']['text'];?></textarea>
                                <small id="TicketDescHelpBlock" class="form-text text-muted ">
                                    Количество оставшихся символов: <span class="badge badge-success inform-text" id="count"></span>
                                </small>
                            </br>
                        </div>
                    </div>
                <div id="forms" class="row comment-text">
                    <div class="col-4">
                        <hr>
                    </div>
                    <div class="col-4">
                        <button type="submit" id="submit-ticket" class="btn btn-success">Сохранить изменения</button>
                    </div>
                    <div class="col-4">
                        <hr>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <br>
    </div>
    <div class="col-md-5 col-lg-5">
        <div class="card">
            <div class="card-header">
                <span class="badge badge-info"><i class="fa fa-bell fa-info"></i></span> TimeLine заявки
            </div>
            <div class="card-body">
                <?php
                foreach ($vars['time_line'] as $value) {
                    echo '<div class="tracking-item">';
                    if ($value['event_id']=='1'){
                        echo '<div class="tracking-icon bg bg-danger">';
                        echo '<i class="fas fa-plus"></i>
							</div>';
                    }elseif ($value['event_id']=='2'){
                        echo '<div class="tracking-icon bg bg-warning">';
                        echo '<i class="fas fa-hat-cowboy"></i>
							</div>';
                    }elseif ($value['event_id']=='3'){
                        echo '<div class="tracking-icon bg bg-info">';
                        echo '<i class="fas fa-comments"></i>
							</div>';
                    }elseif ($value['event_id']=='4'){
                        echo '<div class="tracking-icon bg bg-secondary">';
                        echo '<i class="fas fa-directions"></i>
							</div>';
                    }elseif ($value['event_id']=='5'){
                        echo '<div class="tracking-icon bg bg-success">';
                        echo '<i class="fas fa-check-circle"></i>
							</div>';
                    }elseif ($value['event_id']=='6'){
                        echo '<div class="tracking-icon bg bg-danger">';
                        echo '<i class="fas fa-redo-alt"></i>
							</div>';
                    }elseif ($value['event_id']=='7'){
                        echo '<div class="tracking-icon bg bg-info">';
                        echo '<i class="fas fa-edit"></i>
							</div>';
                    }else{
                        echo '<div class="tracking-icon bg bg-dark">';
                        echo '<i class="fas fa-comment-slash"></i>
							</div>';
                    }

                    echo '<div class="tracking-date">'.$value["date"].'</div>';
                    echo '<div class="tracking-content"><b><a href="/user/'.$value['user_id'].'">'.$value["f_name"].'  '.$value["l_name"].'</a> </b><span>'.$value["event"].'</span></div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#forms").on('click', "button", function (event) {
        console.log('click');
        setTimeout(
            function() {
                window.location.reload();
            }, 1000);
    });
</script>
<script src="/public/js/form.js"></script>
<?php //var_dump($data);


