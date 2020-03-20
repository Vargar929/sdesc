
<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                    <span class="badge  badge-success"><i class="fas fa-chart-line"></i>
                        </span> Ваши прогресс заявок</div>
            <div class="card-body" id="ticketCount">
                <button class="btn btn-success" onclick="window.location = 'ticket/add'">Создать заявку</button>
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

<div class="row invisible">
    <div class="col-sm-12">
        <br>
    </div>
</div>
<div class="row invisible">
    <div class="col-sm-12">
        <br>
    </div>
</div>

<script type="text/javascript">

   // setInterval(ticket_count, 1000);
</script>

