<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(mappedBy="company", targetEntity=ExpenseReport::class)
     */
    private $expenseReports;

    public function __construct()
    {
        $this->expenseReports = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ExpenseReport>
     */
    public function getExpenseReports(): Collection
    {
        return $this->expenseReports;
    }

    public function addExpenseReport(ExpenseReport $expenseReport): self
    {
        if (!$this->expenseReports->contains($expenseReport)) {
            $this->expenseReports[] = $expenseReport;
            $expenseReport->setCompany($this);
        }

        return $this;
    }

    public function removeExpenseReport(ExpenseReport $expenseReport): self
    {
        if ($this->expenseReports->removeElement($expenseReport)) {
            // set the owning side to null (unless already changed)
            if ($expenseReport->getCompany() === $this) {
                $expenseReport->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->name = strtolower($this->name);
    }

    
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->name = strtolower($this->name);
    }
}
