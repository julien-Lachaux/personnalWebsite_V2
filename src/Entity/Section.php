<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sections")
 * @ORM\Entity(repositoryClass="App\Repository\SectionRepository")
 */
class Section
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
    private $display_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="boolean")
     */
    private $displayed;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Nav", mappedBy="section")
     */
    private $navs;

    public function __construct()
    {
        $this->navs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisplayName(): ?string
    {
        return $this->display_name;
    }

    public function setDisplayName(string $display_ame): self
    {
        $this->display_name = $display_name;

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

    public function getDisplayed(): ?int
    {
        return $this->displayed;
    }

    public function setDisplayed(int $displayed): self
    {
        $this->displayed = $displayed;

        return $this;
    }

    /**
     * @return Collection|Nav[]
     */
    public function getNavs(): Collection
    {
        return $this->navs;
    }

    public function addNav(Nav $nav): self
    {
        if (!$this->navs->contains($nav)) {
            $this->navs[] = $nav;
            $nav->setSectionId($this);
        }

        return $this;
    }

    public function removeNav(Nav $nav): self
    {
        if ($this->navs->contains($nav)) {
            $this->navs->removeElement($nav);
            // set the owning side to null (unless already changed)
            if ($nav->getSectionId() === $this) {
                $nav->setSectionId(null);
            }
        }

        return $this;
    }
}
