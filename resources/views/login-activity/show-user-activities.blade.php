@extends('layouts.index')

@section('template_title')
    ActivityLog
@endsection

@section('template_linked_css')
    <!-- Styles -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <style type="text/css">
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
        <li class="breadcrumb-item"><a href="/login-activity/">Histórico</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            @isset($activities)
            {{ ucfirst($activities[0]['username']) }}
            @endisset
        </li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-secondary mb-3">
                    <div class="card-header bg-secondary text-white ">
                        <i class="fa fa-key"></i> Histórico
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive table-bordered">
                            <thead>
                            <tr>
                                <th>Event</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Agent</th>
                                <th>IP</th>
                                <th>DateTime</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activities as $activity)
                            <tr>
                                <td> 
                                    <?php
                                    
                                        if( $activity->type === "Successfully Logged In")
                                        {
                                            echo '<i style="color: green;" class="fa fa-power-off" aria-hidden="true"></i>';
                                        }elseif( $activity->type === "Logged Out"){
                                            echo '<i style="color: red;" class="fa fa-power-off" aria-hidden="true"></i>';
                                        }else{
                                            echo $activity->type;  
                                        }
                                    ?>
                                    
                                </td>
                                <td>{{ $activity->username }}</td>
                                <td>{{ $activity->user_mail }}</td>
                                <td>{{ $activity->user_agent }}</td>
                                <td>{{ $activity->ip_address }}</td>
                                <td>{{ $activity->created_at->diffForHumans() }}</td>
                                <td>{{ $activity->created_at }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="pagination">
                            {{ $activities->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



