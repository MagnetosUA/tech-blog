<?php

namespace MagnetosCompany\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="MagnetosCompany\BlogBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      minMessage = "Your first name must be at least 2 characters long",
     *      maxMessage = "Your first name cannot be longer than 10 characters"
     * )
     */
    private $name;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $password;

    /**
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="users", orphanRemoval=true)
     */
    private $post;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->post = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isActive = true;
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

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->name,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->password,
        ) = unserialize($serialized);
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */

    /**
     * @Assert\IsTrue(message="The password cannot match your first name")
     */
    public function isPasswordLegal()
    {
        return $this->name !== $this->password;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->name;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add post
     *
     * @param \MagnetosCompany\BlogBundle\Entity\Post $post
     *
     * @return User
     */
    public function addPost(\MagnetosCompany\BlogBundle\Entity\Post $post)
    {
        $this->post[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \MagnetosCompany\BlogBundle\Entity\Post $post
     */
    public function removePost(\MagnetosCompany\BlogBundle\Entity\Post $post)
    {
        $this->post->removeElement($post);
    }

    /**
     * Get post
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPost($id)
    {
        return $this->post[$id];
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}
