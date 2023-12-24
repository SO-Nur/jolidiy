<?php

namespace App\Entity;

use App\Model\TimestampedInterface;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article implements TimestampedInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable:true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'articles')]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'media')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Media::class)]
    private Collection $media;

    #[ORM\ManyToOne]
    private ?Media $featuredImage = null;

    #[ORM\OneToMany(mappedBy: 'articleVideo', targetEntity: Media::class)]
    private Collection $featuredVideo;

    #[ORM\OneToMany(mappedBy: 'articleContentImage', targetEntity: Media::class)]
    private Collection $contentImage;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->featuredVideo = new ArrayCollection();
        $this->contentImage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addArticle($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

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

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): static
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
            $medium->setArticle($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): static
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getArticle() === $this) {
                $medium->setArticle(null);
            }
        }

        return $this;
    }

    public function getFeaturedImage(): ?Media
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(?Media $featuredImage): static
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getFeaturedVideo(): Collection
    {
        return $this->featuredVideo;
    }

    public function addFeaturedVideo(Media $featuredVideo): static
    {
        if (!$this->featuredVideo->contains($featuredVideo)) {
            $this->featuredVideo->add($featuredVideo);
            $featuredVideo->setArticleVideo($this);
        }

        return $this;
    }

    public function removeFeaturedVideo(Media $featuredVideo): static
    {
        if ($this->featuredVideo->removeElement($featuredVideo)) {
            // set the owning side to null (unless already changed)
            if ($featuredVideo->getArticleVideo() === $this) {
                $featuredVideo->setArticleVideo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getContentImage(): Collection
    {
        return $this->contentImage;
    }

    public function addContentImage(Media $contentImage): static
    {
        if (!$this->contentImage->contains($contentImage)) {
            $this->contentImage->add($contentImage);
            $contentImage->setArticleContentImage($this);
        }

        return $this;
    }

    public function removeContentImage(Media $contentImage): static
    {
        if ($this->contentImage->removeElement($contentImage)) {
            // set the owning side to null (unless already changed)
            if ($contentImage->getArticleContentImage() === $this) {
                $contentImage->setArticleContentImage(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
