<!DOCTYPE html>
<html lang="en">
<head>
  <title>URL Shortener</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
  
<div class="container-fluid">
  <h1>URL Shortener</h1>
  <br>
  <a href="/">Home</a>
  <br>
  @if(Session::has('errormsg'))
    <div class="alert alert-danger">
      {{ Session::get('errormsg')}}
    </div>
  @endif
  @if(Session::has('successmsg'))
    <div class="alert alert-success">
      {{ Session::get('successmsg')}}
    </div>
  @endif
  <br>
  <br>
  <div class="row">
    <div class="col-sm-5" style="padding: auto;margin: 20px;">
        <div class="alert alert-info"><b>Enter your long URL below to shorten it</b></div>
        <b>URL:</b>
        <form method="POST" action="/urlshortener/shortify" class="form form-horizontal">
          @csrf 
          <input type="text" class="form-control" name="url" placeholder="like https://google.com">
          <br>
          <input type="submit" class="btn btn-success" name="shortify" value="Shorten">
        </form>    
    </div>

    <div class="col-sm-10">
       @if(Session::has('shorturl'))
        <b>Short URL:</b> 
        <a href="{{url('/')."/u/".Session::get('shorturl')}}" target="_blank">
        {{url('/')."/u/".Session::get('shorturl')}}
        </a>
       @endif
    </div>
  </div>
  
</div>

</body>
</html>
