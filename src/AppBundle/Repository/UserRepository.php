<?php

namespace AppBundle\Repository;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use AppBundle\Entity\User;

class UserRepository extends CrudRepository
{
    /**
     * @param string $email
     *
     * @return object
     */
    public function findUserByEmail($email)
    {
        return $this->findOneBy(array(
            'email' => $email,
        ));
    }



}
