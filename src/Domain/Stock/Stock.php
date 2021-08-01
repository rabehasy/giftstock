<?php

namespace App\Domain\Stock;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Gift\Gift;
use App\Infrastructure\Doctrine\StockRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Gift::class, inversedBy="stocks")
     * @Groups({"group:read"})
     */
    private $gift;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"group:read"})
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGift(): ?Gift
    {
        return $this->gift;
    }

    public function setGift(?Gift $gift): self
    {
        $this->gift = $gift;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
