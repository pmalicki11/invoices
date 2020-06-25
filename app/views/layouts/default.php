<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="<?=PROOT?>css/style.css" rel="stylesheet" type="text/css">
    <title><?=$this->getSiteTitle();?></title>
    <?=$this->content('head');?>
  </head>
  <body>
    <h1>Invoices</h1>
    <?php include 'menu.php'; ?>
    <?=$this->content('body');?>
  </body>
</html>
