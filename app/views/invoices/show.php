<?php $this->setSiteTitle('Invoices - invoice');?>
<?php $this->start('body');?>
<h1 class="center">INVOICE <?=$this->invoice['number']?></h1>
<div class="inv-header">
  <div class="row">
    <div class="cell inv-company">
      <div><span>pmalicki</span></div>
      <div><span>3/9 Poniatowskiego St,<br /> ZACH 74200, PL<span></div>
      <div><span>+48 123 456 789</span></div>
      <div><span>info@pmalicki.com</span></div>
    </div>
    <div class="cell inv-customer">
      <div><span>Customer: </span></div>
      <div>
        <span>
          <?=$this->customer['name']?><br />
          <?=$this->customer['address']?><br />
          <?=$this->customer['state'] . ' ' . $this->customer['zip'] . ', ' . $this->country['code']?>
        </span>
      </div>
      <div><span>Contact: <?=$this->customer['contact']?></span></div>
      <div><span>Tax code: <?=$this->customer['taxCode']?></span></div>
      <div><span>Date: <?=$this->invoice['date']?></span></div>
    </div>
  </div>
</div>

<div class="inv-positions">
  <table class="table-list">
    <tr>
      <th>Position</th>
      <th>Name</th>
      <th>Quantity</th>
      <th>Unit</th>
      <th>Unit price</th>
      <th>Net value</th>
      <th>Tax</th>
      <th>Gross value</th>

    </tr>
    <?php foreach($this->positions as $position): ?>
      <tr>
        <td><?=$position['position']?></td>
        <td><?=$position['name']?></td>
        <td><?=$position['quantity']?></td>
        <td><?=$position['unit']?></td>
        <td><?=$position['unitPrice']?></td>
        <td><?=$position['netValue']?></td>
        <td><?=$position['taxPercent']?></td>
        <td><?=$position['value']?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

<div class="inv-summary">
  <table>
    <tr><td>Total Net:</td><td><?=$this->invoice['totalNet']?></td></tr>
    <tr><td>Total Gross:</td><td><?=$this->invoice['totalGross']?></td></tr>
  </table>
</div>

<?php $this->end();?>
