<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $task1 = new Task();
        $task1->setTitle("Task 1")
            ->setDescription("task 1 description")
            ->setPosition(1);
        $manager->persist($task1);

        $task2 = new Task();
        $task2->setTitle("Task 2")
            ->setDescription("task 2 description")
            ->setPosition(2);
        $manager->persist($task2);

        $task3 = new Task();
        $task3->setTitle("Task 3")
            ->setDescription("task 3 description")
            ->setPosition(3);
        $manager->persist($task3);

        $task4 = new Task();
        $task4->setTitle("Task 4")
            ->setDescription("task 4 description")
            ->setPosition(4);
        $manager->persist($task4);

        $task5 = new Task();
        $task5->setTitle("Task 5")
            ->setDescription("task 5 description")
            ->setPosition(5);
        $manager->persist($task5);

        $task6 = new Task();
        $task6->setTitle("Task 6")
            ->setDescription("task 6 description")
            ->setPosition(6);
        $manager->persist($task6);

        $task7 = new Task();
        $task7->setTitle("Task 7")
            ->setDescription("task 7 description")
            ->setPosition(7);
        $manager->persist($task7);

        $task8 = new Task();
        $task8->setTitle("Task 8")
            ->setDescription("task 8 description")
            ->setPosition(8);
        $manager->persist($task8);

        $task9 = new Task();
        $task9->setTitle("Task 9")
            ->setDescription("task 9 description")
            ->setPosition(9);
        $manager->persist($task9);

        $manager->flush();
    }
}
