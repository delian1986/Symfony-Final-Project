<?php


namespace ShopBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use ShopBundle\Entity\Cart;
use Doctrine\Common\Persistence\ManagerRegistry;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\User;

class CartService implements CartServiceInterface
{

    private $manager;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ManagerRegistry $manager)
    {
        $this->entityManager = $entityManager;
        $this->manager = $manager;
    }

    public function addToCart(Product $product, User $user): void
    {
        $productToAdd=new Product();
        $productToAdd->setName($product->getName());
        $productToAdd->setQuantity(1);
        $productToAdd->setDescription($product->getDescription());
        $productToAdd->setPrice($product->getPrice());

        $user->getCart()->add($productToAdd);

        $em=$this->manager->getManager();
        $em->persist($user);
        $em->flush();
    }
}