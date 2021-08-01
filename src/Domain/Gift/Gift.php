<?php

namespace App\Domain\Gift;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Domain\Receiver\Receiver;
use App\Domain\Stock\Stock;
use App\Infrastructure\Doctrine\GiftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

/**
 * @ApiResource(
 *     itemOperations={
 *          "get"={
 *              "method"="GET",
 *              "normalization_context"={
 *                   "groups"={
 *                      "group:read"
 *                   }
 *               }
 *           },
 *          "put",
 *          "delete"
 *     },
 *     collectionOperations=
 *     {
 *          "post",
 *          "get"={
 *              "method"="GET",
 *              "normalization_context"={
 *                   "groups"={
 *                      "group:read"
 *                   }
 *               }
 *           },
 *      }
 * )
 * @ApiFilter(
 *     OrderFilter::class,
 *     properties={
 *         "code"
 *     },
 *     arguments={"orderParameterName"="order"}
 * )
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *          "description": "ipartial",
 *          "code": "exact",
 *          "price": "exact"
 *     }
 * )
 * @ORM\Entity(repositoryClass=GiftRepository::class)
 */
class Gift
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * @Groups({"group:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"group:read"})
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"group:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Groups({"group:read"})
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="gift")
     */
    private $stocks;

    /**
     * @ORM\ManyToMany(targetEntity=Receiver::class, inversedBy="gifts")
     * @Groups({"group:read"})
     */
    private $receiver;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->receiver = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setGift($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getGift() === $this) {
                $stock->setGift(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Receiver[]
     */
    public function getReceiver(): Collection
    {
        return $this->receiver;
    }

    public function addReceiver(Receiver $receiver): self
    {
        if (!$this->receiver->contains($receiver)) {
            $this->receiver[] = $receiver;
        }

        return $this;
    }

    public function removeReceiver(Receiver $receiver): self
    {
        $this->receiver->removeElement($receiver);

        return $this;
    }
}
