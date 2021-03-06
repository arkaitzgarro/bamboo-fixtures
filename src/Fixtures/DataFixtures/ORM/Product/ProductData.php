<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */

namespace Elcodi\Fixtures\DataFixtures\ORM\Product;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gaufrette\Adapter;
use Gaufrette\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\Abstracts\AbstractFixture;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Money;
use Elcodi\Component\EntityTranslator\Services\Interfaces\EntityTranslatorInterface;
use Elcodi\Component\Media\Services\ImageManager;
use Elcodi\Component\Media\Transformer\FileIdentifierTransformer;
use Elcodi\Component\Product\Entity\Interfaces\CategoryInterface;
use Elcodi\Component\Product\Entity\Interfaces\ProductInterface;

/**
 * Class ProductData
 */
class ProductData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var ImageManager              $imageManager
         * @var FileSystem                $filesystem
         * @var FileIdentifierTransformer $fileIdentifierTransformer
         * @var CategoryInterface         $menCategory
         * @var CategoryInterface         $womenCategory
         * @var CurrencyInterface         $currency
         */
        $imageManager = $this->container->get('elcodi.image_manager');
        $productFactory = $this->container->get('elcodi.factory.product');
        $variantFactory = $this->container->get('elcodi.factory.product_variant');
        $filesystem = $this->container->get('elcodi.core.media.filesystem.default');
        $fileIdentifierTransformer = $this->container->get('elcodi.file_identifier_transformer');
        $menCategory = $this->getReference('category-men');
        $womenCategory = $this->getReference('category-women');
        $currency = $this->getReference('currency-dollar');
        $currencyEuros = $this->getReference('currency-euro');

        /**
         * @var ObjectManager $productObjectManager
         * @var ObjectManager $imageObjectManager
         * @var EntityTranslatorInterface $entityTranslator
         */
        $productObjectManager = $this->get('elcodi.object_manager.product');
        $imageObjectManager = $this->get('elcodi.object_manager.image');
        $entityTranslator = $this->get('elcodi.entity_translator');

        /**
         * Ibiza Lips
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->addCategory($womenCategory)
            ->setPrincipalCategory($womenCategory)
            ->setShowInHome(true)
            ->setStock(10000)
            ->setPrice(Money::create(799, $currency))
            ->setEnabled(true);

        $variantWhiteSmall = $variantFactory->create();
        $variantWhiteSmall
            ->setProduct($product)
            ->setStock(10000)
            ->setPrice(Money::create(1099, $currency))
            ->addOption($this->getReference('value-size-small'))
            ->addOption($this->getReference('value-color-white'))
            ->setEnabled(true);

        $variantBlackSmall = $variantFactory->create();
        $variantBlackSmall
            ->setProduct($product)
            ->setStock(10000)
            ->setPrice(Money::create(1199, $currency))
            ->addOption($this->getReference('value-size-small'))
            ->addOption($this->getReference('value-color-black'))
            ->setEnabled(true);

        $variantWhiteMedium = $variantFactory->create();
        $variantWhiteMedium
            ->setProduct($product)
            ->setStock(10000)
            ->setPrice(Money::create(1299, $currency))
            ->addOption($this->getReference('value-size-medium'))
            ->addOption($this->getReference('value-color-white'))
            ->setEnabled(true);

        $variantBlackMedium = $variantFactory->create();
        $variantBlackMedium
            ->setProduct($product)
            ->setStock(10000)
            ->setPrice(Money::create(1399, $currency))
            ->addOption($this->getReference('value-size-medium'))
            ->addOption($this->getReference('value-color-black'))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $productObjectManager->persist($variantWhiteSmall);
        $productObjectManager->persist($variantWhiteMedium);
        $productObjectManager->persist($variantBlackSmall);
        $productObjectManager->persist($variantBlackMedium);

        $this->addReference('product-ibiza-lips', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'Ibiza Lips English',
                'slug' => 'ibiza-lips-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Ibiza Lips English',
                'metaDescription' => 'Ibiza Lips English',
                'metaKeywords' => 'Ibiza Lips English',
            ),
            'es' => array(
                'name' => 'Ibiza Lips Spanish',
                'slug' => 'ibiza-lips-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Ibiza Lips Spanish',
                'metaDescription' => 'Ibiza Lips Spanish',
                'metaKeywords' => 'Ibiza Lips Spanish',
            ),
            'fr' => array(
                'name' => 'Ibiza Lips Français',
                'slug' => 'ibiza-lips-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Ibiza Lips Français',
                'metaDescription' => 'Ibiza Lips Français',
                'metaKeywords' => 'Ibiza Lips Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-1.jpg'
        );

        /**
         * Ibiza Banana
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($womenCategory)
            ->setPrincipalCategory($womenCategory)
            ->setStock(10000)
            ->setPrice(Money::create(399, $currencyEuros))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-ibiza-banana', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'Ibiza Banana English',
                'slug' => 'ibiza-banana-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Ibiza Banana English',
                'metaDescription' => 'Ibiza Banana English',
                'metaKeywords' => 'Ibiza Banana English',
            ),
            'es' => array(
                'name' => 'Ibiza Banana Spanish',
                'slug' => 'ibiza-banana-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Ibiza Banana Spanish',
                'metaDescription' => 'Ibiza Banana Spanish',
                'metaKeywords' => 'Ibiza Banana Spanish',
            ),
            'fr' => array(
                'name' => 'Ibiza Banana Français',
                'slug' => 'ibiza-banana-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Ibiza Banana Français',
                'metaDescription' => 'Ibiza Banana Français',
                'metaKeywords' => 'Ibiza Banana Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-2.jpg'
        );

        /**
         * I Was There
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($womenCategory)
            ->setPrincipalCategory($womenCategory)
            ->setStock(10000)
            ->setPrice(Money::create(2105, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-i-was-there', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'I Was There English',
                'slug' => 'i-was-there-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'I Was There English',
                'metaDescription' => 'I Was There English',
                'metaKeywords' => 'I Was There English',
            ),
            'es' => array(
                'name' => 'I Was There Spanish',
                'slug' => 'i-was-there-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'I Was There Spanish',
                'metaDescription' => 'I Was There Spanish',
                'metaKeywords' => 'I Was There Spanish',
            ),
            'fr' => array(
                'name' => 'I Was There Français',
                'slug' => 'i-was-there-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'I Was There Français',
                'metaDescription' => 'I Was There Français',
                'metaKeywords' => 'I Was There Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-3.jpg'
        );

        /**
         * A Life Style
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($womenCategory)
            ->setPrincipalCategory($womenCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1290, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-a-life-style', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'A Life Style English',
                'slug' => 'a-life-style-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A Life Style English',
                'metaDescription' => 'A Life Style English',
                'metaKeywords' => 'A Life Style English',
            ),
            'es' => array(
                'name' => 'A Life Style Spanish',
                'slug' => 'a-life-style-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A Life Style Spanish',
                'metaDescription' => 'A Life Style Spanish',
                'metaKeywords' => 'A Life Style Spanish',
            ),
            'fr' => array(
                'name' => 'A Life Style Français',
                'slug' => 'a-life-style-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A Life Style Français',
                'metaDescription' => 'A Life Style Français',
                'metaKeywords' => 'A Life Style Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-4.jpg'
        );

        /**
         * A.M. Nesia Ibiza
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($womenCategory)
            ->setPrincipalCategory($womenCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1190, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-a-m-nesia-ibiza', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'A.M. Nesia Ibiza English',
                'slug' => 'a-m-nesia-ibiza-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A.M. Nesia Ibiza English',
                'metaDescription' => 'A.M. Nesia Ibiza English',
                'metaKeywords' => 'A.M. Nesia Ibiza English',
            ),
            'es' => array(
                'name' => 'A.M. Nesia Ibiza Spanish',
                'slug' => 'a-m-nesia-ibiza-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A.M. Nesia Ibiza Spanish',
                'metaDescription' => 'A.M. Nesia Ibiza Spanish',
                'metaKeywords' => 'A.M. Nesia Ibiza Spanish',
            ),
            'fr' => array(
                'name' => 'A.M. Nesia Ibiza Français',
                'slug' => 'a-m-nesia-ibiza-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A.M. Nesia Ibiza Français',
                'metaDescription' => 'A.M. Nesia Ibiza Français',
                'metaKeywords' => 'A.M. Nesia Ibiza Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-5.jpg'
        );

        /**
         * Amnesia poem
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($womenCategory)
            ->setPrincipalCategory($womenCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1390, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-amnesia-poem', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'Amnesia Poem English',
                'slug' => 'amnesia-poem-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia Poem English',
                'metaDescription' => 'Amnesia Poem English',
                'metaKeywords' => 'Amnesia Poem English',
            ),
            'es' => array(
                'name' => 'Amnesia Poem Spanish',
                'slug' => 'amnesia-poem-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia Poem Spanish',
                'metaDescription' => 'Amnesia Poem Spanish',
                'metaKeywords' => 'Amnesia Poem Spanish',
            ),
            'fr' => array(
                'name' => 'Amnesia Poem Français',
                'slug' => 'amnesia-poem-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia Poem Français',
                'metaDescription' => 'Amnesia Poem Français',
                'metaKeywords' => 'Amnesia Poem Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-6.jpg'
        );

        /**
         * Pyramid
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($womenCategory)
            ->setPrincipalCategory($womenCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1090, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-pyramid', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'Pyramid English',
                'slug' => 'pyramid-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Pyramid English',
                'metaDescription' => 'Pyramid English',
                'metaKeywords' => 'Pyramid English',
            ),
            'es' => array(
                'name' => 'Pyramid Spanish',
                'slug' => 'pyramid-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Pyramid Spanish',
                'metaDescription' => 'Pyramid Spanish',
                'metaKeywords' => 'Pyramid Spanish',
            ),
            'fr' => array(
                'name' => 'Pyramid Français',
                'slug' => 'pyramid-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Pyramid Français',
                'metaDescription' => 'Pyramid Français',
                'metaKeywords' => 'Pyramid Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-7.jpg'
        );

        /**
         * Amnesia pink
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($womenCategory)
            ->setPrincipalCategory($womenCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1290, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-amnesia-pink', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'Amnesia Pink English',
                'slug' => 'amnesia-pink-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia Pink English',
                'metaDescription' => 'Amnesia Pink English',
                'metaKeywords' => 'Amnesia Pink English',
            ),
            'es' => array(
                'name' => 'Amnesia Pink Spanish',
                'slug' => 'amnesia-pink-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia Pink Spanish',
                'metaDescription' => 'Amnesia Pink Spanish',
                'metaKeywords' => 'Amnesia Pink Spanish',
            ),
            'fr' => array(
                'name' => 'Amnesia Pink Français',
                'slug' => 'amnesia-pink-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia Pink Français',
                'metaDescription' => 'Amnesia Pink Français',
                'metaKeywords' => 'Amnesia Pink Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-8.jpg'
        );

        /**
         * Pinky fragments
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($womenCategory)
            ->setPrincipalCategory($womenCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1190, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-pinky-fragments', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'Pinky Fragments English',
                'slug' => 'pinky-fragments-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Pinky Fragments English',
                'metaDescription' => 'Pinky Fragments English',
                'metaKeywords' => 'Pinky Fragments English',
            ),
            'es' => array(
                'name' => 'Pinky Fragments Spanish',
                'slug' => 'pinky-fragments-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Pinky Fragments Spanish',
                'metaDescription' => 'Pinky Fragments Spanish',
                'metaKeywords' => 'Pinky Fragments Spanish',
            ),
            'fr' => array(
                'name' => 'Pinky Fragments Français',
                'slug' => 'pinky-fragments-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Pinky Fragments Français',
                'metaDescription' => 'Pinky Fragments Français',
                'metaKeywords' => 'Pinky Fragments Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-9.jpg'
        );

        /**
         * I Was There II
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($menCategory)
            ->setPrincipalCategory($menCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1190, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-i-was-there-ii', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'I was there II English',
                'slug' => 'i-was-there-ii-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'I was there II English',
                'metaDescription' => 'I was there II English',
                'metaKeywords' => 'I was there II English',
            ),
            'es' => array(
                'name' => 'I was there II Spanish',
                'slug' => 'i-was-there-ii-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'I was there II Spanish',
                'metaDescription' => 'I was there II Spanish',
                'metaKeywords' => 'I was there II Spanish',
            ),
            'fr' => array(
                'name' => 'I was there II Français',
                'slug' => 'i-was-there-ii-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'I was there II Français',
                'metaDescription' => 'I was there II Français',
                'metaKeywords' => 'I was there II Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-10.jpg'
        );

        /**
         * Amnesia
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($menCategory)
            ->setPrincipalCategory($menCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1800, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-amnesia', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'Amnesia English',
                'slug' => 'amnesia-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia English',
                'metaDescription' => 'Amnesia English',
                'metaKeywords' => 'Amnesia English',
            ),
            'es' => array(
                'name' => 'Amnesia Spanish',
                'slug' => 'amnesia-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia Spanish',
                'metaDescription' => 'Amnesia Spanish',
                'metaKeywords' => 'Amnesia Spanish',
            ),
            'fr' => array(
                'name' => 'Amnesia Français',
                'slug' => 'amnesia-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia Français',
                'metaDescription' => 'Amnesia Français',
                'metaKeywords' => 'Amnesia Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-11.jpg'
        );

        /**
         * Amnesia 100%
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($menCategory)
            ->setPrincipalCategory($menCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1650, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-amnesia-100-percent', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'Amnesia 100% English',
                'slug' => 'amnesia-100-percent-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia 100% English',
                'metaDescription' => 'Amnesia 100% English',
                'metaKeywords' => 'Amnesia 100% English',
            ),
            'es' => array(
                'name' => 'Amnesia 100% Spanish',
                'slug' => 'amnesia-100-percent-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia 100% Spanish',
                'metaDescription' => 'Amnesia 100% Spanish',
                'metaKeywords' => 'Amnesia 100% Spanish',
            ),
            'fr' => array(
                'name' => 'Amnesia 100% Français',
                'slug' => 'amnesia-100-percent-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Amnesia 100% Français',
                'metaDescription' => 'Amnesia 100% Français',
                'metaKeywords' => 'Amnesia 100% Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-12.jpg'
        );

        /**
         * A life style
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($menCategory)
            ->setPrincipalCategory($menCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1550, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-a-life-style-ii', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'A life style II English',
                'slug' => 'a-life-style-ii-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A life style II English',
                'metaDescription' => 'A life style II English',
                'metaKeywords' => 'A life style II English',
            ),
            'es' => array(
                'name' => 'A life style II Spanish',
                'slug' => 'a-life-style-ii-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A life style II Spanish',
                'metaDescription' => 'A life style II Spanish',
                'metaKeywords' => 'A life style II Spanish',
            ),
            'fr' => array(
                'name' => 'A life style II Français',
                'slug' => 'a-life-style-ii-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A life style II Français',
                'metaDescription' => 'A life style II Français',
                'metaKeywords' => 'A life style II Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-13.jpg'
        );

        /**
         * All night long
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($menCategory)
            ->setPrincipalCategory($menCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1710, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-all-night-long', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'All night long English',
                'slug' => 'all-night-long-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'All night long English',
                'metaDescription' => 'All night long English',
                'metaKeywords' => 'All night long English',
            ),
            'es' => array(
                'name' => 'All night long Spanish',
                'slug' => 'all-night-long-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'All night long Spanish',
                'metaDescription' => 'All night long Spanish',
                'metaKeywords' => 'All night long Spanish',
            ),
            'fr' => array(
                'name' => 'All night long Français',
                'slug' => 'all-night-long-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'All night long Français',
                'metaDescription' => 'All night long Français',
                'metaKeywords' => 'All night long Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-14.jpg'
        );

        /**
         * A.M. Nesia Ibiza II
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $menCategory = $this->getReference('category-men');
        $product
            ->setShowInHome(true)
            ->addCategory($menCategory)
            ->setPrincipalCategory($menCategory)
            ->setStock(10000)
            ->setPrice(Money::create(18000, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-a-m-nesia-ibiza-ii', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'A.M. Nesia Ibiza II English',
                'slug' => 'a-m-nesia-ibiza-ii-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A.M. Nesia Ibiza II English',
                'metaDescription' => 'A.M. Nesia Ibiza II English',
                'metaKeywords' => 'A.M. Nesia Ibiza II English',
            ),
            'es' => array(
                'name' => 'A.M. Nesia Ibiza II Spanish',
                'slug' => 'a-m-nesia-ibiza-ii-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A.M. Nesia Ibiza II Spanish',
                'metaDescription' => 'A.M. Nesia Ibiza II Spanish',
                'metaKeywords' => 'A.M. Nesia Ibiza II Spanish',
            ),
            'fr' => array(
                'name' => 'A.M. Nesia Ibiza II Français',
                'slug' => 'a-m-nesia-ibiza-ii-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'A.M. Nesia Ibiza II Français',
                'metaDescription' => 'A.M. Nesia Ibiza II Français',
                'metaKeywords' => 'A.M. Nesia Ibiza II Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-15.jpg'
        );

        /**
         * High Pyramid
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $menCategory = $this->getReference('category-men');
        $product
            ->setShowInHome(true)
            ->addCategory($menCategory)
            ->setPrincipalCategory($menCategory)
            ->setStock(10000)
            ->setPrice(Money::create(2000, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-high-pyramid', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'High Pyramid English',
                'slug' => 'high-pyramid-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'High Pyramid English',
                'metaDescription' => 'High Pyramid English',
                'metaKeywords' => 'High Pyramid English',
            ),
            'es' => array(
                'name' => 'High Pyramid Spanish',
                'slug' => 'high-pyramid-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'High Pyramid Spanish',
                'metaDescription' => 'High Pyramid Spanish',
                'metaKeywords' => 'High Pyramid Spanish',
            ),
            'fr' => array(
                'name' => 'High Pyramid Français',
                'slug' => 'high-pyramid-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'High Pyramid Français',
                'metaDescription' => 'High Pyramid Français',
                'metaKeywords' => 'High Pyramid Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-16.jpg'
        );

        /**
         * Star Amnesia
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $menCategory = $this->getReference('category-men');
        $product
            ->setShowInHome(true)
            ->addCategory($menCategory)
            ->setPrincipalCategory($menCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1145, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-star-amnesia', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'Star Amnesia English',
                'slug' => 'star-amnesia-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Star Amnesia English',
                'metaDescription' => 'Star Amnesia English',
                'metaKeywords' => 'Star Amnesia English',
            ),
            'es' => array(
                'name' => 'Star Amnesia Spanish',
                'slug' => 'star-amnesia-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Star Amnesia Spanish',
                'metaDescription' => 'Star Amnesia Spanish',
                'metaKeywords' => 'Star Amnesia Spanish',
            ),
            'fr' => array(
                'name' => 'Star Amnesia Français',
                'slug' => 'star-amnesia-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Star Amnesia Français',
                'metaDescription' => 'Star Amnesia Français',
                'metaKeywords' => 'Star Amnesia Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-17.jpg'
        );

        /**
         * Ibiza 4 Ever
         *
         * @var ProductInterface $product
         */
        $product = $productFactory->create();
        $product
            ->setShowInHome(true)
            ->addCategory($menCategory)
            ->setPrincipalCategory($menCategory)
            ->setStock(10000)
            ->setPrice(Money::create(1020, $currency))
            ->setEnabled(true);

        $productObjectManager->persist($product);
        $this->addReference('product-ibiza-4-ever', $product);
        $productObjectManager->flush($product);

        $entityTranslator->save($product, array(
            'en' => array(
                'name' => 'Ibiza 4 Ever English',
                'slug' => 'ibiza-4-ever-en',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Ibiza 4 Ever English',
                'metaDescription' => 'Ibiza 4 Ever English',
                'metaKeywords' => 'Ibiza 4 Ever English',
            ),
            'es' => array(
                'name' => 'Ibiza 4 Ever Spanish',
                'slug' => 'ibiza-4-ever-es',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Ibiza 4 Ever Spanish',
                'metaDescription' => 'Ibiza 4 Ever Spanish',
                'metaKeywords' => 'Ibiza 4 Ever Spanish',
            ),
            'fr' => array(
                'name' => 'Ibiza 4 Ever Français',
                'slug' => 'ibiza-4-ever-fr',
                'description' => 'Sed venenatis mauris eros, sit amet dapibus turpis consectetur et.
                Etiam blandit erat libero. Integer a elit a tortor scelerisque
                bibendum quis eget tortor. Donec vitae tempor tellus.',
                'metaTitle' => 'Ibiza 4 Ever Français',
                'metaDescription' => 'Ibiza 4 Ever Français',
                'metaKeywords' => 'Ibiza 4 Ever Français',
            ),
        ));

        $this->storeImage(
            $imageObjectManager,
            $imageManager,
            $filesystem,
            $fileIdentifierTransformer,
            $product,
            'product-18.jpg'
        );

        $manager->flush();
    }

    /**
     * Steps necessary to store an image
     *
     * @param ObjectManager             $imageObjectManager        Image ObjectManager
     * @param ImageManager              $imageManager              ImageManager
     * @param Filesystem                $filesystem                Filesystem
     * @param fileIdentifierTransformer $fileIdentifierTransformer fileIdentifierTransformer
     * @param ProductInterface          $product                   Product
     * @param string                    $imageName                 Image name
     *
     * @return ProductData self Object
     */
    protected function storeImage(
        ObjectManager $imageObjectManager,
        ImageManager $imageManager,
        Filesystem $filesystem,
        fileIdentifierTransformer $fileIdentifierTransformer,
        ProductInterface $product,
        $imageName
    )
    {
        $imagePath = realpath(dirname(__FILE__) . '/images/' . $imageName);
        $image = $imageManager->createImage(new File($imagePath));
        $imageObjectManager->persist($image);
        $imageObjectManager->flush($image);

        $filesystem->write(
            $fileIdentifierTransformer->transform($image),
            file_get_contents($imagePath),
            true
        );

        $product->addImage($image);
        $product->setPrincipalImage($image);

        return $this;
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'Elcodi\Fixtures\DataFixtures\ORM\Currency\CurrencyData',
            'Elcodi\Fixtures\DataFixtures\ORM\Category\CategoryData',
            'Elcodi\Fixtures\DataFixtures\ORM\Attribute\AttributeData',
        ];
    }
}
