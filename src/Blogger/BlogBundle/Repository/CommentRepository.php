<?php
// src/Blogger/BlogBundle/Repository/CommentRepository.php
namespace Blogger\BlogBundle\Repository;
use Doctrine\ORM\EntityRepository;
class CommentRepository extends EntityRepository
{
	public function getCommentsForBlog($blogId,$approved = true)
	{
		$qb = $this->createQueryBuilder('c')  //Recovering from the database
			   ->select('c')
			   ->where('c.blog = :blog_id')
	                   ->addOrderBy('c.created')
	                   ->setParameter('blog_id', $blogId);
        if (false === is_null($approved))
		            $qb->andWhere('c.approved = :approved')
	                  ->setParameter('approved', $approved);
	        return $qb->getQuery()
	                  ->getResult();
	   }  
	public function getLatestComments($limit = 10)
{
	$qb = $this->createQueryBuilder('c') //Recover the comments from the database with a $limit
		   ->select('c')
		   ->addOrderBy('c.id','DESC');
	if (false === is_null($limit))
	   $qb->setMaxResults($limit);

	return $qb->getQuery()
		  ->getResult();
}
}
