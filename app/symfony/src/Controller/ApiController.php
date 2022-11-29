<?php

namespace App\Controller;

use App\Entity\Svelte;
use App\Manager\RedisManager;
use App\Message\EmailNotification;
use App\Repository\SvelteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

final class ApiController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return new Response("
            Hello, I'm the Symfony API. Please check out my resources :
            <a href=\"/redis\">/redis</a>, <a href=\"/db\">/db</a>, <a href=\"/mail\">/mail</a> and <a href=\"/rabbitmq\">/rabbitmq</a>.
        ");
    }

    #[Route('/redis', name: 'app_redis')]
    public function redis(RedisManager $redisManager): Response
    {
        $redis = $redisManager->getRedisInstance();

        $cacheDate = $redis->get('date');

        if (!$cacheDate) {
            $redis->set('date', (new \DateTime())->format('m-d-Y H:i:s'), ['nx', 'ex' => 300]);

            return new Response('Nothing was found in the cache! Please refresh this page to see effect.');
        }

        return new Response(sprintf('Cache hit! Last update was at %s. TTL is 5 minutes.', $cacheDate));
    }

    #[Route('/db', name: 'app_db')]
    public function db(SvelteRepository $svelteRepository): JsonResponse
    {
        $svelte = new Svelte();
        $svelteRepository->save($svelte, true);

        $sveltes = $svelteRepository->findAll();

        return $this->json($sveltes);
    }

    #[Route('/mail', name: 'app_mail')]
    public function mail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('svelte@kit.dev')
            ->to('the-prof@docker.com')
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Tema la taille du rat')
            ->text('Did you know that Svelte is the best Framework?')
            ->html('<h5>Do you know which framework is the best?</h5><h1>Svelte.</h1>')
        ;

        $mailer->send($email);

        return new Response('Email sent!');
    }

    #[Route('/rabbitmq', name: 'app_rabbitmq')]
    public function rabbitmq(MessageBusInterface $bus): Response
    {
        $bus->dispatch(new EmailNotification(
            'Tema la taille du lapin!',
            'Open me plz',
            'the-prof@docker.com',
            'legit@email.com'
        ));

        return new Response('Email queued via Rabbitmq!<br>Run "make rabbitmq-consume" to send the emails.');
    }
}
