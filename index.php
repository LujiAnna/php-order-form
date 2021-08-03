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

whatIsHappening();

// provide some products using an Associative Array
$products = [
    ['name' => 'Camera: Sony HDRCX405 Camcorder ', 'price' => 229.99],
    ['name' => 'Microphone: Audio-Technica AT2020USB Plus ', 'price' => 29.99],
    ['name' => 'Tripod: iKan E-Image EG01A2 ', 'price' => 99.99],
    ['name' => 'Lighting: Flashpoint 19 Kit ', 'price' => 49.99],
    ['name' => 'Video editing software: Adobe Premiere Elements 2021', 'price' => 39.99],
];

// ADD another product array, eg cameras only, or microphones only

print_r($products);

$totalValue = 0;



// Completed: step1:Show an order confirmation when the user submits the form.
// TODO:  This should contain the chosen products

// show all orders in a form
// iterate through the order
// save the checked products in cookies and grab them from there
// retrieve html form data

function orderedProducts()
{
}

function showOrder()
{
    global $products;
    // show keys and values for normal array
    // foreach ($products as $key => $value) {
    //     return '$key $value';
    // }

    // only show values/properties in 1D array
    // foreach ($products as $value) {
    //     return $value;
    // }

    // loop multi-dimensional array
    // dont return first until have looped throughout
    $order = '';
    // check if order was posted
    if (!empty($_POST['products'])) {
        foreach ($products as $product) {
            // TODO: check if checkbox is checked
            // let op! checkboxes which are not checked are NOT submitted with the form. therefore if you get $_POST['name_of_checkbox'] then it WAS checked.
            if (isset($_POST['products']) == 1) {
                $order .= $product['name'] . "</br><hr>";
            }
        }
    }

    return $order;
}

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
    $email = $_POST['email'];
    $street = $_POST['street'];
    $streetnumber = $_POST['streetnumber'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];

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
    // TODO: Add sessions
    // TODO: include empty strings to all values when empty
    return $emptyField;
}

function handleForm($products)
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
        return [
            'errors' => true,
            'message' => $message
        ];
    } else {
        // try oksana code here as well
        $productNumbers = array_keys($_POST['products']);
        $productNames = [];

        foreach ($productNumbers as $productNumber) {
            $productNames[] = $products[$productNumber]['name'];
        }

        $message = 'Your order is : ' . implode(', ', $productNames);
        $message .= '<br>';
        $message .= '<br>';
        $message .= 'Your address : ' . $_POST['street'] . ' ' . $_POST['streetnumber'] . ', ' . $_POST['zipcode'] . ' ' . $_POST['city'];


        return [
            'errors' => false,
            'message' => $message
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
    $result = handleForm($products);
    // this will either return address & products or a list of arrays
}

require 'form-view.php';
