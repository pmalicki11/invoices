<?php $this->setSiteTitle('Invoices - add');?>

<?php $this->start('head');?>
  <script src="<?=PROOT?>js/invoices.js"></script>
<?php $this->end();?>

<?php $this->start('body');?>
  <ul>
    <?php foreach($this->errors as $field => $error): ?>
      <li><?=$error?></li>
    <?php endforeach; ?>
  </ul>

  <form action="<?=PROOT?>invoices/add" method="post" id="form">
    <table class="form-input" id="invoiceTable">
      <?php include "form.php"; ?>
    </table>
    <div id="invPositionsContainer"></div>
    <div class="center">
      <input type="button" value="Add position" class="btn-additional" id="addInvoicePosition"></input>
      <input type="submit" value="Add invoice" class="btn-submit"></input>
    </div>
  </form>
<?php $this->end();?>
