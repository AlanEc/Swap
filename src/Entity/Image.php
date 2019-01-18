<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={ "application/image" })
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User",inversedBy="image")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @var
     * @Assert\Image()
     */
    private $file;

    const PATH = 'public/build/images';

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
     * Set image
     *
     * @param string $image
     *
     * @return Image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     *
     * @param \App\Entity\User $user
     *
     * @return Image
     */
    public function setUser(\App\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     *
     * @return \App\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
