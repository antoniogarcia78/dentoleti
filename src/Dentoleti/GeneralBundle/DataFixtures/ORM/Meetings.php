<?php

namespace Dentoleti\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\GeneralBundle\Entity\Meeting;

/**
 * Fixtures de la entidad Meeting.
 * Crea las diferentes formas de conocer de la clínica
 */
class Meetings extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }
    
    public function load(ObjectManager $manager)
    {
        /* Carga inicial de formas de conocer a la clínica */
        $meetings = array(
            'Referidos',
            'Zona',
            'Marketing',
            'Internet',
            'Otras',
            );

        foreach ($meetings as $way) {
            $meeting = new Meeting();
            $meeting->setTheway($way);

            $manager->persist($meeting);
        }

        $manager->flush();
    }
}