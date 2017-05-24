<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CrudRepository extends BaseEntityRepository
{
    public function save($obj)
    {
        $this->getEntityManager()->persist($obj);
    }

    public function delete($obj)
    {
        $this->getEntityManager()->remove($obj);
    }

    public function update($obj)
    {
        $this->getEntityManager()->merge($obj);

        return $obj;
    }


}
