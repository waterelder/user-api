<?php

namespace AppBundle\Forms;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Types\ArrayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('name', TextType::class);
        $builder->add('users', CollectionType::class, array(
            'entry_type' => EntityType::class,
            'entry_options'  => array(
                'class' => User::class
            ),
            'allow_delete' => true,
            'allow_add' => true,
            'by_reference' => false
        ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\UserGroup',
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ));
    }

    public function getName()
    {
        return 'group';
    }


}