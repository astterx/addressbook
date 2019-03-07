<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('address')
            ->add('zipcode')
            ->add('city')
            ->add('country')
            ->add('phone')
            ->add(
                'birthday',
                DateType::Class,
                [
                    'years' => range(date('Y') - 100, date('Y')),
                ]
            )
            ->add('email')
            ->add('picture');

        $builder->get('birthday')->addModelTransformer(new CallbackTransformer(
            function ($birthday) {
                return new \DateTime($birthday);
            },
            function ($birthday) {
                return $birthday->format('Y-m-d');
            }
        ));

        $builder->get('picture')->addModelTransformer(new CallBackTransformer(
            function($image) {
                return null;
            },
            function($image) {
                return $image;
            }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Person',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'appbundle_person';
    }
}
