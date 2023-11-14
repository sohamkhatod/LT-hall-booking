<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Centered Table</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
        /* fallback for old browsers */
            background: #6a11cb;
        
        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
      height: 100vh;
      /* display: flex;
      align-items: center;
      justify-content: center; */
    }

    .table-container {
      margin: 20vh 8vw ;
      background-color: #333;
      padding: 4px;
      border-radius: 10px;
      width: 80vw;
      max-width: 600px; /* Optional: Set a max-width for larger screens */
    }

    .dark-theme {
      background-color: #333;
      color: #fff;
    }
  </style>
</head>
<body>


<div class="table-container">
  <table class="table dark-theme">
    <thead>
      <tr>
        <th>#</th>
        <th>Subject</th>
        <th>Requested Date</th>
        <th>Equipment</th>
        <th>Status</th>
        <th>Assigned LT</th>
      </tr>
    </thead>
  
  </table>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
