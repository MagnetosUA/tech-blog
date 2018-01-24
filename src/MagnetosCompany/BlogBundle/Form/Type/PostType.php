<?php

namespace MagnetosCompany\BlogBundle\Form\Type;

use MagnetosCompany\BlogBundle\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use MagnetosCompany\BlogBundle\Entity\Category;

class PostType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Добавить'
            ])
            ->getForm();
    }

}
