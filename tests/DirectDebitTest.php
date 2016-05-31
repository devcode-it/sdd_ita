<?php

date_default_timezone_set('Europe/Rome');

/**
 * Class DirectDebit
 */
class DirectDebit extends \PHPUnit_Framework_TestCase
{

  /**
   *
   */
  public function testCreateTransfer()
  {
    $directDebit = new \Sdd\DirectDebit();
    //group header

    $paymentInformation = new \Sdd\DirectDebit\PaymentInformation();

    $directDebit->setPaymentInformation($paymentInformation);
    $xml = $directDebit->xml();
    $this->assertTrue($directDebit->validate($xml));
  }

}
