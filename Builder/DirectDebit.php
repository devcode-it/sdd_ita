<?php

/**
 * DirectDebit
 *
 * @author  Carlo Chech 2015
 * @license MIT
 */

namespace Sdd\Builder;

use Sdd\DirectDebit\GroupHeader;
use Sdd\DirectDebit\PaymentInformation;

/**
 * Class DirectDebit
 * @package Sdd\Builder
 */
class DirectDebit extends Base
{

  /**
   * @param string $painFormat
   */
  public function __construct($painFormat = 'CBISDDReqLogMsg.00.01.01')
  {
    parent::__construct($painFormat);
    //$this->transfer = $this->createElement('XXX');
    //$this->root->appendChild($this->transfer);
    $this->transfer = $this->root;
  }

  /**
   *
   * @param GroupHeader $groupHeader
   */
  public function appendGroupHeader(GroupHeader $groupHeader)
  {
    $groupHeaderElement = $this->createElement('GrpHdr');

    $messageIdentification = $this->createElement('MsgId', $groupHeader->getMessageIdentification());
    $groupHeaderElement->appendChild($messageIdentification);

    $creationDateTime = $this->createElement('CreDtTm', $groupHeader->getCreationDateTime()->format('Y-m-d\TH:i:sP'));
    $groupHeaderElement->appendChild($creationDateTime);

    $numberOfTransactions = $this->createElement('NbOfTxs', $groupHeader->getNumberOfTransactions());
    $groupHeaderElement->appendChild($numberOfTransactions);

    $controlSum = $this->createElement('CtrlSum', $groupHeader->getControlSum());
    $groupHeaderElement->appendChild($controlSum);

    $initiatingParty = $this->createElement('InitgPty');
    $initiatingPartyName = $this->createElement('Nm', $groupHeader->getInitiatingPartyName());
    $initiatingParty->appendChild($initiatingPartyName);

    $initiatingPartyId = $this->createElement('Id');

    $initiatingPartyOrgId = $this->createElement('OrgId');
    $initiatingPartyId->appendChild($initiatingPartyOrgId);

    $initiatingPartyOthr = $this->createElement('Othr');
    $initiatingPartyOrgId->appendChild($initiatingPartyOthr);

    $initiatingPartyOthrId = $this->createElement('Id', $groupHeader->getOrgHeaderId());
    $initiatingPartyOthr->appendChild($initiatingPartyOthrId);
    $initiatingPartyOthrIssr = $this->createElement('Issr', $groupHeader->getOrgHeaderIssr());
    $initiatingPartyOthr->appendChild($initiatingPartyOthrIssr);

    $initiatingParty->appendChild($initiatingPartyId);
    $groupHeaderElement->appendChild($initiatingParty);
    $this->transfer->appendChild($groupHeaderElement);
  }

  /**
   * @param PaymentInformation $paymentInformation
   */
  public function appendPaymentInformation($paymentInformations)
  {

    foreach ($paymentInformations as $paymentInformation) {
      $this->payment = $this->createElement('PmtInf');

      $paymentInformationIdentification = $this->createElement('PmtInfId', $paymentInformation->getPaymentInformationIdentification());
      $this->payment->appendChild($paymentInformationIdentification);

      $paymentMethod = $this->createElement('PmtMtd', $paymentInformation->getPaymentMethod());
      $this->payment->appendChild($paymentMethod);

      $paymentMethod = $this->createElement('BtchBookg', $paymentInformation->hasBtchBookg());
      $this->payment->appendChild($paymentMethod);

      /* payment base data */
      $paymentInfo = $this->createElement('PmtTpInf');

      $serviceLevel = $this->createElement('SvcLvl');
      $serviceLevel->appendChild($this->createElement('Cd', $paymentInformation->getServiceLevel()));
      $paymentInfo->appendChild($serviceLevel);

      $localMethod = $this->createElement('LclInstrm');
      $localMethod->appendChild($this->createElement('Cd', $paymentInformation->getLocalMethod()));
      $paymentInfo->appendChild($localMethod);

      $sequenceType = $this->createElement('SeqTp', $paymentInformation->getSeqType());
      $paymentInfo->appendChild($sequenceType);

      $this->payment->appendChild($paymentInfo);

      //Data scadenza richiesta dal mittente
      $requestedExecutionDate = $this->createElement('ReqdColltnDt', $paymentInformation->getRequestedExecutionDate());
      $this->payment->appendChild($requestedExecutionDate);

      $creditor = $this->createElement('Cdtr');
      $creditor->appendChild($this->createElement('Nm', $paymentInformation->getCreditorName()));
      $creditor->appendChild($this->appendCreditorId($paymentInformation));
      $this->payment->appendChild($creditor);

      $creditorAgentAccount = $this->createElement('CdtrAcct');
      $creditorAgentAccount->appendChild($this->IBAN($paymentInformation->getCreditorIBAN()));
      $this->payment->appendChild($creditorAgentAccount);


      $creditorAgency = $this->createElement('CdtrAgt');
      $fininstid = $this->createElement('FinInstnId');
      $clrSysMmbId = $this->createElement('ClrSysMmbId');


      $creditorAgency->appendChild($fininstid)
        ->appendChild($clrSysMmbId)
        ->appendChild($this->createElement('MmbId', $paymentInformation->getCreditorAbi()));
      $this->payment->appendChild($creditorAgency);


      $creditorSchMe = $this->createElement('CdtrSchmeId');

      $creditorSchMeName = $this->createElement('Nm', $paymentInformation->getCreditorName());
      $creditorSchMe->appendChild($creditorSchMeName);
      $creditorSchMe->appendChild($this->appendCreditorId($paymentInformation));
      $this->payment->appendChild($creditorSchMe);


      $this->appendPayments($paymentInformation->getPayments());


      $this->transfer->appendChild($this->payment);
    }
  }


  /**
   * @param PaymentInformation $paymentInformation
   *
   * @return \DOMElement
   */
  protected function appendCreditorId(PaymentInformation $paymentInformation)
  {
    $block = $this->createElement('Id');
    $block->appendChild($this->createElement('PrvtId'))
      ->appendChild($this->createElement('Othr'))
      ->appendChild($this->createElement('Id', $paymentInformation->getCreditorId()));

    return $block;
  }

  /**
   * @param $payments
   */
  protected function appendPayments($payments)
  {
    foreach ($payments as $payment) {
      $creditTransferTransactionInformation = $this->createElement('DrctDbtTxInf');

      $paymentIdentification = $this->createElement('PmtId');
      $paymentIdentification->appendChild($this->createElement('InstrId', $payment->getInstrId()));
      $paymentIdentification->appendChild($this->createElement('EndToEndId', $payment->getEndToEndId()));
      $creditTransferTransactionInformation->appendChild($paymentIdentification);


      $instructedAmount = $this->createElement('InstdAmt', $payment->getAmount());
      $instructedAmount->setAttribute('Ccy', $payment->getCurrency());
      $creditTransferTransactionInformation->appendChild($instructedAmount);

      $chrgBr = $this->createElement('ChrgBr', $payment->getChrgBr());
      $creditTransferTransactionInformation->appendChild($chrgBr);


      $dbTx = $this->createElement('DrctDbtTx');

      $mntd = $this->createElement('MndtRltdInf');
      $mntd->appendChild($this->createElement('MndtId', $payment->getMndt()));
      $mntd->appendChild($this->createElement('DtOfSgntr', $payment->getMndtDate()));
      $dbTx->appendChild($mntd);

      $creditTransferTransactionInformation->appendChild($dbTx);


      if ($payment->getDebtorBIC()) {
        $creditorAgent = $this->createElement('DbtrAgt');
        $financialInstitution = $this->createElement('FinInstnId');
        $financialInstitution->appendChild($this->createElement('BIC', $payment->getDebtorBIC()));
        $creditorAgent->appendChild($financialInstitution);
        $creditTransferTransactionInformation->appendChild($creditorAgent);
      }

      $creditor = $this->createElement('Dbtr');
      $creditor->appendChild($this->createElement('Nm', $payment->getDebtorName()));
      $creditTransferTransactionInformation->appendChild($creditor);

      $creditorAccount = $this->createElement('DbtrAcct');
      $id = $this->createElement('Id');
      $id->appendChild($this->createElement('IBAN', $payment->getDebtorIBAN()));
      $creditorAccount->appendChild($id);
      $creditTransferTransactionInformation->appendChild($creditorAccount);

      $remittanceInformation = $this->remittence($payment->getRemittanceInformation());
      $creditTransferTransactionInformation->appendChild($remittanceInformation);
      $this->payment->appendChild($creditTransferTransactionInformation);
    }
  }

  /**
   * Return xml
   *
   * @return string
   */
  public function xml()
  {
    return (string)$this->dom->saveXML();
  }

}
