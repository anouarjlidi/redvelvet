<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/1/2018
 * Time: 6:29 PM
 */

namespace App\Service;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class PathFinder
{
    private $categoryRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->categoryRepository = $entityManager->getRepository(Category::class);
    }

    public function getFullPath($categoryId)
    {
        $category = $this->categoryRepository->find($categoryId);
        $path = [$category];

        while ($category->getParent())
        {
            $category = $this->categoryRepository->find($category->getParent());
            array_push($path, $category);
        }

        return array_reverse($path);
    }

}