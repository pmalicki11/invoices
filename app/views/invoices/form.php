<tr>
  <td><label for="number">Number:</label></td>
  <td><input type="text" id="number" name="number" readonly
    value="<?=$this->nextNumber?>"
    class="form-input-text<?=(array_key_exists('number', $this->errors) ? '-error' : '')?>"></td>
</tr>
<tr>
  <td><label for="customer">Customer:</label></td>
    <td>
      <select form="form" name="customer" id="customer"
        class="form-input-text<?=(array_key_exists('customer', $this->errors) ? '-error' : '')?>">
        <option hidden selected value="">-- select customer --</option>
        <?php foreach($this->customers as $customer): ?>
          <option value="<?=$customer['id']?>"
            <?=(isset($_POST['customer']) && $_POST['customer'] == $customer['id']) ? 'selected' : ''?>>
            <?=$customer['name']?>
          </option>
        <?php endforeach; ?>
      </select>
    </td>
</tr>
<tr>
  <td><label for="date">Date:</label></td>
  <td><input type="text" id="date" name="date" readonly
    value="<?=(isset($_POST['date'])) ? $_POST['date'] : date("Y-m-d")?>"
    class="form-input-text<?=(array_key_exists('date', $this->errors) ? '-error' : '')?>"></td>
</tr>
