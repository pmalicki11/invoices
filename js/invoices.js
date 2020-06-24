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
    posUnitPrice: 'Unit price',
    posValue: 'Value'
  };
  numOfPositions = 0;

  addInvoicePositionBtn.addEventListener("click", addPosition);
});


function addPosition() {
  var fieldset = document.createElement("fieldset");
  var legend = document.createElement("legend");

  fieldset.setAttribute('class', 'invPositions');
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
    input.setAttribute('id', pName);
    input.setAttribute('name', pName + '[' + numOfPositions + ']');
    input.setAttribute('class', 'form-input-text');

    div.appendChild(label);
    div.appendChild(input);
    fieldset.appendChild(div);
  }
  invPositionsContainer.appendChild(fieldset);
  numOfPositions++;
}
