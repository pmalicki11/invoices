<tr>
  <td><label for="name">Name:</label></td>
  <td><input type="text" id="name" name="name"
    value="<?=(isset($_POST['name'])) ? $_POST['name'] : ''?>"
    class="form-input-text<?=(array_key_exists('name', $this->errors) ? '-error' : '')?>"></td>
</tr>
<tr>
  <td><label for="address">Address:</label></td>
  <td><input type="text" id="address" name="address"
    value="<?=(isset($_POST['address'])) ? $_POST['address'] : ''?>"
    class="form-input-text<?=(array_key_exists('address', $this->errors) ? '-error' : '')?>"></td>
</tr>
<tr>
  <td><label for="zip">Zip Code:</label></td>
<td><input type="text" id="zip" name="zip"
    value="<?=(isset($_POST['zip'])) ? $_POST['zip'] : ''?>"
    class="form-input-text<?=(array_key_exists('zip', $this->errors) ? '-error' : '')?>"></td>
</tr>
<tr>
  <td><label for="state">State:</label></td>
  <td><input type="text" id="state" name="state"
    value="<?=(isset($_POST['state'])) ? $_POST['state'] : ''?>"
    class="form-input-text<?=(array_key_exists('state', $this->errors) ? '-error' : '')?>"></td>
</tr>
<tr>
  <td><label for="country">Country:</label></td>
    <td>
      <select form="form" name="country" id="country"
        class="form-input-text<?=(array_key_exists('country', $this->errors) ? '-error' : '')?>">
        <option hidden selected value="">-- select country --</option>
        <?php foreach($this->countries as $country): ?>
          <option value="<?=$country['id']?>"
            <?=(isset($_POST['country']) && $_POST['country'] == $country['id']) ? 'selected' : ''?>>
            <?=$country['name']?>
          </option>
        <?php endforeach; ?>
      </select>
    </td>
</tr>
<tr>
  <td><label for="contact">Contact:</label></td>
  <td><input type="text" id="contact" name="contact"
    value="<?=(isset($_POST['contact'])) ? $_POST['contact'] : ''?>"
    class="form-input-text<?=(array_key_exists('contact', $this->errors) ? '-error' : '')?>"></td>
</tr>
