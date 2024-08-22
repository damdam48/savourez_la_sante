<?php

namespace App\Form;

use App\Entity\Saison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SaisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la saison',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image',
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => true,
            ])

            ->add('online', CheckboxType::class, [
                'label' => 'Visible en ligne',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Saison::class,
        ]);
    }
}
