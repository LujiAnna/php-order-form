<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// debugging code
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// We are going to use session variables so we need to enable sessions
session_start();


// Routing with _GET variable
$order = $_GET['order'] ?? 'gear';

// Use this function when you need to need an overview of these variables
function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// whatIsHappening();

// provide some products using an Associative Array
$gear = [
    ['name' => 'Camera: Sony HDRCX405 Camcorder ', 'price' => 229.99],
    ['name' => 'Microphone: Audio-Technica AT2020USB Plus ', 'price' => 29.99],
    ['name' => 'Tripod: iKan E-Image EG01A2 ', 'price' => 99.99],
    ['name' => 'Lighting: Flashpoint 19 Kit ', 'price' => 49.99],
    ['name' => 'Video editing software: Adobe Premiere Elements 2021', 'price' => 39.99],
];

$play = [
    ['name' => 'Football: Blue', 'price' => 29.99],
    ['name' => 'Basketball: Orange ', 'price' => 39.99],
    ['name' => 'Volleyball: White ', 'price' => 59.99],
    ['name' => 'Baseball: Grey ', 'price' => 49.99],
];



// ADD another product array, eg cameras only, or microphones only

// print_r($products);

$totalValue = 0;



// show all orders in a form
// iterate through the order
// save the checked products in cookies and grab them from there
// We want to prefill the address (after the first usage), as long as the browser isn't closed. 
// retrieve html form data

// 2, 4, 5 orders display
//  ["products"]=> array(3) { [1]=> string(1) "1" [3]=> string(1) "1" [4]=> string(1) "1" } ["order"]=> string(0) "" }

// Delivery address
function deliveryAddress()
{
    if (isset($_POST['street'])) {
        return $_POST['street'] . " " . $_POST['streetnumber'] . " , " . $_POST['city'] . " " . $_POST['zipcode'];
    }
}

// This function will return a list/array of invalid fields back in form 
function validate()
{
    

    /**
     * 1. Does it exist? or has it been submitted?
     * 2. Is it empty? or does 'value === NULL'?
     * 3. Display back to user => (Handle form)
     */

    $emptyField = [];

    // $address_data += [$key => $value];
    // check for required empty fields 
    // remove string, and push variable: $email, value => 'email'
    // This function will send a list of invalid fields back

    if (empty($_POST['email'])) {
        $emptyField[] = 'email';
    }
    if (empty($_POST['street'])) {
        $emptyField[] = 'street';
    }
    if (empty($_POST['streetnumber'])) {
        $emptyField[] = 'streetnumber';
    }
    if (empty($_POST['city'])) {
        $emptyField[] = 'city';
    }
    if (empty($_POST['zipcode'])) {
        $emptyField[] = 'zipcode';
    }
    if (empty($_POST['products'])) {
        $emptyField[] = 'products';
    }
    
    // Add sessions
   $_SESSION['email'] = $_POST['email'];
   $_SESSION['street']  = $_POST['street'];
   $_SESSION['streetnumber']  = $_POST['streetnumber'];
   $_SESSION['city']  = $_POST['city'];
   $_SESSION['zipcode']  = $_POST['zipcode'];
   $_SESSION['products']  = $_POST['products'];

    // TODO: include empty strings to all values when empty
    return $emptyField;
}

function handleForm($products, &$totalValue)
//     & changes the original value
{
    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        $message = '';
        foreach ($invalidFields as $invalidField) {
            $message .= "Please provide your {$invalidField}.";
            $message .= '<br>';
        }
        // TODO: show the previous values in the form so that the user doesn't have to retype everything
        
        return [
            'errors' => true,
            'message' => $message
        ];
    } else {
        // Order Confirmation
        $productNumbers = array_keys($_POST['products']);
        $productNames = [];

        foreach ($productNumbers as $productNumber) {
            $productNames[] = $products[$productNumber]['name'];
            $totalValue += $products[$productNumber]['price'];
        }

        $message = 'Your order is : ' . implode(', ', $productNames);
        $message .= '<br>';
        $message .= '<br>';
        $message .= 'Your address : ' . $_POST['street'] . ' ' . $_POST['streetnumber'] . ', ' . $_POST['zipcode'] . ' ' . $_POST['city'];

        return [
            'errors' => false,
            'message' => $message,
            'totalValue' => $totalValue
        ];
    }
}

// Check order sent
// handle successful submission
// return "order will be set if the form has been submitted (to TRUE)";

// $formSubmitted = false;
// isset() method in PHP to test the form is submitted successfully or not
$formSubmitted = isset($_POST['order']);
$result = [];

if ($formSubmitted) {
    $result = handleForm(${$order}, $totalValue);
    // this will either return address & products or a list of arrays
}

require 'form-view.php';
