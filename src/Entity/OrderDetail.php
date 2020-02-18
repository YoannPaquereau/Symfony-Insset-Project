<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="orders_detail")
 * @ORM\Entity(repositoryClass="App\Repository\OrderDetailRepository")
 */
class OrderDetail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="orderDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_order;

    public function __toString()
    {
        return strval($this->getIdProduct());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduct(): ?product
    {
        return $this->id_product;
    }

    public function setIdProduct(?product $id_product): self
    {
        $this->id_product = $id_product;

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

    public function getIdOrder(): ?order
    {
        return $this->id_order;
    }

    public function setIdOrder(?order $id_order): self
    {
        $this->id_order = $id_order;

        return $this;
    }
}
