<?php $this->setSiteTitle('Invoices - invoice');?>
<?php $this->start('body');?>
<h1>INVOICE <?=$this->invoice['number']?></h1>
<div class="inv-header">
  <div class="inv-company">
    <div><span>pmalicki</span></div>
    <div><span>3/9 Poniatowskiego St,<br /> ZACH 74200, PL<span></div>
    <div><span>+48 123 456 789</span></div>
    <div><span>info@pmalicki.com</span></div>
  </div>
  <div class="inv-customer">
    <div><span>Customer: <?=$this->customer['name']?></span></div>
    <div>
      <span>Address:
        <?=$this->customer['address']?><br />
        <?=$this->customer['state'] . ' ' . $this->customer['zip'] . ', ' . $this->country['code']?>
      </span>
    </div>
    <div><span>Contact: <?=$this->customer['contact']?></span></div>
    <div><span>Date: <?=$this->invoice['date']?></span></div>
  </div>
</div>
<div class="inv-posiions">
  <table>
    <tr>
      <th>Position</th>
      <th>Name</th>
      <th>Quantity</th>
      <th>Unit price</th>
      <th>Value</th>
    </tr>
    <?php foreach($this->positions as $position): ?>
      <tr>
        <td><?=$position['position']?></td>
        <td><?=$position['name']?></td>
        <td><?=$position['quantity']?></td>
        <td><?=$position['unitPrice']?></td>
        <td><?=$position['value']?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
<?php $this->end();?>
