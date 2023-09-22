<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammeRepository::class)]
class Programme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'programmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $session = null;

    #[ORM\Column]
    private ?float $duree = null;

    #[ORM\ManyToOne(inversedBy: 'programmes')]
    private ?Module $module = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): static
    {
        $this->session = $session;

        return $this;
    }

    public function getDuree(): ?float
    {
        return $this->duree;
    }

    public function setDuree(float $duree): static
    {
        $this->duree = $duree;

        return $this;
    }
    
    public function getModule(): ?Module
    {
        return $this->module;
    }
    
    public function setModule(?Module $module): static
    {
        $this->module = $module;
        
        return $this;
    }
    
        public function __toString(){
            return $this->session." Module : ".$this->module." Durée : ".$this->duree." jour(s)";
        }
}
