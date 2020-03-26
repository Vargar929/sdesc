<div class="row">
    <div class="col-md-12">
        <div class="card-body">
            <div class="col-12">
                <form action method="get">
                    <div class="form-row">
                        <div class="col-2">
                            <button type="button" class="btn btn-primary" onclick="ticket_data()">Найти</button>
                        </div>
                    </div>
                </form>
            </div>
</div>
<script type="text/javascript">
   function ticket_data(){
    let ticket_data = '/api/v1/get_all_ticket_data';
    $.ajax({
        type: "GET",
        url: ticket_data,
        data: "system_role=1&user_id=1&status=1",
        dataType:"json",
        success: function(msg){
            // document.getElementById('open').innerText= msg['COUNT(ti_id)'];
            console.log( "Status 1 Data Saved: " + msg );
        }
    });}

    //     var params = 'system_role=' + encodeURIComponent(role) +
    //         '&user_id=' + encodeURIComponent(user_id_r) +
    //         '&status=' + encodeURIComponent(status_r);
    //     var url = "/api/v1/get_all_ticket_data?"+params;
    // var ti_id = [];
    // var title = [];
    // var text = [];
    // var user_id = [];
    // var owner_id = [];
    // var priority = [];
    // var status = [];
    // var ti_date = [];
    // var ti_email = [];
    // var ti_phone = [];
    //
    //         const data = JSON.parse(json);
    //
    //         $('#example').append(
    //             `<tbody>${data.response.items.map(n =>
    //                 `<tr>
    //               <td>${n.title}</td>
    //               <td>${n.director}</td>
    //               <td>${n.year}</td>
    //               <td>${Object.values(n.photo).map(n => `<img src="${n}">`).join('')}</td>
    //             </tr>`).join('')}
    //           </tbody>`
    //                     );
        </script>