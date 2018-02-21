<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Annonce", mappedBy="user")
     */
    private $annonces;

    /**
     * Add annonce.
     *
     * @param \AppBundle\Entity\Annonce $annonce
     *
     * @return User
     */
    public function addAnnonce(\AppBundle\Entity\Annonce $annonce)
    {
        $this->annonces[] = $annonce;

        return $this;
    }

    /**
     * Remove annonce.
     *
     * @param \AppBundle\Entity\Annonce $annonce
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAnnonce(\AppBundle\Entity\Annonce $annonce)
    {
        return $this->annonces->removeElement($annonce);
    }

    /**
     * Get annonces.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonces()
    {
        return $this->annonces;
    }
}
