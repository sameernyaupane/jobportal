<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Job Portal</title>

    <link href="{{{ asset('css/bootstrap.min.css') }}}" rel="stylesheet">
    <link href="{{{ asset('css/style.css') }}}" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Job Portal</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li {{ $currentRoute == 'home' ? 'class=active' : '' }}>
                <a href="{{ route('home') }}">Home</a>
              </li>
              <li {{ $currentRoute == 'post.job' ? 'class=active' : '' }}>
                <a href="{{ route('job.create') }}">Post a Job</a>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      @include('partials.notifications')

      @yield('content')

    <div class="footer">
      <div class="container">
        <p class="text-muted">&copy; Sameer Nyaupane</p>
      </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{{ asset('js/jquery.min.js') }}}"><\/script>')</script>
    <script src="{{{ asset('js/bootstrap.min.js') }}}"></script>
    <script src="{{{ asset('js/custom.js') }}}"></script>
  </body>
</html>
