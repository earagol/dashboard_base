<!DOCTYPE html>
<html lang="en">
<head>
  <title>ESTRELLA</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php echo $this->Html->css('bootstrap.min') ?>
  <?php echo $this->Html->script('vendor/jquery-1.11.3.min'); ?>
  <?php echo $this->Html->css('font-awesome.min') ?>
  <?php echo $this->Html->css('../vendors/login/font-awesome.min.css') ?>
  <?php echo $this->Html->css('../vendors/login/util.css') ?>
  <?php echo $this->Html->css('../vendors/login/main.css') ?>

  <?php echo $this->Html->script('bootstrap') ?> 

</head>
<body>

    <?php echo $this->Flash->render() ?>

    <div class="container" style="padding-top: 10px">
        <?php echo $this->fetch('content') ?>
    </div>

</body>
</html>

