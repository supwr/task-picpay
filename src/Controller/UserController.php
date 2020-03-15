<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Account;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserController extends AbstractController
{
    private $serializer;

    function __construct(EncoderInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/users/consumers", name="create_consumer", methods={"POST"})
     * @param Request $request
     */
    public function createConsumer(Request $request)
    {
        $params = json_decode($request->getContent());
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository("App:User")->find($params->user_id);

        $consumer = new Account();
        $consumer->setType(Account::ACCOUNT_TYPE_CONSUMER);
        $consumer->setUsername($params->username);
        $consumer->setUser($user);

        $em->persist($consumer);
        $em->flush();

        $response = new Response();
        $response->setContent($this->serializer->serialize($consumer, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }

    /**
     * @Route("/api/users/sellers", name="create_seller", methods={"POST"})
     * @param Request $request
     */
    public function createSeller(Request $request)
    {
        $params = json_decode($request->getContent());
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository("App:User")->find($params->user_id);

        $consumer = new Account();
        $consumer->setType(Account::ACCOUNT_TYPE_SELLER);
        $consumer->setUsername($params->username);
        $consumer->setUser($user);
        $consumer->setCnpj($params->cnpj);
        $consumer->setFantasyName($params->fantasy_name);
        $consumer->setSocialName($params->social_name);

        $em->persist($consumer);
        $em->flush();

        $response = new Response();
        $response->setContent($this->serializer->serialize($consumer, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
}
