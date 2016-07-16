@extends('layouts.master')

@section('content')
  <div id="header" class="jumbotron">
    <h2>{{ $lang['header'] }}</h2>
    <p>{{ $lang['header-desc'] }}</p>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="">
            {{ csrf_field() }}

            <div class="form-group required {{ $errors->first('email', 'has-error') }}">
              <label for="email">{{ $lang['email-address'] }}</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="{{ $lang['email-placeholder'] }}" value="{{ old('email', $job->email) }}">
              {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group required {{ $errors->first('title', 'has-error') }}">
              <label for="title">{{ $lang['job-title'] }}</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="{{ $lang['title-placeholder'] }}" value="{{ old('title', $job->title) }}">
              {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group required {{ $errors->first('details', 'has-error') }}">
              <label for="details">{{ $lang['job-details'] }}</label>
              <input type="text" class="form-control" id="details" name="details" placeholder="{{ $lang['details-placeholder'] }}" value="{{ old('details', $job->details) }}">
              {!! $errors->first('details', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">{{ $lang['skills'] }}</label>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="html5" {{ old('html5', $job->hasSkill->html5) ? 'checked' : '' }}> {{ $lang['html5'] }}
                </label>
                <label>
                  <input type="checkbox" name="css3" {{ old('css3', $job->hasSkill->css3) ? 'checked' : '' }}> {{ $lang['css3'] }}
                </label>
                <label>
                  <input type="checkbox" name="javascript" {{ old('javascript', $job->hasSkill->javascript) ? 'checked' : '' }}> {{ $lang['javascript'] }}
                </label>
                <label>
                  <input type="checkbox" name="jquery" {{ old('jquery', $job->hasSkill->jquery) ? 'checked' : '' }}> {{ $lang['jquery'] }}
                </label>
                <label>
                  <input type="checkbox" name="php" {{ old('php', $job->hasSkill->php) ? 'checked' : '' }}> {{ $lang['php'] }}
                </label>
                <label>
                  <input type="checkbox" name="mysql" {{ old('mysql', $job->hasSkill->mysql) ? 'checked' : '' }}> {{ $lang['mysql'] }}
                </label>
                <label>
                  <input type="checkbox" name="laravel" {{ old('laravel', $job->hasSkill->laravel) ? 'checked' : '' }}> {{ $lang['laravel'] }}
                </label>
              </div>
            </div>
            
            <button type="submit" class="btn btn-default">{{ $lang['submit'] }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop  
