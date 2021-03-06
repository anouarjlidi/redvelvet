<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/29/2018
 * Time: 5:06 PM
 */

namespace App\Form;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('required' => true, "label" => "Pavadinimas", 'attr'=> array('class'=>'form-control')))
            ->add('description', TextareaType::class, array('required' => true, "label" => "Aprašymas", 'attr'=> array('class'=>'form-control')))
            ->add('price', MoneyType::class, array('currency' => false, 'required' => true, "label" => "Kaina", 'attr'=> array('class'=>'form-control')))
            ->add('units', TextType::class, array('required' => true, "label" => "Matas", 'attr'=> array('class'=>'form-control')))
            ->add('category', ChoiceType::class, array(
                'required' => true,
                'placeholder' => '',
                'choices' => $this->entityManager->getRepository(Category::class)->findAll(),
                'choice_label' => function(Category $category) {
                    return $category->getTitle();
                },
                'choice_value' => function (Category $category = null) {
                    return $category ? $category->getId() : null;
                },
                "label" => "Kategorija",
                'attr'=> array('class'=>'form-control')
            ))
            ->add('save', SubmitType::class, array("label" => "Išsaugoti", 'attr'=> array('class'=>'btn-sm float-right btn-primary btn')));

        if($options['validation_groups'][0] == 'add')
        {
            $builder->add('photo', FileType::class, array('required' => true, "label" => "Nuotrauka", 'data_class' => null));
        }
        else
        {
            $builder->add('photo', FileType::class, array('required' => false, "label" => "Nuotrauka", 'data_class' => null));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Product',
            'attr' => array(
                'class' => 'product'
            ),
            'validation_groups' => array('add'),
        ));
    }
}