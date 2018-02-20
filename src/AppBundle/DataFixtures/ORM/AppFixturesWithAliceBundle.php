<?php

namespace AppBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class AppFixturesWithAliceBundle extends AbstractLoader
{
    /**
     * {@inheritdoc}
     */
    public function getFixtures()
    {
        return [
            __DIR__ . '/../../../../app/Resources/fixtures/data.yml',
        ];

    }
}