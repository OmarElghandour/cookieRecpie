<?php

namespace App;

class RecipeController
{
    function calculateScore($ingredientAmounts, $ingredients) {
        $capacity = 0;
        $durability = 0;
        $flavour = 0;
        $texture = 0;
    
        foreach ($ingredients as $ingredientName => $ingredientProps) {

            $amount = $ingredientAmounts[$ingredientName];
            $capacity += $amount * $ingredientProps['capacity'];
            $durability += $amount * $ingredientProps['durability'];
            $flavour += $amount * $ingredientProps['flavour'];
            $texture += $amount * $ingredientProps['texture'];
        }
    
        if ($capacity < 0 || $durability < 0 || $flavour < 0 || $texture < 0) {
            return 0;
        }
    
        return $capacity * $durability * $flavour * $texture;
    }


    // Recursive function to calculate the maximum score 
    // using the ingredients and teaspoons left
    function createMix($ingredientNames, $ingredientAmounts, $ingredients, $teaspoonsLeft, $startIndex) {  
        if(count($ingredients) === 0) {
            return 0;
        }
        // Base case for the recursion when all teaspoons are used 
        if ($startIndex === count($ingredientNames) - 1) {
            $ingredientAmounts[$ingredientNames[$startIndex]] = $teaspoonsLeft;
            return $this->calculateScore($ingredientAmounts, $ingredients);
        }
    
        $maxScore = 0;
        for ($i = 0; $i <= $teaspoonsLeft; $i++) {
            $ingredientAmounts[$ingredientNames[$startIndex]] = $i;
            $score = $this->createMix($ingredientNames, $ingredientAmounts, $ingredients, $teaspoonsLeft - $i, $startIndex + 1);
            if ($score > $maxScore) {
                $maxScore = $score;
            }
        }
        return $maxScore;
    }

    
    function getMaxScore($ingredients) {
        $ingredientNames = array_keys($ingredients);
        $ingredientAmounts = array_fill_keys($ingredientNames, 0);    
        return $this->createMix($ingredientNames, $ingredientAmounts, $ingredients, 100, 0);
    }
    
}
