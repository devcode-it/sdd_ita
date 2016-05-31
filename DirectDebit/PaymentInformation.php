<?php

/**
 * PaymentInformation
 *
 * @author  Carlo Chech 2016
 * @license MIT
 */

namespace Sdd\DirectDebit;

  /**
   * Class PaymentInformation
   * @package Sdd\DirectDebit
   */

/**
 * Class PaymentInformation
 * @package Sdd\DirectDebit
 */
class PaymentInformation
{

  /**
   * @var string
   */
  protected $paymentInformationIdentification;

  /**
   * The initiating Party for this payment
   *
   * @var string
   */
  protected $paymentMethod = 'DD';

  /**
   * @var \DateTime
   */
  protected $requestedExecutionDate;

  /**
   *
   * @var string
   */
  protected $creditorName;

  /**
   *
   * @var string
   */
  protected $creditorIBAN;


  protected $creditorABI;

  /**
   *
   * @var string
   */
  protected $creditorBIC = '';


  /**
   * @var bool
   * accredito cumulativo
   */
  protected $btchBookg = false;
  /**
   *
   * @var array
   */
  protected $payments = [];
  /**
   * @var
   */
  protected $creditorIban;


  /**
   * @var
   */
  protected $serviceLevel;
  /**
   * @var
   */
  protected $localMethod;


  protected $seqType;


  protected $creditorId;

  /**
   *
   * @return string
   */
  public function getCreditorName()
  {
    return $this->creditorName;
  }


  /**
   * @param string $creditorName
   *
   * @return PaymentInformation
   */
  public function setCreditorName($creditorName)
  {
    $this->creditorName = $creditorName;

    return $this;
  }


  /**
   *
   * @return string
   */
  public function getCreditorIBAN()
  {
    return $this->creditorIban;
  }


  /**
   *
   * @param string $IBAN
   *
   * @return \Sdd\DirectDebit\PaymentInformation
   */
  public function setCreditorIBAN($IBAN)
  {

    $this->creditorIban = $IBAN;
    $this->setCreditorABI();

    return $this;
  }


  /**
   *
   * @return string
   */
  public function getPaymentInformationIdentification()
  {
    return $this->paymentInformationIdentification;
  }


  /**
   * @param $paymentInformationIdentification
   *
   * @return $this
   */
  public function setPaymentInformationIdentification($paymentInformationIdentification)
  {
    $this->paymentInformationIdentification = $paymentInformationIdentification;

    return $this;
  }


  /**
   *
   * @return string
   */
  public function getPaymentMethod()
  {
    return $this->paymentMethod;
  }


  /**
   * @param string $paymentMethod
   *
   * @return PaymentInformation
   */
  public function setPaymentMethod($paymentMethod)
  {
    $this->paymentMethod = $paymentMethod;

    return $this;
  }


  /**
   *
   * @return array
   */
  public function getPayments()
  {
    return $this->payments;
  }

  /**
   *
   * @return \DateTime
   */
  public function getRequestedExecutionDate()
  {
    return $this->requestedExecutionDate;
  }


  /**
   * @param $requestDate
   *
   * @return $this
   */
  public function setRequestedExecutionDate($requestDate)
  {
    $this->requestedExecutionDate = $requestDate;

    return $this;
  }

  /**
   * @param boolean $btchBookg
   *
   * @return PaymentInformation
   */
  public function setBtchBookg($btchBookg)
  {
    $this->btchBookg = $btchBookg;

    return $this;
  }

  /**
   * @return boolean
   */
  public function getBtchBookg()
  {
    return json_encode($this->btchBookg);
  }


  /**
   *
   * @param array|Payment $payment
   */
  public function addPayments($payment)
  {
    if (is_array($payment)) {
      foreach ($payment as $transfer) {

        $this->payments[] = $transfer;
      }
    } else {

      $this->payments[] = $payment;
    }
  }


  /**
   * @return mixed
   */
  public function getServiceLevel()
  {
    return $this->serviceLevel;
  }

  /**
   * @param mixed $serviceLevel
   *
   * @return PaymentInformation
   */
  public function setServiceLevel($serviceLevel)
  {
    $this->serviceLevel = $serviceLevel;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getLocalMethod()
  {
    return $this->localMethod;
  }

  /**
   * @param mixed $localMethod
   *
   * @return $this
   */
  public function setLocalMethod($localMethod)
  {
    $this->localMethod = $localMethod;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getSeqType()
  {
    return $this->seqType;
  }

  /**
   * @param mixed $seqType
   *
   * @return $this
   */
  public function setSeqType($seqType)
  {
    $this->seqType = $seqType;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getCreditorABI()
  {
    return $this->creditorABI;
  }

  /**
   * @internal param mixed $creditorABI
   */
  public function setCreditorABI()
  {
    $this->creditorABI = substr($this->getCreditorIBAN(), 5, 5);

  }

  /**
   * @return mixed
   */
  public function getCreditorId()
  {
    return $this->creditorId;
  }

  /**
   * @param mixed $creditorId
   *
   * @return $this
   */
  public function setCreditorId($creditorId)
  {
    $this->creditorId = $creditorId;

    return $this;
  }


}
