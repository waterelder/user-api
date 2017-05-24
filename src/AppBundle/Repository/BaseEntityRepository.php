<?php
/**
 * Created by PhpStorm.
 * User: lex
 * Date: 24.05.17
 * Time: 19:59
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class BaseEntityRepository extends EntityRepository
{
    public function findById($id)
    {
        return $this->findOneBy(array(
            'id' => $id,
        ));
    }
}