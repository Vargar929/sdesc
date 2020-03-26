<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                    <span class="badge  badge-success"><i class="fas fa-chart-line"></i>
                        </span> Ваши прогресс заявок</div>
            <div class="card-body" id="ticketCount">
                <button class="btn btn-success"  data-toggle="modal" data-target="#ticketNewQuery" >Создать заявку</button>
            </div>
        </div>
    </div>
    <div class="col-sm-4  ">
        <div class="card">
            <div class="card-header">
                    <span class="badge  badge-success"><i class="fa fa-clock fa-fw"></i>
                        </span> Ваши запросы за сегодня
            </div>
            <div class="card-body" id="ticketCount">
                <div class="col-md-0" <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Открытых
                        <span id="open" class="badge badge-danger badge-pill">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        В обработке
                        <span  id="proces"  class="badge badge-warning badge-pill">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Переадресованных
                        <span id="reject" class="badge badge-primary badge-pill">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Закрытых
                        <span id="closed" class="badge badge-secondary badge-pill">0</span>
                    </li>
                    <li  class="list-group-item d-flex justify-content-between align-items-center">
                        <b>Всего запросов:</b>
                        <span id="all" class="badge badge-info badge-pill"><b>0</b><span></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.onload = function() {
        setInterval(ticket_count, 30000);
    }


</script>

<!-- Logout Modal-->
<div class="modal fade  bd-example-modal-lg" id="ticketNewQuery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <span class="badge badge-danger"><i class="fa fa-bell fa-fw"></i></span> Запрос в службу поддержки</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form >
<!--                <form id="myForm1">-->
                    <div class="form-row">
                        <div class="form-group col-md-6 ">
                            <label for="userEmail">Email</label>
                            <input type="email" READONLY class="form-control" name="email" readonly id="userEmail" placeholder="Email" aria-describedby="EmailHelpBlock" value="<?php echo $_SESSION['account']['email'] ?>">
                            <small id="EmailHelpBlock" class="form-text text-muted ">
                                Ваш емайл.
                            </small>
                        </div>
                        <div class="form-group col-md-6">

                            <label for="UserPhone">Телефон для связи:</label>
                            <input type="text" class="form-control" name="UserPhone" id="UserPhone" aria-describedby="UserPhoneHelpBlock" placeholder="Телефон для связи" value="">
                            <small id="UserPhoneHelpBlock" class="form-text text-muted text-right">
                                Ваш рабочий телефон.
                            </small>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-8">
                            <label for="ticketTitle"><span class="badge badge-danger">*</span> Тема</label>
                            <input type="text" class="form-control" id="ticketTitle" placeholder="Тема" required name="ticketTitle">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="ticketPriority">Приоритет</label>
                            <select class="form-control" id="ticketPriority" name="ticketPriority">
                                <option value="1">Блокирующий </option>
                                <option value="2">Критический </option>
                                <option selected value="3">Высокий </option>
                                <option value="4">Средний </option>
                                <option value="5">Низкий </option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="TicketDesc"> <span class="badge badge-danger">*</span> Описание проблемы</label>
                            <textarea class="form-control" id="TicketDesc" name="TicketDesc" rows="4" required oninput="getCount()" aria-describedby="TicketDescHelpBlock"></textarea>
                            <small id="TicketDescHelpBlock" class="form-text text-muted ">
                                Количество оставшихся символов: <span class="badge badge-success inform-text" id="count"></span>
                            </small>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        Поля отмеченные <span class="badge badge-danger">*</span> обязательны к заполнению
                    </div>
               </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Отмена</button>
                <button type="button" id="submit-button" onclick="submit_data()"  class="btn btn-primary">Отправить запрос</button>
            </div>
            <script type="text/javascript">
                function submit_data() {
                    let url = '/api/v1/put_new_ticket';
                    let userEmail = $("#userEmail").val();
                    let UserPhone = $("#UserPhone").val();
                    let ticketTitle = $("#ticketTitle").val();
                    let ticketPriority = $("#ticketPriority").val();
                    let TicketDesc = $("#TicketDesc").val();
                    if (ticketTitle!=="" || TicketDesc !== ""){
                        let formData = {
                            "email":userEmail,
                            "UserPhone":UserPhone,
                            "ticketTitle":ticketTitle,
                            "ticketPriority":ticketPriority,
                            "TicketDesc":TicketDesc,
                        };
                        console.log(formData);
                        console.log(url);
                        //
                        $.ajax({
                            url:url,
                            type:'POST',
                            data:'jsonData=' + JSON.stringify(formData),
                            success: function(res) {
                                $.notify({
                                        title: '<b> Внимание!</b> ',
                                        message: 'Вы создали задачу под номером: <b>'+ res +'</b>',
                                    },
                                    {
                                        type: 'info',
                                        element: 'body',
                                        allow_dismiss: true,
                                        placement: {
                                            from: "top",
                                            align: "right"
                                        },
                                        offset: 20,
                                        spacing: 10,
                                        z_index: 1000,
                                        delay: 10000,
                                        timer: 1000,
                                        animate: {
                                            enter: 'animated zoomInDown',
                                            exit: 'animated zoomOutUp'
                                        },
                                        icon_type: 'class',
                                    });
                                console.log(res);
                            }
                        });
                    }else{
                        $.notify({
                                title: '<b> Внимание!</b> ',
                                message: 'Пустые значения!',
                            },
                            {
                                type: 'info',
                                element: 'body',
                                allow_dismiss: true,
                                placement: {
                                    from: "top",
                                    align: "right"
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1000,
                                delay: 10000,
                                timer: 1000,
                                animate: {
                                    enter: 'animated zoomInDown',
                                    exit: 'animated zoomOutUp'
                                },
                                icon_type: 'class',
                            });
                    }

                    return false;
                }
                let maxCount = 244;
                let redCount = 0    ;
                $("#count").text(maxCount);
                function getCount() {
                    var count = maxCount - $("#TicketDesc").val().length;
                    $("#count").text(Math.abs(count));
                    if (count <= redCount) {
                        $(".inform-text").removeClass("badge-success");
                        $(".inform-text").addClass("badge-danger");
                        $.notify({
                                // title: json.status ,
                                message: 'Внимание вы превысили допустимую длинну текста в <b>'+ maxCount +' символа </b> на <b>'+ Math.abs(count)+' символов</b>',
                            },
                            {
                                type: 'danger',
                                element: 'body',
                                allow_dismiss: true,
                                placement: {
                                    from: "top",
                                    align: "right"
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1000,
                                delay: 10000,
                                timer: 1000,
                                animate: {
                                    enter: 'animated zoomInDown',
                                    exit: 'animated zoomOutUp'
                                },
                                icon_type: 'class',
                            });

                    }
                    else if (count > 0 && $(".inform-text").hasClass("badge-danger")) {
                        $(".inform-text").removeClass("badge-danger");
                        $(".inform-text").addClass("badge-success");
                        $("#submit-button").removeClass("disabled");
                    }
                    if (count <= 0) { $("#submit-button").addClass("disabled");
                        $("#submit-button").text("Недоступно");
                    } else if (count > 0 &&  $("#submit-button").hasClass("disabled")) {
                        $("#submit-button").removeClass("disabled");
                        $("#submit-button").text("Отправить");
                    }
                }
            </script>
            </form>
        </div>
    </div>
</div>

