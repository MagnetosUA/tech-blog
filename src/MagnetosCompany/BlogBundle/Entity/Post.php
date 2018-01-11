<?php

namespace MagnetosCompany\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Post
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="MagnetosCompany\BlogBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @ORM\Column(name="article", type="text")
     */
    private $article;

    /**
     * @ORM\Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(name="link_to_image", type="string", length=255)
     */
    private $linkToImage;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="post")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="post")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $categories;

    /**
     * Many Tags have Many Posts.
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="post_tags", joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")})
     */
    private $tags;

    /**
     * Tag constructor.
     */
    public function __construct() {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created = date_create();
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
     * @return Post
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
     * @return mixed
     */
    public function getLinkToImage()
    {
        return $this->linkToImage;
    }

    /**
     * @param mixed $linkToImage
     */
    public function setLinkToImage($linkToImage)
    {
        $this->linkToImage = $linkToImage;
    }

    /**
     * Set article
     *
     * @param string $article
     *
     * @return Post
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set created
     *
     * @param string $created
     *
     * @return Post
     */
    public function setCreated()
    {
        $this->created = date_create();

        return $this;
    }

    /**
     * Get created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set users
     *
     * @param \MagnetosCompany\BlogBundle\Entity\User $users
     *
     * @return Post
     */
    public function setUsers(\MagnetosCompany\BlogBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \MagnetosCompany\BlogBundle\Entity\User
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * Set categories
     *
     * @param \MagnetosCompany\BlogBundle\Entity\Category $categories
     *
     * @return Post
     */
    public function setCategories(\MagnetosCompany\BlogBundle\Entity\Category $categories = null)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags[] = $tags;
    }


    /**
     * Get categories
     *
     * @return \MagnetosCompany\BlogBundle\Entity\Category
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
