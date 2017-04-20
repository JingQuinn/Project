<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="string", length=255)
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="steps", type="string", length=255)
     */
    private $steps;

    /**
     * @var string
     *
     * @ORM\Column(name="ingredients", type="string", length=255)
     */
    private $ingredients;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var \AppBundle\Entity\Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag")
     * @ORM\JoinColumn(name="tag_id",referencedColumnName="id")
     */
    private $tag;

    /**
     * @var \AppBundle\Entity\Comment
     *
     * @ORM\ManyToOne(targetEntity="Comment")
     * @ORM\JoinColumn(name="comment_id",referencedColumnName="id")
     */
    private $comment;

    /**
     * @var int
     *
     * @ORM\Column(name="votDown", type="integer")
     */
    private $votDown;

    /**
     * @var int
     *
     * @ORM\Column(name="votUp", type="integer")
     */
    private $votUp;

    /**
     * @var int
     *
     * @ORM\Column(name="visibility", type="integer")
     */
    private $visibility;

    /**
     * @var string
     *
     * @ORM\Column(name="summaryImage", type="string", length=255)
     *
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 400,
     *     minHeight = 150,
     *     maxHeight = 400
     * )
     */
    private $summaryImage;

    /**
     * Set summaryImage
     *
     * @param string $summaryImage
     *
     * @return Recipe
     */
    public function setSummaryImage(File $file = null)
    {
        $this->summaryImage = $file;

        //return $this;
    }

    /**
     * Get summaryImage
     *
     * @return string
     */
    public function getSummaryImage()
    {
        return $this->summaryImage;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="stepImage", type="string", length=255)
     *
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 400,
     *     minHeight = 150,
     *     maxHeight = 400
     * )
     */
    private $stepImage;

    /**
     * Set stepImage
     *
     * @param string $stepImage
     *
     * @return Recipe
     */
    public function setStepImage(File $file = null)
    {
        $this->stepImage = $file;

        //return $this;
    }

    /**
     * Get summaryImage
     *
     * @return string
     */
    public function getStepImage()
    {
        return $this->stepImage;
    }

    /**
     * Get visibility
     *
     * @return int
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set visibility
     *
     * @param int $visibility
     *
     * @return Recipe
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    /**
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * Get datetime
     *
     * @return datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set datetime
     *
     * @param datetime $date
     *
     * @return Recipe
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Recipe
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return Recipe
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set steps
     *
     * @param string $steps
     *
     * @return Recipe
     */
    public function setSteps($steps)
    {
        $this->steps = $steps;

        return $this;
    }

    /**
     * Get steps
     *
     * @return string
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Set ingredients
     *
     * @param string $ingredients
     *
     * @return Recipe
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * Get ingredients
     *
     * @return string
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Recipe
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return Recipe
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Recipe
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set votDown
     *
     * @param integer $votDown
     *
     * @return Recipe
     */
    public function setVotDown($votDown)
    {
        $this->votDown = $votDown;

        return $this;
    }

    /**
     * Get votDown
     *
     * @return int
     */
    public function getVotDown()
    {
        return $this->votDown;
    }

    /**
     * Set votUp
     *
     * @param integer $votUp
     *
     * @return Recipe
     */
    public function setVotUp($votUp)
    {
        $this->votUp = $votUp;

        return $this;
    }

    /**
     * Get votUp
     *
     * @return int
     */
    public function getVotUp()
    {
        return $this->votUp;
    }

}
