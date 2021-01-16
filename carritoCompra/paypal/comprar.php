<?php
//Concepto de compra
$concepto = "Compra de productos Proyecto";

//URL's de retorno
$regreso   = "http://localhost/masterphp/proyecto/carritoCompra/pagos/exitoso.php";
$cancelado = "http://localhost/masterphp/proyecto/carritoCompra/pagos/cancelado.php";

//El total
$precio = $_GET['total'];

//NO MODIFICAR
require 'bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$payer = new Payer();
$payer->setPaymentMethod("paypal");

$item1 = new Item();
$item1->setName($concepto)
    ->setCurrency('EUR')
    ->setQuantity(1)
    ->setSku("5") // Similar to `item_number` in Classic API
    ->setPrice($precio);

$itemList = new ItemList();
$itemList->setItems(array($item1));

$details = new Details();
$details->setShipping(0)
    ->setTax(0)
    ->setSubtotal($precio);

$amount = new Amount();
$amount->setCurrency("EUR")
    ->setTotal($precio)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($regreso)
    ->setCancelUrl($cancelado);

$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

$request = clone $payment;

try {
    $payment->create($apiContext);
} catch (Exception $ex) {
    ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
    exit(1);
}

$approvalUrl = $payment->getApprovalLink();

header("Location: " . $approvalUrl);

//ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

return $payment;