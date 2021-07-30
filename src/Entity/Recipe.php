<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get"={"normalization_context"={"groups"="fromRecipe"}},
 *          "post"={"denormalization_context"={"groups"="fromRecipe"}},
 *          
 * },
 *      itemOperations={
 *          "get"={"normalization_context"={"groups"="fromRecipe"}},
 *          "put"
 * },
 * 
 * )
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @ApiFilter(SearchFilter::class)
 */
class Recipe
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"fromRecipe"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"fromRecipe"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"fromRecipe"})
     */
    private $description;

    

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"fromRecipe"})
     */
    private $steps;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"fromRecipe"})
     */
    private $calories;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"fromRecipe"})
     */
    private $preparationTime;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"fromRecipe"})
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(callback={"App\Enum\Category", "getPossibleValues"})
     * @Groups({"fromRecipe"})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, columnDefinition="enum('Entreecource', 'Maindish', 'SideDish', 'Dessert', 'Drink', 'Other')")
     * @Groups({"fromRecipe"})
     */
    private $difficulty;

    /**
     * @ORM\OneToMany(targetEntity=RecipeIngredient::class, mappedBy="recipe")
     * @Groups({"fromRecipe"})
     * @ApiSubresource()
     */
    private $recipeIngredients;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="recipe",cascade={"persist", "remove"})
     * @Groups({"fromRecipe"})
     */
    private $reviews;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"fromRecipe"})
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"fromRecipe"})
     */
    private $servesNumPersons;

    /**
     * @ORM\ManyToOne(targetEntity=MediaObject::class)
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"fromRecipe"})
     * @ApiProperty(iri= "http://schema.org/image")
     */
    private $image;

    public function __construct()
    {
        $this->recipeIngredients = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?MediaObject
    {
        return $this->image;
    }

    public function setImage(?MediaObject $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSteps(): ?string
    {
        return $this->steps;
    }

    public function setSteps(?string $steps): self
    {
        $this->steps = $steps;

        return $this;
    }

    public function getCalories(): ?int
    {
        return $this->calories;
    }

    public function setCalories(?int $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(?int $preparationTime): self
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(?string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * @return Collection|RecipeIngredient[]
     */
    public function getRecipeIngredients(): Collection
    {
        return $this->recipeIngredients;
    }

    public function addRecipeIngredient(RecipeIngredient $recipeIngredient): self
    {
        if (!$this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients[] = $recipeIngredient;
            $recipeIngredient->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(RecipeIngredient $recipeIngredient): self
    {
        if ($this->recipeIngredients->removeElement($recipeIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeIngredient->getRecipe() === $this) {
                $recipeIngredient->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setRecipe($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getRecipe() === $this) {
                $review->setRecipe(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getServesNumPersons(): ?int
    {
        return $this->servesNumPersons;
    }

    public function setServesNumPersons(?int $servesNumPersons): self
    {
        $this->servesNumPersons = $servesNumPersons;

        return $this;
    }
}
