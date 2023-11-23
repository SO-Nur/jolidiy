<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $user = new User();

        $user->setFirstname($faker->firstName)
            ->setLastname($faker->lastName)
            ->setEmail($faker->email)
            ->setMiniBio($faker->realText());


        $manager->persist($user);

        for ($i=0; $i < 10; $i++) {
            $article = new Article();

            $article->setTitle($faker->words(4, true))
                ->setContent($faker->realText(1800))
                ->setSlug($faker->slug(4))
                ->setImageFilename($faker->filePath())
                ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                ->setUser($user);

            $manager->persist($article);
        }

        $manager->flush();
    }
}
