<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CPFixtures extends Fixture
{
    public const CP_REFERENCE = 'cp-ref';

    public function load(ObjectManager $manager){
        $cps = array();

        for( $i = 0; $i<5; $i++ ) {
            $cp = new CP();
            $cp->setCode(4000+$i);
            $cps[] = $cp;
            $manager->persist($cp);
        }

        $this->addReference(self::CP_REFERENCE, $cps);

        $manager->flush();
    }
}

class ServiceFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $services = array();
        for( $i = 0; $i<5; $i++ ) {
            $service = new Service();
            $service->setName("Massage visage 30m - ".$i);
            $service->setDescription("30m de massage du visage par nos professionnels");
            $service->setInFront(true);
            $service->setValidated(false);
            $services[] = $service;
            $manager->persist($service);
        }

        $cps = $this->getReference(CPFixtures::CP_REFERENCE);

        for( $i = 0; $i<5; $i++ ) {
            $vendor = new Vendor();
            $vendor->setName("vendor".$i);
            $vendor->setCP(array_rand($cps, 1));
            $manager->persist($vendor);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CPFixtures::class,
        );
    }
}
