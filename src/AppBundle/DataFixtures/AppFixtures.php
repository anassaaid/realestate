<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $date = new \DateTime();

        for ($i = 0; $i < 20; $i++) {
            $book = new Book();

            $book
                ->setTitle('Book  ' . $i)
                ->setPrice(mt_rand(50, 500))
                ->setAvailable(mt_rand(0, 1))
                ->setCover('http://fakeimg.pl/350x200/?text=Book ' . $i)
                ->setPublishedAt($date->setTimestamp(mt_rand(535944109, 1514251309)));

            $manager->persist($book);
        }

        $manager->flush();
    }
}