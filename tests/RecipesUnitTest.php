<?php

namespace App\Tests;

use App\Entity\Recipes;
use PHPUnit\Framework\TestCase;

class RecipesUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $recipe = new Recipes();

        $recipe->setTitle('title')
            ->setPreparationTime(10)
            ->setPreparationStandingTime(10)
            ->setCookingTime(10)
            ->setIngredients('ingredients')
            ->setStagesOfRecipe('stages of recipe')
            ->setIsPublic(true)
            ->setImageName('image name')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());
        

        $this->assertTrue($recipe->getTitle() === 'title');
        $this->assertTrue($recipe->getPreparationTime() === 10);
        $this->assertTrue($recipe->getPreparationStandingTime() === 10);
        $this->assertTrue($recipe->getCookingTime() === 10);
        $this->assertTrue($recipe->getIngredients() === 'ingredients');
        $this->assertTrue($recipe->getStagesOfRecipe() === 'stages of recipe');
        $this->assertTrue($recipe->getIsPublic() === true);
        $this->assertTrue($recipe->getImageName() === 'image name');
        $this->assertTrue($recipe->getCreatedAt() instanceof \DateTimeImmutable);
        $this->assertTrue($recipe->getUpdatedAt() instanceof \DateTimeImmutable);
    }

    public function testIsFalse(): void
    {
        $recipe = new Recipes();

        $recipe->setTitle('title')
            ->setPreparationTime(10)
            ->setPreparationStandingTime(10)
            ->setCookingTime(10)
            ->setIngredients('ingredients')
            ->setStagesOfRecipe('stages of recipe')
            ->setIsPublic(true)
            ->setImageName('image file name')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());

        $this->assertFalse($recipe->getTitle() === 'false');
        $this->assertFalse($recipe->getPreparationTime() === 1);
        $this->assertFalse($recipe->getPreparationStandingTime() === 1);
        $this->assertFalse($recipe->getCookingTime() === 1);
        $this->assertFalse($recipe->getIngredients() === 'false');
        $this->assertFalse($recipe->getStagesOfRecipe() === 'false');
        $this->assertFalse($recipe->getIsPublic() === false);
        $this->assertFalse($recipe->getImageName() === 'false');
        $this->assertFalse($recipe->getCreatedAt() instanceof \DateTime);
        $this->assertFalse($recipe->getUpdatedAt() instanceof \DateTime);
    }

    public function testIsEmpty(): void
    {
        $recipe = new Recipes();

        $this->assertEmpty($recipe->getTitle());
        $this->assertEmpty($recipe->getPreparationTime());
        $this->assertEmpty($recipe->getPreparationStandingTime());
        $this->assertEmpty($recipe->getCookingTime());
        $this->assertEmpty($recipe->getIngredients());
        $this->assertEmpty($recipe->getStagesOfRecipe());
        $this->assertEmpty($recipe->getIsPublic());
        $this->assertEmpty($recipe->getImageName());
    }
}
