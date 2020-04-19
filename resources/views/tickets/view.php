<style type="text/css">
    [class*=tracking-status-] p{
        margin:0;
        font-size:1.1rem;
        color:#fff;
        text-transform:uppercase;
        text-align:center }

    .tracking-item{
        border-left:1px solid #e5e5e5;
        position:relative;
        padding:.5rem 1.5rem .5rem 2.5rem;
        font-size:.9rem;
        margin-left:3rem;
        /*min-height:3.5rem*/ }

    .tracking-item:last-child{
        padding-bottom:4rem }

    .tracking-item .tracking-date{
        margin-bottom:.5rem }

    .tracking-item .tracking-date span{
        color:#888;
        font-size:85%;
        padding-left:.4rem }

    .tracking-item .tracking-content{
        padding:.5rem .8rem;
        border-radius:.5rem }

    .tracking-item .tracking-content span{
        display:block;
        color:#888;
        background-color:#f4f4f4;
        font-size:90% }

    .tracking-item .tracking-icon{
        line-height:2.6rem;
        position:absolute;
        left:-1.3rem;
        width:2.6rem;
        height:2.6rem;
        text-align:center;
        border-radius:100%;
        font-size:1.2rem;
        background-color:#fff;
        color:#fff }

    @media(min-width:992px){
        .tracking-item{
            margin-left:10rem }

        .tracking-item .tracking-date{
            position:absolute;
            left:-10rem;
            width:7.5rem;
            text-align:right }

        .tracking-item .tracking-date span{
            display:block }

        .tracking-item .tracking-content{
            padding:0;
            background-color:transparent }

    }

    .widget .card-body{
        padding:0px;
    }

    .widget .list-group{
        margin-bottom: 0;
    }

    .widget .card-title{
        display:inline }

    .widget .label-info{
        float: right;
    }

    .widget li.list-group-item{
        border-radius: 0;
        border: 0;
        border-top: 1px solid #ddd;
    }

    .widget li.list-group-item:hover{
        background-color: rgba(86,61,124,.1);
    }

    .widget .mic-info{
        color: #666666;
        font-size: 11px;
    }

    .widget .action{
        margin-top:5px;
    }

    .widget .comment-text{
        font-size: 18px;
    }

    .widget .btn-block{
        border-top-left-radius:0px;
        border-top-right-radius:0px;
    }

    .search{
        position:relative;
    }

    .search_result{
        background: #FFF;
        border: 1px #ccc solid;
        /*width: 177px;
        */ border-radius: 4px;
        max-height:100px;
        overflow-y:scroll;
        display:none;
    }

    .search_result li{
        list-style: none;
        padding: 5px 10px;
        margin: 0 0 0 -40px;
        color: #0896D3;
        border-bottom: 1px #ccc solid;
        cursor: pointer;
        transition:0.3s;
    }

    .search_result li:hover{
        background: #F9FF00;
    }
</style>
<div class="row">
	<div class="col-md-7 col-lg-7">
		<div class="card">
			<div class="card-header row">
                <div class="col-md-9">
				<span class="badge badge-info"><i class="fa fa-bell fa-info"></i></span> Просмотр заявки <b>№<?php use YoHang88\LetterAvatar\LetterAvatar;

						echo $vars['data']['ti_id'];?></b>
                </div>
                <?php if($vars['data']['owner_id']==$_SESSION['account']['id'] or $_SESSION['account']['role']=='5'){
                    if ($vars['data']['status']=='2' or $vars['data']['status']=='4'){
                        echo '<div class="col-md-3 invisible" >
						<form action="/ticket/event/'.$vars['data']['ti_id'].'" method="POST" class="text-center">
							<input type="hidden" name="status" value="redirect">
							<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal">Переадресовать</button>
						</form>
						</div>';}else{
	                    echo '<div class="col-md-3">
						<form action="/ticket/event/'.$vars['data']['ti_id'].'" method="POST" class="text-center hidden">
							<input type="hidden" name="status" value="redirect">
							<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal">Переадресовать</button>
						</form>
						</div>';
                    }}?>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-8">
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
                            <textarea disabled class="form-control border  border-secondary rounded" id="TicketDesc" name="TicketDesc" rows="4" required oninput="getCount()" aria-describedby="TicketDescHelpBlock" ><?php echo $vars['data']['text'];?></textarea>
                            </br>
                        </div>
				</div>

				<div id="forms" class="row">
                    <?php if ($_SESSION['account']['role']=='5' and $data['owner_id']==$_SESSION['account']['id'] and $data['status']=='1' or  $data['status']=='3' ){
                    echo '
						<div class="col-md-3">
						<form action="/ticket/event/'.$vars['data']['ti_id'].'" method="POST" class="text-center">
							<input type="hidden" name="status" value="close">
							<button type="submit"  class="btn btn-success btn-sm" value="close">Исполнить</button>
						</form>
						</div>';

                    }
                    if ($data['status']==4 and $_SESSION['account']['id']==$data['user_id']){
                        echo '<div class="col-md-3">
						<form action="/ticket/event/'.$vars['data']['ti_id'].'" method="POST" class="text-center">
							<input type="hidden" name="status" value="reopen">
							<button type="submit"  class="btn btn-danger btn-sm" value="reopen">Переоткрыть</button>
						</form>
						</div>';
                    }?>

						<div class="col-md-3 invisible">
						<form action="/ticket/event/<?php echo $vars['data']['ti_id'];?>" method="POST" class="text-center">
							<input type="hidden" name="status" value="close_success">
							<button type="submit"  class="btn btn-success btn-sm" value="close_success">Подвердить</button>
						</form>
						</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
		<div class="col-md-12 col-lg-12">
			<div id="accordion" role="tablist" aria-multiselectable="true">
			<div class="card widget">
				<div class="card-header">
					<i class="fa fa-comments"></i><b> <?php echo $count['count(comm_id)'];?></b>
						<button class="btn  collapsed" data-toggle="collapse" data-target="#collapseComments" aria-expanded="false" aria-controls="collapseComments">
						 Комментарии к заявке
						</button>
				</div>
				<div id="collapseComments" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
				<div class="card-body">
                    <div class="col-md-12 col-lg-12">
					<form id="comments" action="/ticket/view/<?php echo $vars['data']['ti_id'];?>" method="post">
						<div class="form-group">
							<label for="comment">Ваш комменарий</label>
							<textarea name="text" class="form-control" rows="3"></textarea>
						</div>
						<div class="text-center">
							<button type="submit" id="submit-button" class="btn btn-primary">Отправить комментарий</button>
						</div>
					</form>
                    </div>
					<br>
					<ul class="list-group">
						<?php
							foreach ($comments as $value){
							echo '<li class="list-group-item">
							<div class="row">
									<div class="col-md-2 text-center">';
									$avatar = new LetterAvatar( $value["f_name"].' '.$value["l_name"], 'circle', 80);
									echo '<img src="'.$avatar.'" alt="">
									</div>';
									echo '<div class="col-md-10 ">
										<div class="col-md-12 ">
										<div>
											<div class="mic-info">';
									echo 'By: <a href="/user/'.$value["user_id"].'">'.$value["f_name"].'  '.$value["l_name"].'</a> on '.$value["comm_date"];
									echo '</div>
										</div>
										<div class="comment-text">';
											echo $value["comm_text"];
										echo '</div>';
									if ($_SESSION['account']['role']>='3' and $_SESSION['account']['role']<='5'){
										echo '<div class="action">';
 											echo'
                                			<a href="/ticket/commentDel/'.$value['comm_id'].'" class="btn  btn-outline-danger" title="Удалить"><span><i class="far fa-trash-alt"></i></span> </a></td>';
										echo '</div>';
									}
									echo '</div>
									</div>
							</div>
						</li>';
					}
						?>
					</ul>
					</div>
				</div>
			</div>
		</div>
		</div>
		</div>
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

<script src="/public/js/form.js"></script>
<script src="/public/js/search.js"></script>
<script type="text/javascript">
    $("#forms").on('click', "button", function (event) {
        console.log('click');
        setTimeout(
            function() {
                window.location.reload();
            }, 1000);
    });
    $("#comments").on('click', "button", function (event) {
        console.log('click');
        setTimeout(
            function() {
                window.location.reload();
            }, 500);
    });
</script>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text"  name="referal" placeholder="Живой поиск" value="" class="who form-control"  autocomplete="off">
	            
                <ul class="search_result"></ul>
            </div>
            <div class="modal-footer">
                <div id="forms" >
	            <form action="/ticket/event/<?php echo $vars['data']['ti_id']?>" method="POST" class="text-center">
		            <input type="hidden" name="status" value="redirect">
		            <input type="hidden" name="reject_id" id="reject_to" value="">
		            <button type="submit" class="btn btn-success">Переадресовать</button>
	            </form>
                </div>
            </div>
        </div>
    </div>
</div>


