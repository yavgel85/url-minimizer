<?php

namespace App\Form;

use App\Entity\Link;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class LinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('originalUrl', UrlType::class, [
                'required' => false,
                'label' => 'Original URL',
                'default_protocol' => null,
                'attr' => [
                    'placeholder' => 'for example: https://google.com',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('shortCode', TextType::class, [
                'required' => false,
                'label' => 'Minimized link *',
                'help' => '* specify or let it generated automatically - ' . $_SERVER['HTTP_HOST'] . '/s/',
                'constraints' => [
                    new Length(['max' => 25]),
                ],
            ])
            ->add('expires_in', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    '1 minute' => 60,
                    '1 hour' => 3600,
                    '1 day' => 86400,
                    '1 week' => 604800
                ],
                'mapped' => false,
                'data' => 60,
                'constraints' => [
                    new NotNull(),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Link',
            //'data_class' => Link::class,
        ]);
    }
}
