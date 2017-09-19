<?php

namespace org\amex\fabric_client;

use org\amex\fabric_client;

use Protos;
use Common;
use \Google\Protobuf\Internal;

class Channel
{

    function __construct()
    {
    }

    /**
     * Query using ChainCode
     * @param string $string
     * @return string
     */
    function queryByChainCode(Protos\EndorserClient $connect, $channelId,$chainCodeName,$chainCodePath,$chainCodeVersion)
    {

        $utils = new \org\amex\fabric_client\Utils();
        $nounce = $utils::getNonce();

        $fabricProposal = $this->createFabricProposal( $utils,$channelId,$chainCodeName,$chainCodePath,$chainCodeVersion);

//        echo \Config::loadDefaults("timeout");
        self::sendTransactionProposal($fabricProposal, 5000, $connect);

        // TODO
        // Set User Context
    }

    public function createFabricProposal( Utils $utils,$channelId,$chainCodeName,$chainCodePath,$chainCodeVersion)
    {

        $clientUtils = new ClientUtils();

        $nounce = $utils::getNonce();

        $TransactionID = new TransactionID();

        $ccType = new Protos\ChaincodeSpec();

        $ccType->setType(1); //1 for GOLANG

        $chaincodeHeaderExtension = new Protos\ChaincodeHeaderExtension();
        $chaincodeHeaderExtension->setChaincodeId($chaincodeID);

        $ENDORSER_TRANSACTION = 3;
        $txID = $TransactionID->getTxId($nounce);
        $TimeStamp = $clientUtils->buildCurrentTimestamp();

        $chainHeader = $clientUtils->createChannelHeader($ENDORSER_TRANSACTION, $txID, $channelId, 0, $TimeStamp, $chainCodeName,$chainCodePath,$chainCodeVersion);
        $chainHeaderString = $chainHeader->serializeToString();

        $chaincodeInvocationSpec = $utils->createChaincodeInvocationSpec($chaincodeID, $ccType);
        $chaincodeInvocationSpecString = $chaincodeInvocationSpec->serializeToString();

        $payload = new Protos\ChaincodeProposalPayload();
        $payload->setInput($chaincodeInvocationSpecString);
        $payloadString = $payload->serializeToString();


        $member = \Config::getConfig("members");
        $identity = (new Identity())->createSerializedIdentity($member[0]->admin_certs, $member[0]->sample_msp_id);


        $identitystring = $identity->serializeToString();

        $headerString = $clientUtils->buildHeader($identitystring, $chainHeaderString, $nounce);
        $proposal = new Protos\Proposal();
        $proposal->setHeader($headerString);
        $proposal->setPayload($payloadString);

        return $proposal;
    }

    /**
     * Query using ChainCode
     * @param string $string
     * @return string
     */
    function sendTransactionProposal(Protos\Proposal $request, $timeout, Protos\EndorserClient $connect)
    {
        return $this->sendTransaction($request, null, null, $connect);
    }

    /**
     * Query using ChainCode
     * @param string $string
     * @return string
     */
    static function sendTransaction(Protos\Proposal $request, $name, $clientContext, Protos\EndorserClient $connect)
    {
        $clientUtil = new ClientUtils();
        $request = $clientUtil->getSignedProposal($request);

        list($proposalResponse, $status) = $connect->ProcessProposal($request)->wait();
        $status = ((array)$status);
        if (isset($status["code"]) && $status["code"] == 0) {
            print_r($proposalResponse->getPayload());
        } else {
            echo 'status is not 0';
            sleep(5);
//            $this->runQueryClient();
        }
//        return $this->sendTransactionProposal($request, $name, $clientContext);
    }



    function getTransactionId($protoUtils, $nounce)
    {
        $common = new Common();
        return $common->getTxId($protoUtils, $nounce);
    }
}
