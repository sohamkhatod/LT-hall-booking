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
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
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

<div class="table-container">
  <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = 'color:black;'>
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



<script>
  console.log('hh')

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

  
  document.getElementById('btnlogout').href = window.location.pathname+'/logout';

    // $.ajax({
    //    type: "get",
    //    url:  window.location.pathname+"/view",
    //    data: {
    //    },
    //    success: function (response) {
    //         response = JSON.parse(response).data;
    //         var table = document.getElementById("table-view");
    //         for (let i = 0; i < response.length; i++) {
    //           var row = table.insertRow(i+1);
    //           var index = row.insertCell(0);
    //           var subject = row.insertCell(1);
    //           var date = row.insertCell(2);
    //           var equipment = row.insertCell(3);
    //           var status = row.insertCell(4);
    //           var sa_status = row.insertCell(5);
    //           var assigned_lt = row.insertCell(6);
    //           var button_view = row.insertCell(7);

    //           index.innerHTML = response[i][0];
    //           var link1 = response[i][1].split('>')[0] + '>';
    //           var link2 = '<' + response[i][1].split('<')[2];
    //           var linkText = response[i][1].split('<')[1].split('>')[1];
    //           subject.innerHTML = linkText;
    //           date.innerHTML = response[i][2];
    //           var x = document.createElement("BUTTON");
    //           if(response[i][3] == null)
    //           {
    //             equipment.innerHTML = "none";
    //           }
    //           else
    //           {
    //             equipment.innerHTML = response[i][3];
    //           }
    //           status.innerHTML = response[i][4];
    //           sa_status.innerHTML = response[i][5];
    //           assigned_lt.innerHTML = response[i][6];
    //           x.innerHTML = "view";
    //           button_view.appendChild(x);

    //           if(assigned_lt.innerHTML == -1)
    //           {
    //             assigned_lt.innerHTML = "pending";
    //           }

    //           if(assigned_lt.innerHTML == -2)
    //           {
    //             assigned_lt.innerHTML = "not available";
    //           }

    //           x.classList.add("btn-view");
    //         }
    //   },
    //   error: function (error) {
    //         toastr.error("Error: Something went wrong. Please try again.");
    //     }
    //  });



function approve(approval){
  $.ajax({
       type: "POST",
       url:  window.location.pathname+"/approve",
       data: {
        _token: $("input[name='_token']").val(),
        requestId: $("input[name='_requestId']").val(),
        'approval':approval,
        equipment:  document.getElementById('equipment').checked,
       },
       success: function (response) {
            // Handle the success response here
            //console.log(response);

            // Display a success message using alert()
            toastr.success(response.message);
            
            $('#table-view').DataTable().ajax.reload();
            // You can update the UI, show a message, or perform additional actions
      },
      error: function (error) {
            // Handle the error if the request fails
           // console.error(error);
          console.log();
            // Display an error message using toastr
            toastr.error("Error: Something went wrong. Please try again.");
        }
     });
    $('#Modal').modal('hide');
    
}
  
$(document).ready(function () {
  
 
  $('#equipment').change(function() {
      // Toggle the visibility of the input text field based on the checkbox state
      $('#equipmentInput').toggle(this.checked);
    });

  $("form").submit(function (event) {
    event.preventDefault();
    var val = $(event.target).find("input[type=submit]:focus");
    var formData = {

    };








  });

  $('#btnReject').click(function() {
      approve('Rejected');
    });

  $('#btnApprove').click(function() {
      approve('Approved');
    });
    
    
    

  // $('#table-view tbody').on('click', 'tr', function () {
  //   var data =  datatable.row(this).data();
  //   alert( 'Record ID: ' + data[0]);
  //   console.log(data);
  // } );
  
  var currentDate = new Date().toISOString().split('T')[0];

  // Set the default date for the date picker input
  document.getElementById('datepicker').value = currentDate;
});

console.log("hi");

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
            // toastr.success(response.message);
            response = response.data;
            console.log(response);
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

            $('#modal-title').html('Request By ' + response.createdBy);

            if(response.Status != 'Pending'){
              $('#Allow').hide();
              $('#notAllow').show();
            }else{
              $('#Allow').show();
              $('#notAllow').hide();
            }

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

})

          
</script>
</body>
</html>
