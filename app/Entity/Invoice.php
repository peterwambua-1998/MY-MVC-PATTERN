<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="invoices")
 */
class Invoice {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;
    /**
     * @ORM\Column
     */
    private string $amount;
    /**
     * @ORM\Column(name="inv_num")
     */
    private string $invNum; //we are using camel case but in db its snake case but we will se a way to resolve this
    /**
     * @ORM\Column
     */
    private bool $status;
    /**
     * @ORM\Column(name="created_at")
     */
    private \DateTime $createdAt;

    public function getId() {
        return $this->id;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getInvNum() {
        return $this->invNum;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDate() {
        return $this->createdAt;
    }
}
