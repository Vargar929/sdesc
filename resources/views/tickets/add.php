<div class="row">
<div class="col-sm-8 " id="ticketNewQuery">
         <div class="card">
             <div class="card-header">
                 <span class="badge badge-danger"><i class="fa fa-bell fa-fw"></i></span> Запрос в службу поддержки
             </div>
             <div class="card-body">
                 <form action="/ticket/add" method="post">
                     <div class="form-row">
                         <div class="form-group col-md-6 ">
                             <label for="userEmail">Email</label>
                             <input type="email" class="form-control" name="email" id="userEmail" placeholder="Email" aria-describedby="EmailHelpBlock" value="<?php echo $_SESSION['account']['email'] ?>">
                             <small id="EmailHelpBlock" class="form-text text-muted ">
                                 Ваш емайл.
                             </small>
                         </div>
                         <div class="form-group col-md-6">

                             <label for="UserPhone">Телефон для связи:</label>
                             <input type="text" class="form-control" name="UserPhone" id="UserPhone" aria-describedby="UserPhoneHelpBlock" placeholder="Телефон для связи" value="<?php echo $_SESSION['account']['phone'] ?>">
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
                     <button type="submit" id="submit-button" class="btn btn-primary">Отправить запрос</button>

                 </form>
             </div>
         </div>
         <script type="text/javascript">
              window.onload = jQuery(function($){
                var element = document.getElementById('UserPhone');
                var maskOptions = {
             mask: '+{7}(000)000-00-00'
         };
         var mask = IMask(element, maskOptions);
     });
</script>
     </div>

</div>
<script src="/public/js/form.js"></script>
<script src="/public/js/imask.js"></script>






