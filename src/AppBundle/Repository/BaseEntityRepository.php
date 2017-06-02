<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BaseEntityRepository extends EntityRepository
{
    public function findById($id)
    {
        return $this->findOneBy([
            'id' => $id,
        ]);
    }
}
