<!DOCTYPE html>
<html lang="en">
<head>
  <title>ESTRELLA</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>




</head>
<body>

    <?php echo $this->Flash->render() ?>

    <div class="container" style="padding-top: 10px">
        <?php echo $this->fetch('content') ?>
    </div>

</body>
</html>

