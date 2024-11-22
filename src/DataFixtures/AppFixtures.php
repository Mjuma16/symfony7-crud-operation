<?php

namespace App\DataFixtures;

use App\Entity\TodoList;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $todo = new TodoList();
        $todo->setName('Juma');
        $todo->setTitle('Match');
        $todo->setDescription('Juma have match at 2PM');
        $manager->persist($todo);

        $todo1 = new TodoList();
        $todo1->setName('Juma');
        $todo1->setTitle('Juma11');
        $todo1->setDescription('Juma11');
        $manager->persist($todo1);
        
        $manager->flush();
    }
}
