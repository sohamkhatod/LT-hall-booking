<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Centered Table</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <style> 
    body 
    {
      background-color: #e9effd;
      height: 100vh;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .header
    {
      position: absolute;
      top: 0;
      padding: 10px;
      /* height: 10vh; */
      width: 100%;
      background-color: #4f51fd;
      display: flex;
      justify-content: space-between;
    }

    .user-name
    {
      padding: 8px;
      font-size: 1vw;
      /* background-color: white; */
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .table-container {
      /* margin-right: auto;
      margin-left: auto; */
      /* background-color: white; */
      padding: 35px;
      border-radius: 10px;
      /* width: 80vw; */
      color: black;
      height: 50vh; /* added by arnav */
      overflow: auto; /* added by arnav */
    }
    .log-out {
      width: fit-content;
      min-width: 100px;
      font-size: 1vw;
      padding: 8px;
      border-radius: 10px;
      border: 2.5px solid #e9effd;
      box-shadow: 0px 0px 20px -20px;
      cursor: pointer;
      background-color: #494cf3;
      transition: all 0.2s ease-in-out 0ms;
      user-select: none;
      /* font-family: 'Poppins', sans-serif; */
      color: #e9effd;
      text-decoration: none;
    }

    .log-out:hover {
      background-color: #3f41d8;
      box-shadow: 0px 0px 20px -18px;
    }

    .log-out:active {
      transform: scale(0.95);
    }

    .create-holder
    {
      margin-top: 5vw;
      display: flex;
      justify-content: center;
    }

    .create {
      border: 2px solid #494cf3;
      background-color: #494cf3;
      border-radius: 0.9em;
      padding: 0.8em 1.2em 0.8em 1em;
      transition: all ease-in-out 0.2s;
      font-size: 16px;
    }

    .create span {
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      font-weight: 600;
    }

    .create:hover {
      background-color: #3f41d8;
    }

    .btn-view
    {
      padding: 8px;
      border-radius: 10px;
      padding: 10px;
      border: 0;
      background-color: #494cf3;
      transition: all 0.2s ease-in-out 0ms;
      color: #e9effd;
      text-decoration: none;
    }

    .btn-view:hover
    {
      background-color: #3f41d8;
      color: #e9effd;
      cursor: pointer;
    }

    a
    {
      text-decoration: none;
    }

    #table-view_wrapper
    {
      overflow-y: auto; /* added by arnav */
    }

  </style>
</head>
<body>


<!-- <div class="table-container">

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal" >Create new Request</button>
<br>
<br>  
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = 'color:black;'>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h5 class="modal-title" >New Request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-3">
              <label for="subject" class="col-form-label">Subject</label>
              <input type="text" class="form-control" id="subject">
            </div>
            <div class="mb-3">
              <label for="reason" class="col-form-label">Detailed Reason</label>
              <textarea class="form-control" id="reason"></textarea>
            </div>

            <div class="mb-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value='true' id="equipment">
                <label class="custom-control-label" for="equipment">Equipment Required</label>
                <input type="text" id="equipmentInput" class="form-control" style="display: none;" placeholder="Enter equipment details">
          
            </div>
            </div>

            <div class="mb-3">
            <div class="custom-control custom-checkbox">
                <label class="custom-control-label" >Size</label>
                <br>
                
                <input type="radio" class="custom-control-input" value='large' name ='size' id ='size_large'>
                <label for="size_large">large</label>
                <input type="radio" class="custom-control-input" value='small' name = 'size' id ='size_small'>
                <label for="size_small">small</label>
                
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
              <label for="datepicker" class="input-group-text">Date for LT</label>
              <input placeholder="Select date" type="date" id="datepicker" class="form-control">
              <span class="input-group-text"><i class="fas fa-calendar"></i></span>
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
              <label for="timepicker" class="input-group-text">Time</label>
              <input type="time" id="timepicker" class="form-control">
            </div>
            </div>

          <div >
           <label for="Duration">Duration</label>
           <input type="number" class="form-control" id="Duration" placeholder="1" value="1">
          
          </div>
            
        </div >
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="sumbit"  class="btn btn-primary">Send Request</button>
        </div>


        </form>
      </div>
    </div>
  </div>

  <table style = 'color:white;' class="table dark-theme" id = 'table-view'>
    <thead>
      <tr>
        <th>#</th>
        <th>Subject</th>
        <th>Requested Date</th>
        <th>Equipment</th>
        <th>Mentor Status</th>
        <th>System Administrator status</th>
        <th>Assigned LT</th>
      </tr>
    </thead>
  
  </table>
</div> -->


<div class="header">
    <div class="user-name">Hi {{Session::get('User')}}!</div>
      <a  id = 'btnlogout' href='../logout' style="text-decoration: none; text-align: center;">
        <div   class="log-out">
          Log Out
        </div>
      </a>
  </div>

<div class="table-container">
  <!-- <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = 'color:black;'>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h5 class="modal-title" id = "modal-title">New Request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id='displayForm'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="_requestId" />
            <div class="mb-3">
              <label for="subject" class="col-form-label">Subject</label>
              <input type="text" class="form-control" id="subject">
            </div>
            <div class="mb-3">
              <label for="reason" class="col-form-label">Detailed Reason</label>
              <textarea class="form-control" id="reason"></textarea>
            </div>

            <div class="mb-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value='true' id="equipment">
                <label class="custom-control-label" for="equipment">Equipment Required</label>
                <input type="text" id="equipmentInput" class="form-control" style="display: none;" placeholder="Enter equipment details">
          
            </div>
            </div>

            <div class="mb-3">
            <div class="custom-control custom-checkbox">
                <label class="custom-control-label" >Size</label>
                <br>
                
                <input type="radio" class="custom-control-input" value='large' name ='size' id ='size_large'>
                <label for="size_large">large</label>
                <input type="radio" class="custom-control-input" value='small' name = 'size' id ='size_small'>
                <label for="size_small">small</label>
                
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
              <label for="datepicker" class="input-group-text">Date for LT</label>
              <input placeholder="Select date" type="date" id="datepicker" class="form-control">
              <span class="input-group-text"><i class="fas fa-calendar"></i></span>
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
              <label for="timepicker" class="input-group-text">Time</label>
              <input type="time" id="timepicker" class="form-control" min="10:00" max="23:00">
            </div>
            </div>


            <div class="mb-3">
            <div class="input-group">
              <label for="timepicker2" class="input-group-text">End Time</label>
              <input type="time" id="timepicker2" class="form-control" min="10:00" max="23:00">
            </div>
            </div>
            
            </div >
            <div class="modal-footer" id = 'Allow'>
              <button type="submit" class="btn btn-secondary"  style = 'background-color:red;' id='btnReject'>Close</button>
              <button type="sumbit"  class="btn btn-primary" id = 'btnApprove' >Submit</button>
            </div>

            <div class="modal-footer" style = 'display:none;' id = 'notAllow'>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
      </div>
    </div>
  </div> -->

  <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = 'color:black;'>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h5 class="modal-title" >New Request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-3">
              <label for="subject" class="col-form-label">Subject</label>
              <input type="text" class="form-control" id="subject" required>
            </div>
            <div class="mb-3">
              <label for="reason" class="col-form-label">Detailed Reason</label>
              <textarea class="form-control" id="reason" required></textarea>
            </div>

            <div class="mb-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value='true' id="equipment">
                <label class="custom-control-label" for="equipment">Equipment Required</label>
                <input type="text" id="equipmentInput" class="form-control" style="display: none;" placeholder="Enter equipment details" >
          
            </div>
            </div>

            <div class="mb-3">
            <div class="custom-control custom-checkbox">
                <label class="custom-control-label" >Size</label>
                <br>
                
                <input type="radio" class="custom-control-input" value='large' name ='size' id ='size_large' checked>
                <label for="size_large">large</label>
                <input type="radio" class="custom-control-input" value='small' name = 'size' id ='size_small'>
                <label for="size_small">small</label>
                
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
              <label for="datepicker" class="input-group-text">Date for LT</label>
              <input placeholder="Select date" type="date" id="datepicker" class="form-control" required>
              <span class="input-group-text"><i class="fas fa-calendar"></i></span>
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
              <label for="timepicker" class="input-group-text">Time</label>
              <input type="time" id="timepicker" class="form-control"  required>
            </div>
            </div>

          <div >
           <label for="Duration">Duration (in hours)</label>
           <input type="number" class="form-control" id="Duration" placeholder="1" value="1" min = 1 max = 13  required>
          
          </div>
            
        </div >
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="sumbit"  class="btn btn-primary">Send Request</button>
        </div>


        </form>
      </div>
    </div>
  </div>

  <table class="table" id = 'table-view'>
    <thead>
      <tr>
        <th>#</th>
        <th>Subject</th>
        <th>Requested Date</th>
        <th>Equipment</th>
        <th>Mentor Status</th>
        <th>System Administrator status</th>
        <th>Assigned LT</th>
        <!-- <th></th> -->
      </tr>
    </thead>
  
  </table>
</div>

<div class="create-holder">
<button class="create" data-bs-toggle="modal" data-bs-target="#Modal" >
  <span>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg> Create new Request
    </span>
  </button>
</div>






<script>


var today = new Date();
    
    // Calculate tomorrow's date
    var tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    
    var futureDate = new Date(today);
    futureDate.setDate(today.getDate() + 15);
    
    // Format the future date as YYYY-MM-DD
    var futureDateFormatted = futureDate.toISOString().split('T')[0];
    // Format tomorrow's date as YYYY-MM-DD
    var tomorrowFormatted = tomorrow.toISOString().split('T')[0];
    
    // Set the min attribute of the date input to tomorrow's date
    $('#datepicker').attr('min', tomorrowFormatted);

    $('#datepicker').attr('max', futureDateFormatted);

document.getElementById('btnlogout').href = window.location.pathname+'/logout';
  console.log('hello')
  //$("#datepicker").datepicker("option", "minDate", 0);

  function refreshTable(){
    var datatable = $("#table-view").DataTable({
                  "paging": false,
                  "lengthChange": false,
                  "pageLength": -1,
                  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                  "searching": true,
                  "info": false,
                  "autoWidth": false,
                  "ajax": {
                      url:  window.location.pathname+"/view",
                      type: "get",
                      dataSrc: function (result) {
                        for (let i = 0; i < result.data.length; i++) {
                          if(result.data[i][6] == -1)
                          {
                            result.data[i][6] = "pending";
                          }

                          if(result.data[i][6] == -2)
                          {
                            result.data[i][6] = "not available";
                          }
                        }
                        return result.data;
                      }
                  },
                  "initComplete": function () {
                      
                  }
              });
  }

  function checkTimeLimit(time, duration) {
  // Parse the selected time using moment.js
  const selectedMoment = moment(time, 'HH:mm');

  // Calculate the new time after adding the duration
  const newMoment = selectedMoment.clone().add(duration, 'hours');

  // Check if the new time is after 23:00
  return newMoment.isAfter(moment('23:00', 'HH:mm'));
}


function roundToNearestHour(time) {
  // Parse the selected time using moment.js
  selectedMoment = moment(time, 'HH:mm');

  // Round to the nearest hour
  roundedMoment = selectedMoment.clone().startOf('hour').add(Math.round(selectedMoment.minute() / 30) * 30, 'minutes');

    // Ensure the rounded time is at least 10:00
    minTime = moment('10:00', 'HH:mm');
  if (roundedMoment.isBefore(minTime)) {
    roundedMoment = minTime.clone();
  }

  // Format the result as HH:mm
  return roundedMoment.format('HH:mm');
}

$('#timepicker').on('change.timepicker', function(e) {
    
  $("#timepicker").val(roundToNearestHour($("#timepicker").val()));
});
$(document).ready(function () {
  
  refreshTable();
  $('#equipment').change(function() {
      // Toggle the visibility of the input text field based on the checkbox state
      $('#equipmentInput').toggle(this.checked);
    });

  $("form").submit(function (event) {
    event.preventDefault();
    var formData = {
      subject: $("#subject").val(),
      reason: $("#reason").val(),
      date: $("#datepicker").val(),
      equipment:  document.getElementById('equipment').checked,
      equipmentDetails: $("#equipmentInput").val(),
      size: $('input[name="size"]:checked').val(),
      time:  $("#timepicker").val(),
      duration:  $("#Duration").val(),
      _token: $("input[name='_token']").val(),
    };
    console.log(formData);
    

    //    Validation
    $flag = true;

      if (checkTimeLimit($("#timepicker").val(), $("#Duration").val())) {
        $flag = false;
        toastr.error("LT can only be booked till 11 pm");
      }
    

    





                  if($flag){
                      $.ajax({
                        type: "POST",
                        url: window.location.pathname+"/request",
                        data: formData,
                        success: function (response) {
                              // Handle the success response here
                              //console.log(response);

                              // Display a success message using alert()
                              if(response.status == 'error')
                                toastr.error(response.message);
                              else
                                toastr.success(response.message);
                              $('#table-view').DataTable().ajax.reload();
                              // You can update the UI, show a message, or perform additional actions
                        },
                        error: function (error) {
                              // Handle the error if the request fails
                            // console.error(error);

                              // Display an error message using toastr
                              toastr.error("Error: Something went wrong. Please try again.");
                          }
                      });
                      $('#Modal').modal('hide');
                      $('#table-view').DataTable().ajax.reload();
                  }
  });
  $('#table-view tbody').on('click', 'tr', function () {
    var data = tabletoday.row( this ).data();
      alert( 'Record ID: ' + data.RecordID );
  } );
  var currentDate = new Date().toISOString().split('T')[0];

  // Set the default date for the date picker input
  document.getElementById('datepicker').value = currentDate;
});

  
$("#equipment").on("click", function () {
  console.log(this.checked);
  if(this.checked)
  {
    document.getElementById("equipmentInput").required = true;
  }

  else
  {
    document.getElementById("equipmentInput").required = false;
  }
})

$("[type='number']").keypress(function (evt) {
    evt.preventDefault();
});


</script>
</body>
</html>
