<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /*.gradient-custom {
        background: #6a11cb;
        
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }*/


    </style>
</head>

<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="d-flex justify-content-center align-items-center h-100 w-100">
      <div class="d-flex flex-row justify-content-center align-items-center">
        <div class="card text-dark" style="border-radius: 1rem 0 0 1rem;border: 0;">
          <div class="card-body p-5 text-center">

          <form  method="post">
            <div class="mb-md-5 mt-md-4 pb-5">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-dark-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="username" name="username" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX">Email</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" name="password" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX">Password</label>
              </div>

            @isset ( $error)
            
            <div style = 'color:red;'> {{ $error}}</div>
            @endisset


              <p class="small mb-5 pb-lg-2"><a class="text-dark-50" href="#!">Forgot password?</a></p>

              <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

          

            </div>
          </form>

          </div>
        </div>
        <div class="card text-dark" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>