<?php $this->setSiteTitle('Customers - add');?>

<?php $this->start('body');?>

<ul>
  <?php foreach($this->errors as $field => $error): ?>
    <li><?=$error?></li>
  <?php endforeach; ?>
</ul>

<form action="<?=PROOT?>customers/add" method="post" id="form">
  <table class="form-input">
    <?php include "form.php"; ?>
    <tr>
      <td colspan="2" class="center"><input type="submit" value="Add" class="btn-submit"></input></td>
    </tr>
  </table>
</form>
<?php $this->end();?>
