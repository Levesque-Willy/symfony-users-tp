<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const TELEPHONE_REFERENCE = "Telephones";
    public const TELEVISION_REFERENCE = "Television";
    public const CONSOLEDEJEU_REFERENCE = "console-de-jeu";
    public const TABLETE_REFERENCE = "Tablette";


    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setShortname('Telephone');
        $category->setLongname('Categorie telephone');
        $manager->persist($category);
        $this->addReference(self::TELEPHONE_REFERENCE,$category);

        $category = new Category();
        $category->setShortname('Television');
        $category->setLongname('Categorie Television');
        $manager->persist($category);
        $this->addReference(self::TELEVISION_REFERENCE,$category);
        
        $category = new Category();
        $category->setShortname('console-de-jeu');
        $category->setLongname('Categorie console de jeu');
        $manager->persist($category);
        $this->addReference(self::CONSOLEDEJEU_REFERENCE,$category);

        $category = new Category();
        $category->setShortname('tablette');
        $category->setLongname('Categorie tablette');
        $manager->persist($category);
        $this->addReference(self::TABLETE_REFERENCE,$category);

        $manager->flush();
    }
}
