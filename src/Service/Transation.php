<?php

namespace App\Service;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use App\Entity\Account;
use App\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\TransactionInterface;

class Transation implements TransactionInterface
{
    private $transactionClient;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->transactionClient = new GuzzleClient();
        $this->em = $em;
    }

    public function createTransaction(Transaction $transaction)
    {
        $request = new GuzzleRequest('POST', $_ENV['TRANSACTION_SERVICE'],
            ["Content-Type" => "application/json"],
            json_encode([
                "payer_id" => $transaction->getPayer()->getId(),
                "payee_id" => $transaction->getPayee()->getId(),
                "value" => $transaction->getValue()
            ])
        );
        $promise = $this->transactionClient->sendAsync($request)->then(
            function (ResponseInterface $res) use ($transaction) {
                $status = $res->getStatusCode() == 401 ? Transaction::TRANSACTION_STATUS_REJECTED : Transaction::TRANSACTION_STATUS_APPROVED;

                $t = $this->em->getRepository("App:Transaction")->find($transaction->getId());
                $t->setUpdatedAt(new \DateTime());
                $t->setStatus($status);

                $this->em->persist($t);
                $this->em->flush();
            },
            function (RequestException $e) use ($transaction) {
                $t = $this->em->getRepository("App:Transaction")->find($transaction->getId());
                $t->setStatus(Transaction::TRANSACTION_STATUS_REJECTED);
                $t->setUpdatedAt(new \DateTime());

                $this->em->persist($t);
                $this->em->flush();
            }
        );

        $promise->wait();
    }

}