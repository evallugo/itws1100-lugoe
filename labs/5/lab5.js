/* Lab 5 JavaScript File 
  Place variables and functions in this file */

function validate(formObj) {
  // put your validation code here
  // it will be a series of if statements

  var errorMessages = []; //stores what needs to be fixed/changed

  if (formObj.firstName.value === "") {
    errorMessages.push("You must enter a first name.");
  }
  if (formObj.lastName.value === "") {
    errorMessages.push("You must enter a last name.");
  }
  if (formObj.title.value === "") {
    errorMessages.push("You must enter a title.");
  }
  if (formObj.org.value === "") {
    errorMessages.push("You must enter an organization.");
  }
  if (formObj.pseudonym.value === "") {
    errorMessages.push("You must enter a nickname.");
  }
  if (formObj.comments.value === "Please enter your comments") {
    errorMessages.push("You must enter a comment.");
  }
  if (errorMessages.length > 0) {
    alert("You must fix the following issues:\n" + errorMessages.join("\n"));
    return false; //prevents form submission
  } else {
    alert("Successfully Submitted!");
    return true; //validations passed
  }
}

function clearComments() {
  var commentsArea = document.getElementById('comments');
  if (commentsArea.value === "Please enter your comments") {
    commentsArea.value = "";
  }
}

function restoreComments() {
  var commentsArea = document.getElementById('comments');
  if (commentsArea.value === "") {
    commentsArea.value = "Please enter your comments";
  }
}

function showNameInfo() {
  var firstName = document.getElementById('firstName').value;
  var lastName = document.getElementById('lastName').value;
  var nickname = document.getElementById('pseudonym').value;
  alert(firstName + " " + lastName + " is " + nickname);
}
