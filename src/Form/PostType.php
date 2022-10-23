<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Relation;
use App\Entity\Type;
use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        switch ($options['flow_step']) {
            case 1:
                $builder
                    ->add('title', TextType::class)
                    ->add('author', EntityType::class, [
                        'class' => User::class,
                        'disabled' => true
                    ])
                    ->add('note', TextareaType::class, [
                        'attr' => array(
                            'cols' => 100,
                            'rows' => 2,
                        )
                    ])
                    ->add('content', TextareaType::class, [
                        'attr' => array(
                            'cols' => 20,
                            'rows' => 20,
                        )
                    ]);
                break;

            case 2:
                $builder
                    ->add('categories', EntityType::class, [
                        'label' => 'Catégories',
                        'class' => Category::class,
                        'multiple' => true,
                        'expanded' => true,
                        'constraints' => new Count([
                            'max' => 3
                        ])
                    ])
                    ->add('type', EntityType::class, [
                        'label' => 'Type de post',
                        'class' => Type::class,
                        'multiple' => false,
                        'expanded' => true
                    ])
                    ->add('relation', EntityType::class, [
                        'label' => 'Relation',
                        'class' => Relation::class,
                        'multiple' => false,
                        'expanded' => true
                    ]);
                break;

                // case 3:
                //     $builder
                //         ->add('img', FileType::class, [
                //             'label' => 'Illustration',
                //             'mapped' => false,
                //             'required' => false
                //         ]);
                //     break;
        }
    }

    public function getBlockPrefix()
    {
        return 'createPost';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
