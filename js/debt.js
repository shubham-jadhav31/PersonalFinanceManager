function validateForm(formName) {
    var returnval = true;

//Validation of INSERT FORM 
if (formName === "insertform") 
{
    var amount = document.forms[formName]["amount"].value;
    var crediter = document.forms[formName]["crediter"].value;
    var interest_rate = document.forms[formName]["interest_rate"].value;

    if (amount === "") {
        alert("Please enter invested amount.");
        return false;
    }

    if (!isInteger(amount)) {
        alert("Amount must be an integer !");
        return false;
    }

    if (crediter === "") {
        alert("Enter Creditor name !");
        return false;
    }

    if (!isInteger(interest_rate) && interest_rate < 1 && interest_rate > 100) {
        alert("Interest rate must be an integer between 1 and 100.");
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

    if (updatecol === "amount" || updatecol === "interest") {
        if (!isInteger(updateto)) {
            alert("Entered update quantity must be integer !");
            return false;
        }
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

    return true; // Form will be submitted if all validations pass
}

function isInteger(value) {
    // Function to check if a value is an integer
    return /^[0-9]+$/.test(value);
}
