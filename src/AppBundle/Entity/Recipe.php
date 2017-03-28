<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table(name="recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="recipeTitle", type="string", length=255)
     */
    private $recipeTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="recipeSummary", type="string", length=255)
     */
    private $recipeSummary;

    /**
     * @var string
     *
     * @ORM\Column(name="recipeSteps", type="string", length=255)
     */
    private $recipeSteps;

    /**
     * @var string
     *
     * @ORM\Column(name="recipeIngredients", type="string", length=255)
     */
    private $recipeIngredients;

    /**
     * @var string
     *
     * @ORM\Column(name="authorUsername", type="string", length=255)
     */
    private $authorUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="string", length=255)
     */
    private $comments;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set recipeTitle
     *
     * @param string $recipeTitle
     *
     * @return Recipe
     */
    public function setRecipeTitle($recipeTitle)
    {
        $this->recipeTitle = $recipeTitle;

        return $this;
    }

    /**
     * Get recipeTitle
     *
     * @return string
     */
    public function getRecipeTitle()
    {
        return $this->recipeTitle;
    }

    /**
     * Set recipeSummary
     *
     * @param string $recipeSummary
     *
     * @return Recipe
     */
    public function setRecipeSummary($recipeSummary)
    {
        $this->recipeSummary = $recipeSummary;

        return $this;
    }

    /**
     * Get recipeSummary
     *
     * @return string
     */
    public function getRecipeSummary()
    {
        return $this->recipeSummary;
    }

    /**
     * Set recipeSteps
     *
     * @param string $recipeSteps
     *
     * @return Recipe
     */
    public function setRecipeSteps($recipeSteps)
    {
        $this->recipeSteps = $recipeSteps;

        return $this;
    }

    /**
     * Get recipeSteps
     *
     * @return string
     */
    public function getRecipeSteps()
    {
        return $this->recipeSteps;
    }

    /**
     * Set recipeIngredients
     *
     * @param string $recipeIngredients
     *
     * @return Recipe
     */
    public function setRecipeIngredients($recipeIngredients)
    {
        $this->recipeIngredients = $recipeIngredients;

        return $this;
    }

    /**
     * Get recipeIngredients
     *
     * @return string
     */
    public function getRecipeIngredients()
    {
        return $this->recipeIngredients;
    }

    /**
     * Set authorUsername
     *
     * @param string $authorUsername
     *
     * @return Recipe
     */
    public function setAuthorUsername($authorUsername)
    {
        $this->authorUsername = $authorUsername;

        return $this;
    }

    /**
     * Get authorUsername
     *
     * @return string
     */
    public function getAuthorUsername()
    {
        return $this->authorUsername;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Recipe
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }
}

