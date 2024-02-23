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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-timepicker@0.5.2/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Bootstrap Datepicker JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-timepicker@0.5.2/js/bootstrap-timepicker.min.js"></script>

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
    }

    table.dataTable td
    {
      padding: 18px;
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

  </style>
</head>
<body>

  <div class="header">
    <div class="user-name">Hi {{Session::get('User')}}!</div>
      <a id = 'btnlogout' href='../logout' style="text-decoration: none; text-align: center;">
        <div   class="log-out">
          Log Out
        </div>
      </a>
  </div>

 <div style = 'color:white;'  class="table-container">

<br>
<br>
<br>
<br>
<br>

<div class="modal fade" id="BookLt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = 'color:black;'>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h5 class="modal-title" id = "modal-title">New Request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id='BookLTForm'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-3">
              <label for="LT_subject" class="col-form-label">LT for subject</label>
              <input type="text" class="form-control" id="LT_subject">
            </div>

            <div class="mb-3">
              <label for="LT_person" class="col-form-label">LT for Person</label>
              <input type="text" class="form-control" id="LT_person">
            </div>

            <div class="mb-3">
            <div class="custom-control custom-checkbox">
                <label class="custom-control-label" >Size</label>
                <br>
                
                <input type="radio" class="custom-control-input" value='large' name ='LT_size' id ='LT_size_large' checked>
                <label for="LT_size_large">large</label>
                <input type="radio" class="custom-control-input" value='small' name = 'LT_size' id ='LT_size_small'>
                <label for="LT_size_small">small</label>
                
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
              <label for="LT_datepicker" class="input-group-text">Date for LT</label>
              <input placeholder="Select date" type="date" id="LT_datepicker" class="form-control">
              <span class="input-group-text"><i class="fas fa-calendar"></i></span>
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
              <label for="LT_timepicker" class="input-group-text">Start Time</label>
              <input type="time" id="LT_timepicker" class="form-control">
            </div>
            </div>


            <div class="mb-3">
            <div class="input-group">
              <label for="LT_timepicker2" class="input-group-text">End Time</label>
              <input type="time" id="LT_timepicker2" class="form-control">
            </div>
            </div>
           
            <select class="form-select" aria-label="Default select example" style='display:none;' id = 'availableLT'>
              <option selected>Open this select menu</option>
            </select>

            <div class="modal-footer" >
              <button type="button" class="btn btn-secondary"  style = 'background-color:red;' data-bs-dismiss="modal" >Close</button>
              <button type="sumbit"  class="btn btn-primary" id = 'btnSearch' >Search</button>
              <button type="sumbit"  class="btn btn-primary" id = 'btnBook' style='display:none;' >BookLT</button>
            </div>


        </form>
      </div>
    </div>
  </div>
</div>
<!--


<br>

<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = 'color:black;'>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h5 class="modal-title" id = "modal-title1">New Request</h5>
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
              <input type="time" id="timepicker" class="form-control">
            </div>
            </div>


            <div class="mb-3">
            <div class="input-group">
              <label for="timepicker2" class="input-group-text">End Time</label>
              <input type="time" id="timepicker2" class="form-control">
            </div>
            </div>
            
        </div >


            <select class="form-select" aria-label="Default select example" style='display:none;' id = 'availableLT2'>
              <option selected>Open this select menu</option>
            </select>

            <div class="modal-footer" >
              <button type="button" class="btn btn-secondary"  style = 'background-color:red;' data-bs-dismiss="modal" >Close</button>
              <button type="sumbit"  class="btn btn-primary" id = 'btnSearch2' >Search</button>
              <button type="sumbit"  class="btn btn-primary" id = 'btnBook2' style='display:none;' >BookLT</button>
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

<!-- Added by arnav -->

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
              <input type="time" id="timepicker" class="form-control">
            </div>
            </div>


            <div class="mb-3">
            <div class="input-group">
              <label for="timepicker2" class="input-group-text">End Time</label>
              <input type="time" id="timepicker2" class="form-control">
            </div>
            </div>
            
            </div >
            <div class="modal-footer" id = 'Allow'>
              <button type="submit" class="btn btn-secondary"  style = 'background-color:red;' id='btnReject'>Reject</button>
              <button type="sumbit"  class="btn btn-primary" id = 'btnApprove' >Approve</button>
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
          
          <h5 class="modal-title" id = "modal-title1">New Request</h5>
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
              <input type="time" id="timepicker" class="form-control">
            </div>
            </div>


            <div class="mb-3">
            <div class="input-group">
              <label for="timepicker2" class="input-group-text">End Time</label>
              <input type="time" id="timepicker2" class="form-control">
            </div>
            </div>
            
        </div >


            <select class="form-select" aria-label="Default select example" style='display:none;' id = 'availableLT2'>
              <option selected>Open this select menu</option>
            </select>

            <div class="modal-footer" >
              <button type="button" class="btn btn-secondary"  style = 'background-color:red;' data-bs-dismiss="modal" >Close</button>
              <button type="sumbit"  class="btn btn-primary" id = 'btnSearch2' >Search</button>
              <button type="sumbit"  class="btn btn-primary" id = 'btnBook2' style='display:none;' >BookLT</button>
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
        <th></th>
      </tr>
    </thead>
  
  </table>
</div>

<div class="create-holder">

<button type="button" class="create" style = 'color:white;margin-right :20px;' data-bs-toggle="modal" data-bs-target="#BookLt" >Book LT</button>
  
  <a id ='btnLTview'class="create" href="table">
    <span>
      View Assigned LTs
    </span>
  </a>
</div>



<script>
  console.log('hello')
  var today = new Date();
  today =  today.toISOString().split('T')[0];
  $('#LT_datepicker').attr('min', today);
  document.getElementById('btnlogout').href = window.location.pathname+'/logout';
  document.getElementById('btnLTview').href = window.location.pathname+'/table';
  

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
                        console.log(result.data)
                        for (let i = 0; i < result.data.length; i++) {
                          var link1 = result.data[i][1].split('>')[0] + '>';
                          var link2 = '<' + result.data[i][1].split('<')[2];
                          var linkText = result.data[i][1].split('<')[1].split('>')[1];
                          var x = document.createElement("a");
                          x.innerHTML = "view";
                          x.classList.add("btn-view");
                          x.setAttribute("href","#Modal");
                          x.setAttribute("data-bs-target","#Modal");
                          x.setAttribute("data-bs-toggle","modal");
                          x.setAttribute("data-bs-requestId", result.data[i][0]);
                          result.data[i].push(x.outerHTML);
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
  
  refreshTable();
 
  function roundToNearestHour(time) {
  // Parse the selected time using moment.js
  selectedMoment = moment(time, 'HH:mm');

  // Round to the nearest hour
  roundedMoment = selectedMoment.clone().startOf('hour').add(Math.round(selectedMoment.minute() / 30) * 30, 'minutes');

    // Ensure the rounded time is at least 10:00
  //   minTime = moment('10:00', 'HH:mm');
  // if (roundedMoment.isBefore(minTime)) {
  //   roundedMoment = minTime.clone();
  // }

  // Format the result as HH:mm
  return roundedMoment.format('HH:mm');
};
$(document).ready(function () {
  
  $('#LT_timepicker').on('change.timepicker', function(e) {
    
      $("#LT_timepicker").val(roundToNearestHour($("#LT_timepicker").val()));
  });

  $('#LT_timepicker2').on('change.timepicker', function(e) {
      
      $("#LT_timepicker2").val(roundToNearestHour($("#LT_timepicker2").val()));
  });

  $('#equipment').change(function() {
      // Toggle the visibility of the input text field based on the checkbox state
      $('#equipmentInput').toggle(this.checked);
    });

  $("form").submit(function (event) {
    event.preventDefault();
    var val = $(event.target).find("input[type=submit]:focus");

  });

  $('#btnBook2').click(function() {
      var formData = {
        LT_subject: $("#subject").val(),
        LT_person:  requestData.createdBy,
        LT_date: $("#datepicker").val(),
        LT_start_time: $("#timepicker").val(),
        LT_end_time: $("#timepicker2").val(),
        _token: $("input[name='_token']").val(),
        requestId: $("input[name='_requestId']").val(),
        LT_no: $("#availableLT2").val(),
      };
      console.log(formData);
      $.ajax({
       type: "POST",
       dataType: "json",
       url:  window.location.pathname+"/BookLT",
       data: formData,
       success: function (response) {
            // Handle the success response here
            //console.log(response);

            // Display a success message using alert()
            toastr.success(response.message);         
            $('#Modal').modal('hide');
            $('#table-view').DataTable().ajax.reload();

      },
      error: function (error) {
            // Handle the error if the request fails
           // console.error(error);
          console.log();
            // Display an error message using toastr
            toastr.error("Error: Something went wrong. Please try again.");
        }

     });
    });
   
    

  $('#btnSearch2').click(function() {
      var formData = {
        LT_subject: $("#subject").val(),
        LT_person: requestData.createdBy,
        LT_date: $("#datepicker").val(),
        LT_start_time: $("#timepicker").val(),
        LT_size:$('input[name="size"]:checked').val(),
        LT_end_time: $("#timepicker2").val(),
        _token: $("input[name='_token']").val(),
        requestId: $("input[name='_requestId']").val(),

      };
      
      console.log(formData);
      $.ajax({
       type: "POST",
       dataType: "json",
       url: window.location.pathname+"/availableLT",
       data: formData,
       success: function (response) {
            // Handle the success response here
            $('#availableLT2').show();
            $('#btnBook2').show();
            $('#btnSearch2').hide();

            if(response.list.length == 0){
              toastr.error("No LT available");
              //update request     
                              var formData = {
                                    LT_subject: $("#subject").val(),
                                    LT_person:  requestData.createdBy,
                                    LT_date: $("#datepicker").val(),
                                    LT_start_time: $("#timepicker").val(),
                                    LT_end_time: $("#timepicker2").val(),
                                    _token: $("input[name='_token']").val(),
                                    requestId: $("input[name='_requestId']").val(),
                                    LT_no: -2,
                                  };
                                  console.log(formData);
                                  $.ajax({
                                  type: "POST",
                                  dataType: "json",
                                  url: window.location.pathname+"/BookLT",
                                  data: formData,
                                  success: function (response) {
                                               
                                        $('#Modal').modal('hide');
                                        $('#table-view').DataTable().ajax.reload();

                                  },
                                  error: function (error) {
                                        toastr.error("Error: Something went wrong. Please try again.");
                                    }

                                  });

            }else{

              for ( let i of response.list){
                console.log(i);
                $('#availableLT2').append(new Option(i, i)); 
                                   

              }
              toastr.success('LT found');
            }
            
            //$("#availableLT").html(response[0]);
            //$("#availableLT").selectpicker('refresh')
            console.log(response);
      },
      error: function (error) {
            // Handle the error if the request fails
           // console.error(error);
          console.log();
            // Display an error message using toastr
            toastr.error("Error: Something went wrong. Please try again.");
        }
     });
  });
    
 
    
  $('#btnSearch').click(function() {
      var formData = {
        LT_subject: $("#LT_subject").val(),
        LT_person: $("#LT_person").val(),
        LT_date: $("#LT_datepicker").val(),
        LT_size:$('input[name="LT_size"]:checked').val(),
        LT_start_time: $("#LT_timepicker").val(),
        LT_end_time: $("#LT_timepicker2").val(),
        _token: $("input[name='_token']").val(),
        requestId: $("input[name='_requestId']").val(),

      };
      console.log(formData);
      $.ajax({
       type: "POST",
       dataType: "json",
       url: window.location.pathname+"/availableLT",
       data: formData,
       success: function (response) {
            // Handle the success response here
            //console.log(response);

            // Display a success message using alert()
           
            

            // You can update the UI, show a message, or perform additional actions
            $('#availableLT').show();
            $('#btnBook').show();
            $('#btnSearch').hide();

            if(response.list.length == 0){
              toastr.error("No LT available");
              $('#BookLt').modal('hide');
            }
            else{
              for ( let i of response.list){
                console.log(i);
                $('#availableLT').append(new Option(i, i)); 
              }
              toastr.success('LT found');
             
           }
           


      },
      error: function (error) {
            // Handle the error if the request fails
           // console.error(error);
          console.log();
            // Display an error message using toastr
            toastr.error("Error: Something went wrong. Please try again.");
        }
     });
    });
    




  $('#btnBook').click(function() {
      var formData = {
        LT_subject: $("#LT_subject").val(),
        LT_person: $("#LT_person").val(),
        LT_date: $("#LT_datepicker").val(),
        LT_start_time: $("#LT_timepicker").val(),
        LT_end_time: $("#LT_timepicker2").val(),
        _token: $("input[name='_token']").val(),
        requestId: $("input[name='_requestId']").val(),
        LT_no: $("#availableLT").val(),
      };
      console.log(formData);
      $.ajax({
       type: "POST",
       dataType: "json",
       url: window.location.pathname+"/BookLT",
       data: formData,
       success: function (response) {

            toastr.success(response.message);         
            $('#BookLt').modal('hide');

      },
      error: function (error) {
            // Handle the error if the request fails
           // console.error(error);
          console.log();
            // Display an error message using toastr
            toastr.error("Error: Something went wrong. Please try again.");
        }

     });
    });
   
    

 

  // $('#table-view tbody').on('click', 'tr', function () {
  //   var data =  datatable.row(this).data();
  //   alert( 'Record ID: ' + data[0]);
  //   console.log(data);
  // } );
  
  var currentDate = new Date().toISOString().split('T')[0];

  // Set the default date for the date picker input
  // document.getElementById('LT_datepicker').value = currentDate;

  $("#BookLt").on('hide.bs.modal', function(){
    $("#LT_subject").val('');
    $("#LT_person").val('');


    $('#availableLT')
    .find('option')
    .remove()
    .end();

    $('#availableLT').hide();
    $('#btnBook').hide();
    $('#btnSearch').show();
  });

  $("#Modal").on('hide.bs.modal', function(){

    $('#availableLT2')
    .find('option')
    .remove()
    .end();

    $('#availableLT2').hide();
    $('#btnBook2').hide();
    $('#btnSearch2').show();
  });

 // $('#LT_timepicker').timepicker('setTime', (new Date()).getTime());


});

var exampleModal = document.getElementById('Modal')

exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var requestId = button.getAttribute('data-bs-requestId')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  $.ajax({
       type: "GET",
       dataType: "json",
       url:  window.location.pathname+"/requestId",
       data: {
        requestId: requestId,
       },
       success: function (response) {

            $("#displayForm :input").prop("disabled", true);
            //toastr.success(response.message);
            response = response.data;
            requestData = response;
            $("input[name='_requestId']").val(requestId)
            $('#subject').val(response.subject);
            $('#reason').val(response.reason);
            $('#equipment').prop('checked', false);
            if(response.equipment){
              $('#equipment').prop('checked', true);
              $('#equipmentInput').toggle(true);
              $('#equipmentInput').val(response.equipmentDetails);
              
            }
            $('input:radio[name=size]').val([response.size]);
            var stringArray = response.forDate.split(/(\s+)/);
            console.log(stringArray);
            $('#datepicker').val(stringArray[0]);
            $('#timepicker').val(stringArray[2]);
          
            $('#timepicker2').val(response.endTime.split(/(\s+)/)[2]);

            $('#modal-title1').html('Request By ' + response.createdBy);

            if(response.Status != 'Pending'){
              $('#Allow').hide();
              $('#notAllow').show();
            }else{
              $('#Allow').show();
              $('#notAllow').hide();
            }
            if(response.LTStatus != '-1')
              $('#btnSearch2').hide();
            else
              $('#btnSearch2').show();
            console.log(response.endTime);
            //$('#table-view').DataTable().ajax.reload();
            // You can update the UI, show a message, or perform additional actions
      },
      error: function (error) {
            // Handle the error if the request fails
           // console.error(error);

            // Display an error message using toastr
            toastr.error("Error: Something went wrong. Please try again.");
        }
      });
     });



          
</script>
</body>
</html>
