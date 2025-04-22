<?php

namespace Sdd;


use Sdd\Builder\DirectDebit as Builder;
use Sdd\DirectDebit\GroupHeader;
use Sdd\DirectDebit\PaymentInformation;

/**
 * DirectDebit
 *
 * @author  Carlo Chech 2016
 * @license MIT
 */
class DirectDebit
{

  /**
   * @var null
   */
  protected $groupHeader = null;

  /**
   * @var null
   */
  protected $paymentInformation = null;


  /**
   * @param GroupHeader $groupHeader
   *
   * @return $this
   */
  public function setGroupHeader(GroupHeader $groupHeader)
  {
    $this->groupHeader = $groupHeader;

    return $this;
  }



  /**
   *
   * @param  $paymentInformation
   *
   * @return DirectDebit
   */
  public function addPaymentInformation(PaymentInformation $paymentInformation)
  {
    $this->paymentInformation[] = $paymentInformation;

    return $this;
  }

  /**
   *
   * @param string $xml
   * @param string $painformat
   *
   * @return boolean
   */
  public function validate($xml, $painformat = 'CBISDDReqLogMsg.00.01.01')
  {
    $reader = new \DOMDocument;
    $reader->loadXML($xml);
    if ($reader->schemaValidate(__DIR__ . '/xsd/' . $painformat . '.xsd')) {
      return true;
    }

    return false;
  }

  /**
   *
   * @throws \Exception
   */
  public function xml()
  {

    if ($this->groupHeader === null) {
      throw new \Exception('No GrpHdr');
    }

    if ($this->paymentInformation === null) {
      //     throw new \Exception('No pymnt');
    }

    $build = new Builder;
    $build->appendGroupHeader($this->groupHeader);

    $build->appendPaymentInformation($this->paymentInformation);

    return $build->xml();
  }

}
