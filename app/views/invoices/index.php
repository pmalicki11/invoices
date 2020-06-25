<?php $this->setSiteTitle('Invoices');?>
<?php $this->start('body');?>
<a href="<?=PROOT?>invoices/add">Add new Invoice</a>
<div class="list-container">
  <table class="table-list">
    <tr>
      <th>Number</th>
      <th>Customer</th>
      <th>Date</th>
      <th></th>
    </tr>
    <?php foreach($this->invoices as $invoice): ?>
      <tr>
        <td><a href="<?=PROOT?>invoices/showInvoice/<?=$invoice['id']?>"><?=$invoice['number']?></a></td>
        <td><?=$invoice['customerName']?></td>
        <td><?=$invoice['date']?></td>
        <td>
          <a href="<?=PROOT?>invoices/delete/<?=$invoice['id']?>" onclick="if(!confirm('Are you sure?')){return false;}">Remove</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
<?php $this->end();?>
