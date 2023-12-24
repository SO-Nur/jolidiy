<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use App\Form\MediaType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Media::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $mediasDir = $this->getParameter('media_directory');
        $uploadsDir = $this->getParameter('uploads_directory');

        yield TextField::new('name');
        yield TextField::new('altText');
        yield TextField::new('videoLink');

        $imageField = ImageField::new('file', 'Média')
            ->setBasePath($uploadsDir)
            ->setUploadDir($mediasDir)
            ->setUploadedFileNamePattern('[slug]-[uuid].[extention]');

        if (Crud::PAGE_EDIT == $pageName) {
                $imageField->setRequired(false);
        }

        yield $imageField;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $media = $entityInstance;

        $media->setName($media->getFile());

        parent::persistEntity($entityManager, $entityInstance);

    }

}
