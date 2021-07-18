<?php

namespace App\DataFixtures;

use App\Entity\Claim;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\RecipeIngredient;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $recipeTitles=["Fondant","Pizza","CheeseBurger","Ojja"];
        $recipeCategories=["EntreeCource","MainDish","SideDish","Dessert"];
        $difficulties=["beginner","medium","hard","professional"];
        for ($i = 0; $i < 3; $i++) {
            $recipe = new Recipe();
            $recipe->setTitle($recipeTitles[$i]);
            $recipe->setDescription("This is a description");
            $recipe->setCalories(mt_rand(500, 1500));
            $recipe->setIsActive(true);
            $recipe->setImage(null);
            $recipe->setSteps("These are the steps");
            $recipe->setCategory($recipeCategories[$i]);
            $recipe->setDifficulty($difficulties[$i]);

            /*Create review*/
            $review = new Review();
            $review->setIsLiked(true);
            $review->setDescription("Delicious");
            $review->setRecipe($recipe);

            $recipe->addReview($review);


            /*Create Ingeredient */
            $ingredient = new Ingredient();
            $ingredient->setName("Test Ingredient");
            $ingredient->setIsActive(true);

            $recipeIngredient = new RecipeIngredient();
            $recipeIngredient->setQuantity(mt_rand(100, 500));
            $recipeIngredient->setUnit("Gram");
            $recipeIngredient->setIngredient($ingredient);


            $recipe->addRecipeIngredient($recipeIngredient);



            $manager->persist($recipe);
            $manager->persist($review);
            $manager->persist($ingredient);
            $manager->persist($recipeIngredient);
        }

        $claimCategories=["Technical","Customer","Service","Financial"];
        $claimPriorities=["minor","major","critical","blocker"];
        for ($i = 0; $i < 3; $i++) {
            $claim = new Claim();
            $claim->setTitle("Claim Title");
            $claim->setDescription("This is a claim description");
            $claim->setResponse("Website is too slow");
            $claim->setStatus("Active");
            $claim->setClaimCategory($claimCategories[$i]);
            $claim->setPriority($claimPriorities[$i]);

            $manager->persist($claim);
        }


        $manager->flush();
    }
}
