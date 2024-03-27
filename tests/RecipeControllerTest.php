<?php

use App\Ingredient;
use App\RecipeController;
use PHPUnit\Framework\TestCase;

class RecipeControllerTest extends TestCase
{
    private $controller;

    protected function setUp(): void
    {
        $this->controller = new App\RecipeController();
    }

    public function testGetMaxScoreWithGivenIngredients()
    {
        // Define the ingredients as provided
        $ingredients = [
            'sprinkles' => ['capacity' => 2, 'durability' => 0, 'flavour' => -2, 'texture' => 0, 'calories' => 3],
            'butterscotch' => ['capacity' => 0, 'durability' => 5, 'flavour' => -3, 'texture' => 0, 'calories' => 3],
            'chocolate' => ['capacity' => 0, 'durability' => 0, 'flavour' => 5, 'texture' => -1, 'calories' => 8],
            'candy' => ['capacity' => 0, 'durability' => -1, 'flavour' => 0, 'texture' => 5, 'calories' => 8],
        ];

        // Create an instance of the RecipeController
        $controller = new RecipeController();

        // Calculate the expected maximum score manually based on the provided ingredients
        // This calculation is based on the specific algorithm used by the getMaxScore method
        $expectedMaxScore = 21367368;

        // Call the getMaxScore method with the ingredients and check if it returns the expected result
        $actualMaxScore = $controller->getMaxScore($ingredients);
        $this->assertEquals($expectedMaxScore, $actualMaxScore);
    }


    public function testGetMaxScoreWithEmptyIngredients()
    {
        // Define the ingredients as an empty array
        $ingredients = [];

        // Create an instance of the RecipeController
        $controller = new RecipeController();

        // Calculate the expected maximum score manually based on the provided ingredients
        // This calculation is based on the specific algorithm used by the getMaxScore method
        $expectedMaxScore = 0;

        // Call the getMaxScore method with the ingredients and check if it returns the expected result
        $actualMaxScore = $controller->getMaxScore($ingredients);
        $this->assertEquals($expectedMaxScore, $actualMaxScore);
    }

    public function testGetMaxScoreWithInvalidIngredients()
    {
        // Define the ingredients as an array with an invalid ingredient
        $ingredients = [
            'invalid' => ['capacity' => 0, 'durability' => 0, 'flavour' => 0, 'texture' => 0, 'calories' => 0],
        ];

        // Create an instance of the RecipeController
        $controller = new RecipeController();

        // Call the getMaxScore method with the ingredients and check if it returns 0
        $actualMaxScore = $controller->getMaxScore($ingredients);
        $this->assertEquals(0, $actualMaxScore);
    }

}
