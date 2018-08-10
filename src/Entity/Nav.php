<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="navs")
 * @ORM\Entity(repositoryClass="App\Repository\NavRepository")
 */
class Nav
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $section_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $display_text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon_source;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon_type;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $icon_color;

    /**
     * @ORM\Column(type="integer")
     */
    private $displayed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSectionId(): ?int
    {
        return $this->section_id;
    }

    public function setSectionId(?int $section_id): self
    {
        $this->section_id = $section_id;

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

    public function getIconColor(): ?string
    {
        return $this->icon_color;
    }

    public function setIconColor(string $icon_color): self
    {
        $this->icon_color = $icon_color;

        return $this;
    }

    public function getDisplayText(): ?string
    {
        return $this->display_text;
    }

    public function setDisplayText(string $display_text): self
    {
        $this->display_text = $display_text;

        return $this;
    }

    public function getIconSource(): ?string
    {
        return $this->icon_source;
    }

    public function setIconSource(string $icon_source): self
    {
        $this->icon_source = $icon_source;

        return $this;
    }

    public function getIconType(): ?string
    {
        return $this->icon_type;
    }

    public function setIconType(string $icon_type): self
    {
        $this->icon_type = $icon_type;

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
