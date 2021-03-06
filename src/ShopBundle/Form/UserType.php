<?php

namespace ShopBundle\Form;

use ShopBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', EmailType::class)
            ->add('password', RepeatedType::class, array(
                'type'            => PasswordType::class,
                'first_options'   => array('label' => 'Password'),
                'second_options'  => array('label' => 'Repeat Password'),
                'invalid_message' => 'Passwords do not match'
            ))
            ->add('fullName',TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => User::class
        ]);
    }


}
