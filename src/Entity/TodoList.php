<?php

namespace App\Entity;

use App\Repository\TodoListRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TodoListRepository::class)]
class TodoList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Name field validation
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Name cannot be empty.")]
    #[Assert\Length(max: 255, maxMessage: "Name cannot exceed 255 characters.")]
    private ?string $name = null;

    // Title field Validation
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Title cannot be empty.")]
    #[Assert\Length(max: 255, maxMessage: "Title cannot exceed 255 characters.")]
    private ?string $title = null;


    //Description field Validation
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Description cannot be empty.")]
    #[Assert\Length(max: 255, maxMessage: "Description cannot exceed 255 characters.")]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
