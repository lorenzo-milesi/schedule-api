<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Day;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("Day")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Day")
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string|null $description
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Day::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     * @var Day|null $day
     */
    private $day;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Day")
     */
    private int $hour;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDay(): ?Day
    {
        return $this->day;
    }

    public function setDay(?Day $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getHour(): ?int
    {
        return $this->hour;
    }

    public function setHour(int $hour): self
    {
        $this->hour = $hour;

        return $this;
    }
}
