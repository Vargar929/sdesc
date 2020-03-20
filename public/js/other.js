function ticket_count(){
    let host = window.location.hostname;
    let ticket_data = '/api/v1/get_all_ticket';
    $.ajax({
        type: "GET",
        url: ticket_data,
        data: "id=1&status=1",
        success: function(msg){
            document.getElementById('open').innerText= msg;
            // console.log( "Status 1 Data Saved: " + msg );
        }
    });
    $.ajax({
        type: "GET",
        url: ticket_data,
        data: "id=1&status=2",
        success: function(msg){
            document.getElementById('proces').innerText= msg ;
        }
    });
    $.ajax({
        type: "GET",
        url: ticket_data,
        data: "id=1&status=3",
        success: function(msg){
            document.getElementById('reject').innerText= msg ;
        }
    });
    $.ajax({
        type: "GET",
        url: ticket_data,
        data: "id=1&status=4",
        success: function(msg){
            document.getElementById('closed').innerText= msg ;
        }
    });
    $.ajax({
        type: "GET",
        url: ticket_data,
        data: "id=1&status=",
        success: function(msg){
            document.getElementById('all').innerText= msg ;
        }
    });

}
