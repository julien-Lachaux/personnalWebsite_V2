<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FavoriRepository;

/**
 * @ORM\Table(name="favoris")
 * @ORM\Entity(repositoryClass=App\Repository\FavoriRepository::class)
 */
class Favori
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SkillGroup", inversedBy="favoris")
     */
    private $group;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $displayed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroup(): ?SkillGroup
    {
        return $this->group;
    }

    public function setGroup(?SkillGroup $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDisplayed(): ?int
    {
        return $this->displayed;
    }

    public function setDisplayed(int $displayed): self
    {
        $this->displayed = $displayed;

        return $this;
    }
}
