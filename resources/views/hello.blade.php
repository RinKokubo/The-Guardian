<head>
  <!-- ... -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <div id="app">
    <hello-component></hello-component>
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>

<style>
  body {
    max-height: 100vh;
    max-width: 100vw;
  }
</style>