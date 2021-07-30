<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RecipeIngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ApiResource(
 *      collectionOperations={"get"={"normalization_context"={"groups"="fromRecipeIngredient"}},
 *          "post"},
 *      itemOperations={"get"={"normalization_context"={"groups"="fromRecipeIngredient"}}}
 * )
 * @ORM\Entity(repositoryClass=RecipeIngredientRepository::class)
 * @ApiFilter(SearchFilter::class, properties={
 *     "recipe.id": "exact"
 * })
 * @ApiFilter(SearchFilter::class)
 */
class RecipeIngredient
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"fromRecipe","fromRecipeIngredient"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"fromRecipe","fromRecipeIngredient"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"fromRecipe","fromRecipeIngredient"})
     */
    private $unit;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredient::class, inversedBy="recipeIngredients",cascade={"persist", "remove"})
     * @Groups({"fromRecipe","fromRecipeIngredient"})
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="recipeIngredients",cascade={"persist", "remove"})
     * @Groups({"private","fromRecipeIngredient"})
     */
    private $recipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }
}
