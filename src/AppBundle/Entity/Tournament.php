<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament
 *
 * @ORM\Table(name="tournament")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TournamentRepository")
 */
class Tournament
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="size", type="integer", nullable=true)
     */
    private $size;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set size.
     *
     * @param int|null $size
     *
     * @return Tournament
     */
    public function setSize($size = null)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size.
     *
     * @return int|null
     */
    public function getSize()
    {
        return $this->size;
    }
}
