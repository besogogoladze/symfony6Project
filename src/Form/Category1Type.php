<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Category1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('image', FileType::class,
            [
                'label' => 'Image (JPG, PNG)',
                'required' => false,
                'attr' => [
                    'accept' => 'image/jpeg, image/png',
                    'placeholder' => "Image placeholder"
                ],
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\Image([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Please upload a valid JPEG or PNG image.',
                        'maxSizeMessage' => 'The file is too large ({{ size }} {{ suffixes }}). Allowed maximum size is {{ limit }} {{ suffixes }}.',
                        'uploadErrorMessage' => 'The image could not be uploaded.',
                    ])
                ],
                'mapped' => false, // Don't map this field to the entity
            ])
            ->add('date_add', DateTimeType::class, [
                'data' => new \DateTime(),
                'widget' => 'single_text',
                // 'attr' => ['style' => 'display:none'],
                'label' => false,
                'required' => false  
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
