<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PanelRepository;

/**
 * @ORM\Table(name="panels")
 * @ORM\Entity(repositoryClass=App\Repository\PanelRepository::class)
 */
class Panel
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtitle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ColorTheme")
     */
    private $colorTheme;

    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $decorations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $navUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $navText;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $navIcon;

    /**
     * @ORM\Column(type="integer")
     */
    private $navOrder;

    /**
     * @ORM\Column(type="boolean")
     */
    private $displayed;

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

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getColorTheme(): ?ColorTheme
    {
        return $this->colorTheme;
    }

    public function setColorTheme(?ColorTheme $colorTheme): self
    {
        $this->colorTheme = $colorTheme;

        return $this;
    }

    public function getDecorations()
    {
        return $this->decorations;
    }

    public function setDecorations($decorations): self
    {
        $this->decorations = $decorations;

        return $this;
    }

    public function getNavText(): ?string
    {
        return $this->navText;
    }

    public function setNavText(string $navText): self
    {
        $this->navText = $navText;

        return $this;
    }

    public function getNavIcon(): ?string
    {
        return $this->navIcon;
    }

    public function setNavIcon(string $navIcon): self
    {
        $this->navIcon = $navIcon;

        return $this;
    }

    public function getNavOrder(): ?int
    {
        return $this->navOrder;
    }

    public function setNavOrder(int $navOrder): self
    {
        $this->navOrder = $navOrder;

        return $this;
    }

    public function getDisplayed(): ?bool
    {
        return $this->displayed;
    }

    public function setDisplayed(bool $displayed): self
    {
        $this->displayed = $displayed;

        return $this;
    }

    public function getNavUrl(): ?string
    {
        return $this->navUrl;
    }

    public function setNavUrl(string $navUrl): self
    {
        $this->navUrl = $navUrl;

        return $this;
    }
}
