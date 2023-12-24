<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: MediaRepository::class)]

class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $videoLink = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $altText = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    private ?Article $article = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'featuredVideo')]
    private ?Article $articleVideo = null;

    #[ORM\ManyToOne(inversedBy: 'contentImage')]
    private ?Article $articleContentImage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file = null) : static
    {
        $this->file = $file;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    public function setVideoLink(?string $videoLink): static
    {
        $this->videoLink = $videoLink;

        return $this;
    }

    public function getAltText(): ?string
    {
        return $this->altText;
    }

    public function setAltText(?string $altText): static
    {
        $this->altText = $altText;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getArticleVideo(): ?Article
    {
        return $this->articleVideo;
    }

    public function setArticleVideo(?Article $articleVideo): static
    {
        $this->articleVideo = $articleVideo;

        return $this;
    }

    public function getArticleContentImage(): ?Article
    {
        return $this->articleContentImage;
    }

    public function setArticleContentImage(?Article $articleContentImage): static
    {
        $this->articleContentImage = $articleContentImage;

        return $this;
    }
}
