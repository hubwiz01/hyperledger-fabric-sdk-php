<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: peer/configuration.proto

namespace Protos;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * AnchorPeer message structure which provides information about anchor peer, it includes host name,
 * port number and peer certificate.
 * </pre>
 *
 * Protobuf type <code>protos.AnchorPeer</code>
 */
class AnchorPeer extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * DNS host name of the anchor peer
     * </pre>
     *
     * <code>string host = 1;</code>
     */
    private $host = '';
    /**
     * <pre>
     * The port number
     * </pre>
     *
     * <code>int32 port = 2;</code>
     */
    private $port = 0;

    public function __construct() {
        \GPBMetadata\Peer\Configuration::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * DNS host name of the anchor peer
     * </pre>
     *
     * <code>string host = 1;</code>
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * <pre>
     * DNS host name of the anchor peer
     * </pre>
     *
     * <code>string host = 1;</code>
     */
    public function setHost($var)
    {
        GPBUtil::checkString($var, True);
        $this->host = $var;
    }

    /**
     * <pre>
     * The port number
     * </pre>
     *
     * <code>int32 port = 2;</code>
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * <pre>
     * The port number
     * </pre>
     *
     * <code>int32 port = 2;</code>
     */
    public function setPort($var)
    {
        GPBUtil::checkInt32($var);
        $this->port = $var;
    }

}
