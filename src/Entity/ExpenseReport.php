<?php

namespace App\Entity;

use App\Repository\ExpenseReportRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ExpenseReportRepository::class)
 */
class ExpenseReport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $report_date;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type(type="float")
     * @Assert\GreaterThan(0)
     */
    private float $amount;

    /**
     * @ORM\ManyToOne(targetEntity=ExpenseReportType::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private ExpenseReportType $report_type;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="expenseReports")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private Company $company;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="expenseReports")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private User $owner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReportDate(): ?\DateTimeInterface
    {
        return $this->report_date;
    }

    public function setReportDate(\DateTimeInterface $report_date): self
    {
        $this->report_date = $report_date;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getReportType(): ?ExpenseReportType
    {
        return $this->report_type;
    }

    public function setReportType(?ExpenseReportType $report_type): self
    {
        $this->report_type = $report_type;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
