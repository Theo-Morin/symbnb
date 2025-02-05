<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class AdType extends AbstractType
{
    /**
     * Permet d'avoir la configuration d'un champ
     *
     */
    private function getConfiguration($label,$placeholder, $options = [])
    {
        return array_merge ([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre", "Tapez un titre pour votre annonce"))
            ->add('slug', TextType::class, $this->getConfiguration("Slug", "URL (Automatique)", ['required' => false]))
            ->add('coverImage', UrlType::class, $this->getConfiguration("Image de couverture", "URL"))
            ->add('introduction', TextareaType::class, $this->getConfiguration("Introduction de l'annonce", "Ecrivez une courte introduction"))
            ->add('content', TextareaType::class, $this->getConfiguration("Contenu de l'annonce", "Donnez envie aux gens de venir vous voir !"))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambres", "Nombre de chambres disponibles"))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix", "Prix par nuit"))
            ->add('images', CollectionType::class, ['entry_type' => ImageType::class, 'allow_add' => true, 'allow_delete' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
