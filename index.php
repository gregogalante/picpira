<?php

require_once 'config.php';

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Picpira</title>

    <meta name="$VERSION" content="<?php echo $VERSION; ?>">
    <meta name="$DIRECTORY_PATH" content="<?php echo $DIRECTORY_PATH; ?>">

    <link rel="stylesheet" href="<?php echo $DIRECTORY_PATH; ?>build/index.css?v=<?php echo $VERSION; ?>">
  </head>
  <body>
    <div id="root"></div>
    <script src="<?php echo $DIRECTORY_PATH; ?>build/index.js?v=<?php echo $VERSION; ?>"></script>
  </body>
</html>