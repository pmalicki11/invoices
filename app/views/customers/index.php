<?php $this->setSiteTitle('Customers');?>
<?php $this->start('body');?>
<a href="<?=PROOT?>customers/add">Add new Customer</a>
<div class="list-container">
  <table class="table-list">
    <tr>
      <th>Name</th>
      <th>Address</th>
      <th>Tax Code</th>
      <th>Zip Code</th>
      <th>State</th>
      <th>Country</th>
      <th>Contact</th>
      <th></th>
    </tr>
    <?php foreach($this->customers as $customer): ?>
      <tr>
        <td><?=$customer['name']?></td>
        <td><?=$customer['address']?></td>
        <td><?=$customer['taxCode']?></td>
        <td><?=$customer['zip']?></td>
        <td><?=$customer['state']?></td>
        <td><?=$customer['countryName']?></td>
        <td><?=$customer['contact']?></td>
        <td>
          <a href="<?=PROOT?>customers/edit/<?=$customer['id']?>">Edit</a>
        </td>
        <td>
          <a href="<?=PROOT?>customers/delete/<?=$customer['id']?>" onclick="if(!confirm('Are you sure?')){return false;}">Remove</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
<?php $this->end();?>
