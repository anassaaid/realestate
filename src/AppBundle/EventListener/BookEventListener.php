<?php

namespace AppBundle\EventListener;


use AppBundle\Event\BookEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BookEventListener implements EventSubscriberInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * BookEventListener constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $twig
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [BookEvent::CREATE_BOOK_SUCCESS => 'onCreateSuccess'];
    }


    public function onCreateSuccess(BookEvent $event)
    {
        $book = $event->getBook();

        $message = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setFrom('service@transtu-bib.tn', 'Transtu Bib')
            ->setTo($book->getAuthor()->getEmail())
            ->setSubject('Your book has been to our library')
            ->setBody($this->twig->render('mail/book_created.html.twig', ['book' => $book]));

        $this->mailer->send($message);
    }

}