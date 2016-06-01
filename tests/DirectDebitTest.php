<?php

use Sdd\DirectDebit\Payment;
use Sdd\DirectDebit\PaymentInformation;

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
    $groupHeader = new GroupHeader();

    $groupHeader->setControlSum(400)
      ->setInitiatingPartyName('AZIENDA S.P.A.')
      ->setOrgHeaderId('ABC')// Codice Unico CBI
      ->setOrgHeaderIssr('CBI')
      ->setMessageIdentification(1)
      ->setNumberOfTransactions(2)
      ->setControlSum('');
    $directDebit->setGroupHeader($groupHeader);


    $paymentInformation = new PaymentInformation;
    $paymentInformation
      ->setCreditorName('AZIENDA S.P.A.')
      ->setCreditorIBAN('IT02S0991503009900000009999')
      ->setCreditorId('IT799999999999999999999')
      // Per l'Italia è composta da "IT" + 2 cifre  controllo + tre caratteri
      // che   identificano   il   comparto   aziendale   +   il   codice   fiscale
      // dell’azienda su 16 caratteri (es. IT320010000003053920165)

      ->setPaymentInformationIdentification(1)
      ->setRequestedExecutionDate('2016-05-01')
      ->setLocalMethod("B2B")
      ->setServiceLevel('SEPA')
      ->setSeqType("RCURR");


    $payment = new Payment;
    $payment
      ->setAmount(300)
      ->setInstrId(1)
      ->setEndToEndId(123 - 1)
      ->setDebtorIBAN('IT0660991503009900000009999')
      ->setDebtorName(htmlentities("DEB & SRL"))
      ->setMndt('MDN0001')
      ->setMndtDate('2016-01-01')
      ->setRemittanceInformation("FATTURA N. 12 del 01.02.2016");


    $paymentInformation->addPayments([$payment]);


    $payment = new Payment;
    $payment
      ->setAmount(100)
      ->setInstrId(2)
      ->setEndToEndId(123 - 2)
      ->setDebtorIBAN('IT0660991503009900000009999')
      ->setDebtorName(htmlentities("DEB & SRL"))
      ->setMndt('MDN0001')
      ->setMndtDate('2016-01-01')
      ->setRemittanceInformation("FATTURA N. 13 del 01.02.2016");


    $paymentInformation->addPayments([$payment]);

    $directDebit->addPaymentInformation($paymentInformation);


    $xml = $directDebit->xml();
    $this->assertTrue($directDebit->validate($xml));
  }

}
