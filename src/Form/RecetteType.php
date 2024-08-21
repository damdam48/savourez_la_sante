<?php
namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Product\Recette;
use App\Entity\Saison;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la recette',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('online', CheckboxType::class, [
                'label' => 'Visible en ligne',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                ],
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image',
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('listeIngredient', TextareaType::class, [
                'label' => 'Liste des Ingrédients',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('preparation', TextareaType::class, [
                'label' => 'Préparation',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])

            ->add('saison', EntityType::class, [
                'class' => Saison::class,
                'choice_label' => 'name',
            ])

            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
