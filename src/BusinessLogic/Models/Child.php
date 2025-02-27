<?php
namespace App\BusinessLogic\Models;

use App\Adapters\Secondary\Repositories\Doctrine\ChildRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChildRepository::class)]
class Child
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\ManyToOne(targetEntity: Parents::class, cascade: ['persist'], inversedBy: 'children')]
    private Parents $parents;
    public function __construct(string $name, Parents $parents)
    {
        $this->name = $name;
        $this->parents = $parents;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParents(): Parents
    {
        return $this->parents;
    }

}
