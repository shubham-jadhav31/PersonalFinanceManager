function validateForm(formName) {
    var returnval = true;

//Validation of INSERT FORM 
if (formName === "insertform") 
{
    var amount = document.forms[formName]["amount"].value;
    var type = document.forms[formName]["type"].value;

    if (amount === "") {
        alert("Please enter invested amount !");
        return false;
    }

    if (!isInteger(amount)) {
      alert("Amount must be an integer !");
      return false;
    }

    if (parseFloat(amount) < 0) {
        alert("Amount cannot be a negative integer!");
        return false;
    }

    if (type === "") {
      alert("Please select a field where you invested !");
      return false;
    }

}

//Validation of UPDATE FORM 
if (formName === "updateform")
{
    var updatecol = document.forms["updateform"]["updatecol"].value;
    var updateto = document.forms["updateform"]["updateto"].value;
    var wherecol = document.forms["updateform"]["wherecol"].value;
    var whereis = document.forms["updateform"]["whereis"].value;

    if (updatecol === "") {
        alert("Select what you want to update !");
        return false;
    }

    if (updateto === "") {
        alert("Please enter the new value for the selected update field !");
        return false;
    }

    if (!isInteger(updateto)) {
        alert("Entered update quantity must be integer !");
        return false;
      }
      
    if (wherecol === "") {
        alert("Select where you want to update !");
        return false;
    }

    if (whereis === "") {
        alert("Please enter the value where you want to update !");
        return false;
    }

    if (!isInteger(whereis)) {
        alert("Entered value where you want to update must be integer !");
        return false;
      }

}

//Validation of DELETE FORM
if(formName === "deleteform")
{
    var deletecol = document.forms["deleteform"]["deletecol"].value;
    var deleteis = document.forms["deleteform"]["deleteis"].value;

    if (deletecol === "") {
        alert("Please enter the field to identify investment.");
        return false;
    }
}
    return true; // Form will be submitted if all validations pass
}

function isInteger(value) {
    // Use a regular expression to check if the value is an integer
    return d
}
