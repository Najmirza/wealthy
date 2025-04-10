<?php
function inputForm($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// Function to validate  All filds form fields
function validate_form_fields() {
  global $name, $emailId, $phone;
  $errors = array();
  // Validate name field
  if (empty($_POST['name'])) {
    $errors[] = 'Name field is required.';
  } else {
    $name = inputForm($_POST['name']);
    // Check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $errors[] = 'Name field can only contain letters and whitespace.';
     return false;

    }
  }

  // Validate email field
  if (empty($_POST['emailId'])) {
    $errors[] = 'Email field is required.';
  } else {
    $emailId = inputForm($_POST['emailId']);
    // Check if email address is well-formed
    if (!filter_var($emailId, FILTER_VALIDATE_EMAIL)) {
      $errors[] = ' Invalid email format in email field.';
      return false;
    }
  }
    
  // Validate phone field
  if (empty($_POST['phone'])) {
    $errors[] = 'Phone field is required.';
  } else {
    $phone = inputForm($_POST['phone']);
    // Check if phone number is valid
    if (!preg_match("/^[0-9]{10}$/",$phone)) {

      $errors[] = "Invalid phone number in phone field.";
      return false;

    }
  }

}
?>

<?php 
// Function to validate Name filds form fields
function validate_name_fields() {
    global $name;
    $errors = array();
  
    // Validate name field
    if (empty($_POST['name'])) {
      $errors[] = 'Name field is required.';
    } else {
      $name = inputName($_POST['name']);
      // Check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $errors[] = 'Only letters and white space allowed in name field.';
      }
    }

}

// Function to sanitize form input data
function inputName($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>






<?php 
// Function to validate  Amount filds form fields
function validate_amount_fields() {
    global  $amount;
    $errors = array();
  

  if (empty($_POST['amount'])) {
    $errors[] = 'Amount field is required.';
  } else {
    $amount =inputAmount($_POST['amount']);
    // Check if amount is numeric and greater than 0
    if (!is_numeric($amount) || $amount <= 0) {
      $errors[] = 'Invalid amount in amount field.';
    }
  }
}

// Function to sanitize form input data
function inputAmount($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>









<?php 
// Function to validate Name filds form fields
function validate_number_fields() {
    global $name;
    $errors = array();
  
  // Validate phone field
  if (empty($_POST['phone'])) {
    $errors[] = 'Phone field is required.';
  } else {
    $phone = inputNumber($_POST['phone']);
    // Check if phone number is valid
    if (!preg_match("/^[0-9]{10}$/",$phone)) {
      $errors[] = 'Invalid phone number in phone field.';
    }
  }

}
// Function to sanitize form input data
function inputNumber($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>