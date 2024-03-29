<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

class UploadFormType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return FormInterface
     */
    public function buildForm(FormBuilderInterface $builder, array $options): FormInterface
    {
        $builder
            ->setAction('/upload')
            ->add('xml', FileType::class, [
                'label' => 'File (XML file)',
                'allow_file_upload' => 'xml',
                'attr' => [
                    'class' => 'file-upload',
                    'draggable' => 'true'
                ]
            ])
            ->add('upload', SubmitType::class)
            ->add('people', ButtonType::class, [
                'attr' => [
                    'class' => 'btn-people'
                ]
            ])
            ->add('shiporders', ButtonType::class, [
                'attr' => [
                    'class' => 'btn-shiporders'
                ]
            ]);

        return $builder->getForm();
    }
}