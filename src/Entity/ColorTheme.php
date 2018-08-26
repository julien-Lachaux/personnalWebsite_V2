<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="color_themes")
 * @ORM\Entity(repositoryClass="App\Repository\ColorThemeRepository")
 */
class ColorTheme
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
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $colorLight;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $colorDark;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $textHover;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $accent;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $accentLight;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $accentDark;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getColorLight(): ?string
    {
        return $this->colorLight;
    }

    public function setColorLight(string $colorLight): self
    {
        $this->colorLight = $colorLight;

        return $this;
    }

    public function getColorDark(): ?string
    {
        return $this->colorDark;
    }

    public function setColorDark(string $colorDark): self
    {
        $this->colorDark = $colorDark;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getTextHover(): ?string
    {
        return $this->textHover;
    }

    public function setTextHover(string $textHover): self
    {
        $this->textHover = $textHover;

        return $this;
    }

    public function getAccent(): ?string
    {
        return $this->accent;
    }

    public function setAccent(?string $accent): self
    {
        $this->accent = $accent;

        return $this;
    }

    public function getAccentLight(): ?string
    {
        return $this->accentLight;
    }

    public function setAccentLight(?string $accentLight): self
    {
        $this->accentLight = $accentLight;

        return $this;
    }

    public function getAccentDark(): ?string
    {
        return $this->accentDark;
    }

    public function setAccentDark(?string $accentDark): self
    {
        $this->accentDark = $accentDark;

        return $this;
    }
}
