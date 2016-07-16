@extends('layouts.master')

@section('content')
      <div id="header" class="jumbotron">
        <h2>Job Portal</h2>
        <p>Simple job board for technical hirings.</p>
      </div>

      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-9">
              <div class="navbar-form" role="search">
                  <form id="search" method="post" action="{{ route('home') }}">
                    {{ csrf_field() }}
                    <div class="input-group" style="width: 100%;">
                        <input id="search_term" class="form-control" type="text" name="search_term" placeholder="Search" value="{{ old('search_term', $search_term) }}">
                        <div class="input-group-btn">
                            <button id="submit" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                  </form>
              </div>
            </div>
            <div class="col-md-3">
              <a href="{{ route('job.create') }}">
                <button id="post-a-job" type="button" class="btn btn-primary pull-right">Post a Job</button>
              </a>
            </div>
          </div>
          
        </div>
      </div>
      
      @foreach($jobs as $job)
        <div class="panel panel-default">
          <div class="panel-body">
              <div class="row">
                <div class="col-md-9">
                  <h2>{{ $job->title }}</h2>
                  <p>{{ $job->details }}</p>
                </div>
                <div class="col-md-3">
                  <p>Posted By: {{ $job->email }}</p>

                  <div id="skills">
                    @foreach($job->skills as $skill)
                      <div class="btn-group" role="group"> 
                        <button type="button" class="btn btn-default">{{ $skill->name }}</button> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            
          </div>
        </div>
      @endforeach
@stop
