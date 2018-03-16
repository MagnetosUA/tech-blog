<?php

namespace MagnetosCompany\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use MagnetosCompany\BlogBundle\Entity\Category;
use MagnetosCompany\BlogBundle\Entity\Tag;

class PostAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'post';
    protected $baseRoutePattern = 'post';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', TextType::class, [
                'label' => 'Заголовок'
            ])
            ->add('article', TextareaType::class, [
                'label' => 'Статья'
            ])
            ->add('link_to_image', TextType::class, [
                'label' => 'Адрес картинки'
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => false,
                'label' => 'Категория'
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => false,
                'label' => 'Тег'
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('article');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('article');
    }
}

