<?php

declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

function whatIsHappening()
{
    echo '<pre>';
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
    echo '</pre>';
}

$products = [
    ['name' => 'Empty coke can', 'price' => 5],
    ['name' => 'Painting of my toenail', 'price' => 1000],
    ['name' => 'A 5 dollar note', 'price' => 10],
    ['name' => 'A picture of my ex', 'price' => 0]
];

$totalValue = 0;

function checkValidate()
{
    // This function will send a list of invalid fields back
    $errors = [];

    if (empty($_POST['email'])) {
        $errors[] = 'email';
    }
    if (empty($_POST['street'])) {
        $errors[] = 'street';
    }
    if (empty($_POST['streetnumber'])) {
        $errors[] = 'streetnumber';
    }
    if (empty($_POST['city'])) {
        $errors[] = 'city';
    }
    if (empty($_POST['zipcode']) or !is_numeric($_POST['zipcode'])) {
        $errors[] = 'zipcode';
    }
    return $errors;
}


function formHandling($products, &$totalValue)
//     & changes the original value
{
    // Validation (step 2)
    $invalidFields = checkValidate();
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
        $productNumbers = array_keys($_POST['products']);
        $productNames = [];

        foreach ($productNumbers as $productNumber) {
            $productNames[] = $products[$productNumber]['name'];
            $totalValue = $totalValue + $products[$productNumber]['price'];
        }

        $message = 'Products : ' . implode(', ', $productNames);
        $message .= '<br>';
        $message .= 'Your email address : ' . $_POST['email'];
        $_SESSION['email'] = $_POST['email'];
        $message .= '<br>';
        $message .= 'Your address : ' . $_POST['street'] . ' ' . $_POST['streetnumber'] . ', ' . $_POST['zipcode'] . ' ' . $_POST['city'];
        $_SESSION['street'] = $_POST['street'];
        $_SESSION['streetnumber'] = $_POST['streetnumber'];
        $_SESSION['zipcode'] = $_POST['zipcode'];
        $_SESSION['city'] = $_POST['city'];

        return [
            'errors' => false,
            'message' => $message,
            'totalValue' => $totalValue
        ];
    }
}

$formSubmitted = !empty($_POST);
$result = [];

if ($formSubmitted) {
    $result = formHandling($products, $totalValue);
}

require 'form-view.php';
