<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
{
    use TimestampableEntity;
    /**
     * Hook blameable behavior
     * updates createdBy, updatedBy fields
     */
    use BlameableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"fromRecipe"})
     */
    private $isLiked;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"fromRecipe"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="reviews")
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="reviews")
     */
    private $recipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsLiked(): ?bool
    {
        return $this->isLiked;
    }

    public function setIsLiked(?bool $isLiked): self
    {
        $this->isLiked = $isLiked;

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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

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
