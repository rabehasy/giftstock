<?php

namespace App\Domain\Receiver;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Domain\Gift\Gift;
use App\Infrastructure\Doctrine\ReceiverRepository;
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
 *     SearchFilter::class,
 *     properties={
 *          "firstName": "ipartial",
 *          "lastName": "ipartial",
 *          "countryCode": "exact"
 *     }
 * )
 * @ORM\Entity(repositoryClass=ReceiverRepository::class)
 */
class Receiver
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
     * @ORM\Column(type="string", length=255)
     * @Groups({"group:read"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"group:read"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=2)
     * @Groups({"group:read"})
     */
    private $countryCode;

    /**
     * @ORM\ManyToMany(targetEntity=Gift::class, mappedBy="receiver")
     */
    private $gifts;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->gifts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return Collection|Gift[]
     */
    public function getGifts(): Collection
    {
        return $this->gifts;
    }

    public function addGift(Gift $gift): self
    {
        if (!$this->gifts->contains($gift)) {
            $this->gifts[] = $gift;
            $gift->addReceiver($this);
        }

        return $this;
    }

    public function removeGift(Gift $gift): self
    {
        if ($this->gifts->removeElement($gift)) {
            $gift->removeReceiver($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNames();
    }

    public function getNames(): ?string
    {
        $firstName = '' !== \trim($this->firstName) ? $this->firstName : '';
        $lastName = '' !== \trim($this->lastName) ? ('' !== $firstName ? ' ' : '').$this->lastName : '';

        return $firstName.$lastName;
    }
}
