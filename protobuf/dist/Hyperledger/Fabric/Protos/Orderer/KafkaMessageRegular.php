<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: orderer/kafka.proto

namespace Hyperledger\Fabric\Protos\Orderer;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * KafkaMessageRegular wraps a marshalled envelope.
 *
 * Generated from protobuf message <code>orderer.KafkaMessageRegular</code>
 */
class KafkaMessageRegular extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bytes payload = 1;</code>
     */
    private $payload = '';

    public function __construct() {
        \GPBMetadata\Orderer\Kafka::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>bytes payload = 1;</code>
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Generated from protobuf field <code>bytes payload = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setPayload($var)
    {
        GPBUtil::checkString($var, False);
        $this->payload = $var;

        return $this;
    }

}

