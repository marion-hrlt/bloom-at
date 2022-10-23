<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @return Post[] Returns an array of Post objects
     */
    public function findByUserInterests(int $userId)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->select('p')
            ->join('p.categories', 'c')
            ->join('p.relation', 'r')
            ->join('p.type', 't')
            ->join('c.users', 'cu')
            ->join('r.users', 'ru')
            ->join('t.users', 'tu')
            ->where('cu.id = :userId')
            ->orWhere('ru.id = :userId')
            ->orWhere('tu.id = :userId')
            ->setParameter('userId', $userId);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Post[] Returns an array of Post objects
     */
    public function findAllUserPosts(int $userId)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.author = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findLastUserPosts(int $userId)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.author = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }
}
