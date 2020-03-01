<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $shipping_status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderDetail", mappedBy="id_order", orphanRemoval=true)
     */
    private $orderDetails;

    public function __toString()
    {
        return strval($this->getId());
    }

    public function __construct()
    {
        $this->orderDetails = new ArrayCollection();
        $this->setDate(new \DateTime());
        $this->setShippingStatus(false);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?user
    {
        return $this->id_user;
    }

    public function setIdUser(?user $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getShippingStatus(): ?bool
    {
        return $this->shipping_status;
    }

    public function setShippingStatus(bool $shipping_status): self
    {
        $this->shipping_status = $shipping_status;

        return $this;
    }

    /**
     * @return Collection|OrderDetail[]
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetail $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails[] = $orderDetail;
            $orderDetail->setIdOrder($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self
    {
        if ($this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->removeElement($orderDetail);
            // set the owning side to null (unless already changed)
            if ($orderDetail->getIdOrder() === $this) {
                $orderDetail->setIdOrder(null);
            }
        }

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function editUser() {
        $user = $this->getIdUser();
        $user->addTotalAmount($this->getPrice());
        $user->setLastOrder($this->getDate());
    }

    /**
     * @ORM\PreRemove
     */
    public function reduceTotalAmount() {
        $this->getIdUser()->reduceTotalAmount($this->getPrice());
    }
}
