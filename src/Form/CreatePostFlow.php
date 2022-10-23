<?php

namespace App\Form;

use App\Form\PostType;
use Craue\FormFlowBundle\Form\FormFlow;

class CreatePostFlow extends FormFlow
{

    protected function loadStepsConfig()
    {
        return [
            [
                'label' => 'Contenu',
                'form_type' => PostType::class
            ],
            [
                'label' => 'Tags',
                'form_type' => PostType::class
            ],
            [
                'label' => 'Medias',
                'form_type' => PostType::class
            ],
            [
                'label' => 'Aperçu'
            ]
        ];
    }
}
