<?php 

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="invoices")
 */
class Invoice {
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private int $id;
    /**
     * @Column
     */
    private string $amount;
    /**
     * @Column(name="inv_num")
     */
    private string $invNum; 
    /**
     * @Column
     */
    private string $status;
    /**
     * @Column(name="created_at")
     */
    private \DateTime $createdAt;

    /**
     * @OneToMany(targetEntity="InvoiceItem",  mappedBy="invoice")
     */
    private Collection $item; 

    public function __construct() {
        
        $this->item = new ArrayCollection(); 
    }

    public function getId() {
        return $this->id;
    }


    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($value): Invoice {
        $this->amount = $value;

        return $this;
    }

    public function getInvNum() {
        return $this->invNum;
    }

    public function setInvNum($value): Invoice  {
        $this->invNum = $value;

        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($value): Invoice  {
        $this->status = $value;

        return $this;
    }


    public function getDate() {
        return $this->createdAt;
    }

    public function setDate($value): Invoice  {
        $this->createdAt = $value;

        return $this;
    }
    
    public function addItem(InvoiceItem $item)
    {
        $item->setInvoice($this);
        
        $this->item->add($item);

        return $this;
    }
}
