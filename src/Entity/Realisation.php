<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="realisations")
 * @ORM\Entity(repositoryClass="App\Repository\RealisationRepository")
 */
class Realisation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $github;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $preview;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img_laptop;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img_phone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
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

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): self
    {
        $this->github = $github;

        return $this;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function setPreview(string $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    public function getImgLaptop(): ?string
    {
        return $this->img_laptop;
    }

    public function setImgLaptop(string $img_laptop): self
    {
        $this->img_laptop = $img_laptop;

        return $this;
    }

    public function getImgPhone(): ?string
    {
        return $this->img_phone;
    }

    public function setImgPhone(string $img_phone): self
    {
        $this->img_phone = $img_phone;

        return $this;
    }
}
