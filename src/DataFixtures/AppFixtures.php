<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Verbatim;
use App\Entity\Association;
use App\Entity\Event;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

/**
 * Summary of AppFixtures
 */
class AppFixtures extends Fixture
{

    /**
     *  @var Generator
     */
    private Generator $faker;


    /**
     * Summary of __construct
     */

    public function __construct()
    {
    $this->faker = Factory::create('fr_FR');
    }


    /**
     * Summary of load
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        //Creation of Association
        
            $association = new Association();
            $association ->setName('')

                    ->SetAdress('1 place de la mairie - 34160 Galargues')
                    ->setEmail('ape.rpi.lesecoliersdefontbonnes@gmail.com')
                    //->setFacebook('')
                    ->setSiret('XXXXXXXXXXX');

            $manager->persist($association);
        

        // creation du User Admin
            $Aki = new User();
            $Aki->setEmail('alice.kindermans@gmail.com')
                ->setPassword('toto')
                ->setName('Alice')
                ->setSurname('Kindermans')
                ->setRoles(['ROLE_ADMIN'])
                ->setStatus('Tresorière')
                ->setRgpd(1);
    
            $manager->persist($Aki);

        
        /*Création des membres

        for($i=0; $i<5; $i++) {

            $user = new User();
            $user->setEmail($this->faker->email())
                ->setPassword('toto')
                ->setName($this ->faker->firstName())
                ->setsurname($this ->faker->lastName())
                ->setRoles(['ROLE_MEMBRES'])
                ->setStatus('Membres')
                ->setRgpd(1);
          
        $manager->persist($user);
        }
        */

        // Création Verbatim

        for($j=0; $j<3; $j++) {

            $verbatim = new Verbatim();
            $verbatim->setName($this ->faker->firstName())
                ->setDescription($this ->faker->sentence($nbWords = 6, $variableNbWords = true));
          
        $manager->persist($verbatim);
        }
        

       // Création Events

       for($k=0; $k<9; $k++) {

        $event = new Event();
        $event->setTitle($this ->faker->sentence($nbWords = 3, $variableNbWords = true))
            ->setDescription($this ->faker->sentence($nbWords = 300, $variableNbWords = true))
            ->setDate($this->faker->date($format = 'Y-m-d', $max = 'now'));
      
    $manager->persist($event);
    }
    $manager->flush();
}
}
