<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Room Reservations</title>
  <style>
    table { width: 100%; border-collapse: collapse; text-align: center; }
    th, td { border: 1px solid #ccc; padding: 8px; }
    thead { background: #f5c518; color: black; }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Room Reservations</h2>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Room</th>
      <th>Price (€)</th>
      <th>User</th>
      <th>Check-In</th>
      <th>Check-Out</th>
    </tr>
  </thead>
  <tbody id="reservations"></tbody>
</table>

<script>
$(document).ready(function(){
    function loadReservations(){
        $.ajax({
            url: 'pages/API_get_room_reservations.php',
            method: 'GET',
            dataType: 'json',
            success: function(data){
                if(data.length === 0){
                    $('#reservations').html('<tr><td colspan="6">No reservations found</td></tr>');
                    return;
                }
                let rows = '';
                $.each(data, function(i, row){
                    rows += `<tr>
                        <td>${row.booking_id}</td>
                        <td>${row.room_name}</td>
                        <td>${row.total_price}</td>
                        <td>${row.firstname} ${row.lastname} (${row.username})</td>
                        <td>${row.check_in_time}</td>
                        <td>${row.check_out_time}</td>
                    </tr>`;
                });
                $('#reservations').html(rows);
            },
            error: function(){
                $('#reservations').html('<tr><td colspan="6" style="color:red;">Failed to load reservations</td></tr>');
            }
        });
    }
    loadReservations();
});
</script>

</body>
</html>
