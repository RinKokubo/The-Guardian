<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <div id="app">
    <intro-component></intro-component>
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>

<style>
  body {
    max-height: 100vh;
    max-width: 100vw;
  }
</style>