var addInvoicePositionBtn;
var invPositionsContainer;
var invPositionFields;
var numOfPositions;

window.addEventListener('load', function () {
  addInvoicePositionBtn = document.getElementById("addInvoicePosition");
  invPositionsContainer = document.getElementById("invPositionsContainer");
  invPositionFields = {
    posName: 'Name',
    posQuantity: 'Quantity',
    posUnit: 'Unit',
    posUnitPrice: 'Unit price',
    posNetValue: 'Net value',
    posTaxPercent: 'Tax',
    posValue: 'Value'
  };
  numOfPositions = 0;

  addInvoicePositionBtn.addEventListener("click", addPosition);
});


function addPosition() {
  var fieldset = document.createElement("fieldset");
  var legend = document.createElement("legend");

  fieldset.setAttribute('class', 'invPositions');
  fieldset.setAttribute('id', ('invPos-' + numOfPositions));
  legend.innerHTML = 'Position ' + (numOfPositions + 1);
  fieldset.appendChild(legend);


  for(const [pName, pLabel] of Object.entries(invPositionFields)) {
    var div = document.createElement("div");
    var label = document.createElement("label");
    var input = document.createElement("input");
    div.setAttribute("class", "row");
    label.setAttribute("for", pName);
    label.innerHTML = pLabel + ':';
    input.setAttribute('type', 'text');
    input.setAttribute('id', pName + '-' + numOfPositions);
    input.setAttribute('name', pName + '[' + numOfPositions + ']');
    input.setAttribute('class', 'form-input-text');

    if(pName == 'posNetValue' || pName == 'posValue') {
      input.setAttribute('readonly', '');
    }

    if(pName == 'posQuantity' || pName == 'posUnitPrice' || pName == 'posTaxPercent') {
      input.addEventListener('focusout', updateValues);
    }

    div.appendChild(label);
    div.appendChild(input);
    fieldset.appendChild(div);
  }
  invPositionsContainer.appendChild(fieldset);
  numOfPositions++;
}

function updateValues() {
  var positionId = this.parentNode.parentNode.id.substr(7);

  var quantity = document.getElementById("posQuantity-" + positionId);
  var unitPrice = document.getElementById("posUnitPrice-" + positionId);
  var netValue = document.getElementById("posNetValue-" + positionId);
  var tax = document.getElementById("posTaxPercent-" + positionId);
  var grossValue = document.getElementById("posValue-" + positionId);

  quantity.value = quantity.value.replace(',', '.');
  unitPrice.value = unitPrice.value.replace(',', '.');
  netValue.value = netValue.value.replace(',', '.');
  tax.value = tax.value.replace(',', '.');
  grossValue.value = grossValue.value.replace(',', '.');

  netValue.value = Number(quantity.value) * Number(unitPrice.value);
  grossValue.value = Number(netValue.value) * Number(tax.value) / 100 + Number(netValue.value);
}
