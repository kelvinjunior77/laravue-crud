<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <!-- Ziggy rotas -->
    @routes
    @inertiaHead
  </head>
  <body class="bg-sky-100">
    @inertia
  </body>
</html>