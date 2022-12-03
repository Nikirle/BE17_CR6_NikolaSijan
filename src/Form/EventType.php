<?php

namespace App\Form;

use App\Entity\Event;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, ["attr"=>["placeholder"=>"please type the event name", "class"=>"form-control mb-2"]])
            ->add('date_time', DateTimeType::class, ["attr"=>[ "class"=>"form-control mb-2"]])
            ->add('description', TextareaType::class,["attr"=>["placeholder"=>"please type description", "class"=>"form-control mb-2", "id"=>"name"]])
            ->add('picture', FileType::class, [
                'label' => 'Picture',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid picture document',
                    ])
                        ],"attr"=> ["class"=>"form-control mb-2"]
            ])
            ->add('capacity',IntegerType::class,["attr"=>["placeholder"=>"please type maximal number of people", "class"=>"form-control mb-2"]])
            ->add('email', EmailType::class,["attr"=>["placeholder"=>"please type email", "class"=>"form-control mb-2"]])
            ->add('phone',IntegerType::class,["attr"=>["placeholder"=>"please type phone number", "class"=>"form-control mb-2"]])
            ->add('address',TextType::class, ["attr"=>["placeholder"=>"please type street name and number,zip code and city name", "class"=>"form-control mb-2"]])
            ->add('url',TextType::class, ["attr"=>["placeholder"=>"please type event url", "class"=>"form-control mb-2"]])
            ->add('type', ChoiceType::class,[
                'choices'  => [
                    'music' => "music",
                    'sport' => "sport",
                    'theater' => "theater",
                    'movie' => "movie"
                ]
                , "attr"=> ["class"=>"form-control"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
