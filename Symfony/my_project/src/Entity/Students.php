<?php

namespace App\Entity;

use App\Repository\StudentsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StudentsRepository::class)]
class Students
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(max: 100, maxMessage: "Имя не длиннее 100 символов")]
    #[Assert\NotBlank(message: "Имя не должно быть пустым")]
    #[Assert\Regex(pattern: '/\D/', message: "В имени не должно быть цифр")]
    private ?string $firstname = null;

    #[ORM\Column(length: 150)]
    #[Assert\Length(max: 150, maxMessage: "Фамилия не длиннее 150 символов")]
    #[Assert\NotBlank(message: "Фамилия не должна быть пустой")]
    private ?string $lastname = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Номер группы не должен быть пустым")]
    #[Assert\Length(min: 5, minMessage: "Номер группы не короче 5 символов")]
    private ?int $groupnum = null;

    public function __construct($firstname="", $lastname="", $groupnum="")
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->groupnum = $groupnum;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getGroupnum(): ?int
    {
        return $this->groupnum;
    }

    public function setGroupnum(int $groupnum): static
    {
        $this->groupnum = $groupnum;

        return $this;
    }

    public function getFullName()
    {
        return "{$this->getLastname()} {$this->getFirstname()}";
    }
}
