# Simple PHP router
It's simple...
```
<?php

  require_once 'Router.php';

  try {
    Router::route('GET', '/^\/$/', function($array){
      include 'views/index.php';
    });

    Router::route('GET', '/^\/echo/(.*)$/', function($array){
      echo htmlspecialchars($array[0]);
    });

    Router::route('POST', '/^\/upload$/', function($array){
      // ...
    });

    Router::accept();
  } catch (NoRouteException $e) {
    include 'error/404.php';
  }

?>
```
