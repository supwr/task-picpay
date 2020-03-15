<?php

namespace App\Controller;

use App\Entity\Transaction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Account;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Service\Transation as TransactionService;


class TransactionController extends AbstractController
{
    private $serializer;
    private $transactionService;

    function __construct(EncoderInterface $serializer, TransactionService $transactionService)
    {
        $this->serializer = $serializer;
        $this->transactionService = $transactionService;
    }

    /**
     * @Route("/api/transactions", name="create_transaction", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createTransaction(Request $request)
    {
        $params = json_decode($request->getContent());
        $em = $this->getDoctrine()->getManager();

        $payee = $em->getRepository("App:Account")->find($params->payee_id);
        $payer = $em->getRepository("App:Account")->find($params->payer_id);

        $transaction = new Transaction();
        $transaction->setPayer($payer);
        $transaction->setPayee($payee);
        $transaction->setValue($params->value);

        $em->persist($transaction);
        $em->flush();

        $this->transactionService->createTransaction($transaction);

        $response = new Response();
        $response->setContent($this->serializer->serialize($transaction, 'json', ['groups' => ['transaction_get']]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
}
