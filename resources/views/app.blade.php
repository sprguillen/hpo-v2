<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('includes.head')
  </head>
  <body>
    <div id="app">
			<router-view></router-view>
		</div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
  </body>
</html>
