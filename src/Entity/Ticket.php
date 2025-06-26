<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TicketRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity]
#[ApiResource]
class Ticket
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    
    private ?int $id = null;

    #[ORM\Column(length:255)]
   
    private ?string $artistName = null;

    #[ORM\Column]
   
    private ?\DateTime $startDate = null;

    #[ORM\Column]
   
    private ?\DateTime $endDate = null;

    #[ORM\Column(length:255)]
 
    private ?string $venue = null;

    #[ORM\Column(type: Types::DECIMAL, precision:10, scale:2)]
   
    private ?string $price = null;

    #[ORM\Column]
   
    private ?int $remainingQuantity = null;

    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: OrderItem::class)]
  
    private Collection $orderItems;

    // Dans Ticket.php
    #[ORM\ManyToOne(inversedBy: 'tickets')]
   // Pour inclure l'objet Category lors de la lecture d'un Ticket
    private ?Category $category = null;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtistName(): ?string
    {
        return $this->artistName;
    }

    public function setArtistName(string $artistName): static
    {
        $this->artistName = $artistName;

        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setstartDate(\DateTime $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getVenue(): ?string
    {
        return $this->venue;
    }

    public function setVenue(string $venue): static
    {
        $this->venue = $venue;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getRemainingQuantity(): ?int
    {
        return $this->remainingQuantity;
    }

    public function setRemainingQuantity(int $remainingQuantity): static
    {
        $this->remainingQuantity = $remainingQuantity;

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setTicket($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getTicket() === $this) {
                $orderItem->setTicket(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
    public function __toString(): string
{
    
    return $this->getArtistName() ?? 'Not known Ticket';
  
}
}
