<?php

namespace App\Repository;

use App\Entity\Proveedor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
/**
 * @method Proveedor|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Proveedor|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Proveedor[]    findAll()
 * @method Proveedor[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class ProveedorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proveedor::class);
    }

 

    public function getAnyWayProveedor()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = 15')
            ->getQuery()
            ->getResult();
    }
}
