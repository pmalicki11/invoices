<?php $this->setSiteTitle('Invoices - edit');?>

<?php $this->start('body');?>

<ul>
  <?php foreach($this->errors as $field => $error): ?>
    <li><?=$error?></li>
  <?php endforeach; ?>
</ul>

<form action="<?=PROOT?>invoices/edit" method="post" id="form">
  <input type="text" id="id" name="id"
    value="<?=(isset($_POST['id'])) ? $_POST['id'] : ''?>" class="hidden">
  <table class="form-input">
    <?php include "form.php"; ?>
    <tr>
      <td colspan="2" class="center"><input type="submit" value="Update" class="btn-submit"></input></td>
    </tr>
  </table>
</form>
<?php $this->end();?>
