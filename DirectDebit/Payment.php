<?php

/**
 * Payment
 *
 * @author  Carlo Chech 2016
 * @license MIT
 */

namespace Sdd\DirectDebit;

/**
 * Class Payment
 * @package Sdd\DirectDebit
 */
class Payment
{

  /**
   *
   * @var string
   */
  protected $amount;

  /**
   *
   * @var string
   */
  protected $debtorName;

  /**
   *
   * @var string
   */
  protected $debtorIBAN;

  /**
   *
   * @var string
   */
  protected $debtorBIC = '';

  /**
   *
   * @var string
   */
  protected $currency = 'EUR';


  /**
   * @var
   */
  protected $instrId;


  /**
   *
   * @var string
   */
  protected $endToEndId;

  /**
   *
   * @var string
   */
  protected $remittanceInformation;


  /**
   * @var
   * Intestatario imputazione
   */
  protected $chrgBr = 'SLEV';


  /**
   * @var
   */
  protected $mndt;

  /**
   * @var
   */
  protected $mndtDate;


  /**
   *
   * @return string
   */
  public function getAmount()
  {
    return $this->amount;
  }

  /**
   *
   * @return string
   */
  public function getDebtorName()
  {
    return $this->debtorName;
  }

  /**
   *
   * @return string
   */
  public function getDebtorIBAN()
  {
    return $this->debtorIBAN;
  }

  /**
   *
   * @return string
   */
  public function getDebtorBIC()
  {
    return $this->debtorBIC;
  }

  /**
   * @return string
   */
  public function getCurrency()
  {
    return $this->currency;
  }

  /**
   *
   * @return string
   */
  public function getEndToEndId()
  {
    return $this->endToEndId;
  }

  /**
   *
   * @return string
   */
  public function getRemittanceInformation()
  {
    return $this->remittanceInformation;
  }

  /**
   *
   * @param string $amount
   *
   * @return \Sdd\DirectDebit\Payment
   */
  public function setAmount($amount)
  {
    $this->amount = $amount;

    return $this;
  }

  /**
   *
   * @param string $name
   *
   * @return \Sdd\DirectDebit\Payment
   */
  public function setDebtorName($name)
  {
    $this->debtorName = $name;

    return $this;
  }

  /**
   *
   * @param string $IBAN
   *
   * @return \Sdd\DirectDebit\Payment
   */
  public function setDebtorIBAN($IBAN)
  {
    $this->debtorIBAN = $IBAN;

    return $this;
  }

  /**
   *
   * @param string $BIC
   *
   * @return \Sdd\DirectDebit\Payment
   */
  public function setDebtorBIC($BIC)
  {
    $this->debtorBIC = $BIC;

    return $this;
  }

  /**
   * @param $currency
   *
   * @return $this
   */
  public function setCurrency($currency)
  {
    $this->currency = $currency;

    return $this;
  }

  /**
   *
   * @param string $endToEndId
   *
   * @return \Sdd\DirectDebit\Payment
   */
  public function setEndToEndId($endToEndId)
  {
    $this->endToEndId = $endToEndId;

    return $this;
  }

  /**
   *
   * @param string $remittanceInformation
   *
   * @return \Sdd\DirectDebit\Payment
   */
  public function setRemittanceInformation($remittanceInformation)
  {
    $this->remittanceInformation = $remittanceInformation;

    return $this;
  }


  /**
   * @return mixed
   */
  public function getInstrId()
  {
    return $this->instrId;
  }

  /**
   * @param mixed $instrId
   *
   * @return $this
   */
  public function setInstrId($instrId)
  {
    $this->instrId = $instrId;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getChrgBr()
  {
    return $this->chrgBr;
  }

  /**
   * @param mixed $chrgBr
   *
   * @return $this
   */
  public function setChrgBr($chrgBr)
  {
    $this->chrgBr = $chrgBr;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getMndtDate()
  {
    return $this->mndtDate;
  }

  /**
   * @param mixed $mndtDate
   *
   * @return $this
   */
  public function setMndtDate($mndtDate)
  {
    $this->mndtDate = $mndtDate;

    return $this;
  }


  /**
   * @return mixed
   */
  public function getMndt()
  {
    return $this->mndt;
  }

  /**
   * @param mixed $mndt
   *
   * @return Payment
   */
  public function setMndt($mndt)
  {
    $this->mndt = $mndt;

    return $this;
  }
}
