<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

<<<<<<< HEAD
    #[ORM\Column(length: 50)]
=======
    #[ORM\Column(length: 50, nullable: false)]
>>>>>>> b92a1a053894c4cf172eb138315db26ba0e4664e
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

<<<<<<< HEAD
    public function setName(string $name): static
=======
    public function setName(?string $name): static
>>>>>>> b92a1a053894c4cf172eb138315db26ba0e4664e
    {
        $this->name = $name;

        return $this;
    }
}
