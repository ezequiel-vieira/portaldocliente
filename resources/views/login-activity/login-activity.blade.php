@extends('layouts.index')

@section('template_title')
    ActivityLog
@endsection

@section('template_linked_css')
  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    #myUsersInput 
    {
      background-image: url('/css/searchicon.png');
      background-position: 10px 12px;
      background-repeat: no-repeat;
      width: 100%;
      font-size: 16px;
      padding: 12px 20px 12px 10px;
      border: 1px solid #ddd;
      margin-bottom: 12px;
    }
    #myUsersUL {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }
    #myUsersUL li a {
      border: 1px solid #ddd;
      margin-top: -1px;
      background-color: #f6f6f6;
      padding: 12px;
      text-decoration: none;
      font-size: 18px;
      color: black;
      display: block;
    }
    #myUsersUL li a:hover:not(.header) {
      background-color: #eee;
    }
    .card-body {
      padding: 0.5rem;
    }
    .card {
      border: 1px solid rgba(0,0,0,.125);
    }
    .card-header {
      font-size: 1.5rem;
      color: white !important;
    }
  </style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Histórico</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="card bg-secondary mb-3 ">
                  <div class="card-header bg-secondary text-white ">
                      <i class="fa fa-key"></i> Histórico
                  </div>
                  <div class="card-body">
                      <input type="text" id="myUsersInput" onkeyup="myFunction(); return false;" placeholder="Search for names..">
                      <ul id="myUsersUL">
                          @foreach($users as $user)
                              <li><a href="/login-activity/{{$user->user_id}}">{{$user->username}}</a></li>
                          @endforeach
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('footer_scripts')
    <script>
        function myFunction() {
          // Declare variables
          var input, filter, ul, li, a, i, txtValue;
          input = document.getElementById('myUsersInput');
          filter = input.value.toUpperCase();
          ul = document.getElementById("myUsersUL");
          li = ul.getElementsByTagName('li');

          // Loop through all list items, and hide those who don't match the search query
          for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              li[i].style.display = "";
            } else {
              li[i].style.display = "none";
            }
          }
        }
    </script>
@endsection
