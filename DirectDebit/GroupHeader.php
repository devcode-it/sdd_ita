<?php

/**
 *
 * GroupHeader
 *
 * @author  Carlo Chech 2016
 * @license MIT
 */

namespace Sdd\DirectDebit;

  /**
   * Class GroupHeader
   * @package Sdd\DirectDebit
   */
  /**
   * Class GroupHeader
   * @package Sdd\DirectDebit
   */
  /**
   * Class GroupHeader
   * @package Sdd\DirectDebit
   */
/**
 * Class GroupHeader
 * @package Sdd\DirectDebit
 */
/**
 * Class GroupHeader
 * @package Sdd\DirectDebit
 */
class GroupHeader
{

  /**
   * @var string
   */
  protected $messageIdentification;

  /**
   * The initiating Party for this payment
   *
   * @var string
   */
  protected $initiatingPartyId;

  /**
   * @var integer
   */
  protected $numberOfTransactions = 0;

  /**
   * @var integer
   */
  protected $controlSum = 0;

  /**
   * @var string
   */
  protected $initiatingPartyName;

  /**
   * @var \DateTime
   */
  protected $creationDateTime;



  /**
   * @var
   */
  protected $orgHeaderId;


  /**
   * @var
   */
  protected $orgHeaderIssr;


  /**
   * @param bool $messageIdentification
   * @param bool $initiatingPartyName
   * @param null $creationdateTime
   */
  function __construct($messageIdentification = false, $initiatingPartyName = false)
  {
    $this->messageIdentification = $messageIdentification;
    $this->initiatingPartyName = $initiatingPartyName;

  }

  /**
   * @return integer
   */
  public function getControlSum()
  {
    return $this->controlSum;
  }

  /**
   * @return \DateTime
   */
  public function getCreationDateTime()
  {
    return $this->creationDateTime;
  }



  /**
   * @param \DateTime $creationDateTime
   */
  public function setCreationDateTime($creationDateTime)
  {
    $this->creationDateTime = $creationDateTime;
  }

  /**
   * @return string
   */
  public function getInitiatingPartyId()
  {
    return $this->initiatingPartyId;
  }

  /**
   * @return string
   */
  public function getInitiatingPartyName()
  {
    return $this->initiatingPartyName;
  }

  /**
   * @return integer
   */
  public function getNumberOfTransactions()
  {
    return $this->numberOfTransactions;
  }

  /**
   * @return string
   */
  public function getMessageIdentification()
  {
    return $this->messageIdentification;
  }

  /**
   *
   * @param integer $controlSum
   *
   * @return \Sdd\DirectDebit\GroupHeader
   */
  public function setControlSum($controlSum)
  {
    $this->controlSum = $controlSum;

    return $this;
  }

  /**
   *
   * @param string $initiatingPartyId
   *
   * @return \Sdd\DirectDebit\GroupHeader
   */
  public function setInitiatingPartyId($initiatingPartyId)
  {
    $this->initiatingPartyId = $initiatingPartyId;

    return $this;
  }

  /**
   *
   * @param string $initiatingPartyName
   *
   * @return \Sdd\DirectDebit\GroupHeader
   */
  public function setInitiatingPartyName($initiatingPartyName)
  {
    $this->initiatingPartyName = $initiatingPartyName;

    return $this;
  }

  /**
   *
   * @param string $messageIdentification
   *
   * @return \Sdd\DirectDebit\GroupHeader
   */
  public function setMessageIdentification($messageIdentification)
  {
    $this->messageIdentification = $messageIdentification;

    return $this;
  }

  /**
   *
   * @param integer $numberOfTransactions
   *
   * @return \Sdd\DirectDebit\GroupHeader
   */
  public function setNumberOfTransactions($numberOfTransactions)
  {
    $this->numberOfTransactions = $numberOfTransactions;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getOrgHeaderId()
  {
    return $this->orgHeaderId;
  }

  /**
   * @param $orgHeaderId
   *
   * @return $this
   *
   */
  public function setOrgHeaderId($orgHeaderId)
  {
    $this->orgHeaderId = $orgHeaderId;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getOrgHeaderIssr()
  {
    return $this->orgHeaderIssr;
  }

  /**
   * @param mixed $orgHeaderIssr
   *
   * @return $this
   */
  public function setOrgHeaderIssr($orgHeaderIssr)
  {
    $this->orgHeaderIssr = $orgHeaderIssr;

    return $this;
  }


}
