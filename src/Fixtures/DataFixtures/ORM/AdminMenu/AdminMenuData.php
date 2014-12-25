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
 * @author Arkaitz Garro <hola@arkaitzgarro.com>
 */

namespace Elcodi\Fixtures\DataFixtures\ORM\AdminMenu;

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\Abstracts\AbstractFixture;
use Elcodi\Component\Menu\Entity\Menu\Menu;
use Elcodi\Component\Menu\Entity\Menu\Node;

/**
 * Class AdminMenuData
 *
 * Fixtures for Bamboo Admin side menu
 */
class AdminMenuData extends AbstractFixture
{
    /**
     * Factors a new menu Node
     *
     * Alias for elcodi.factory.menu service create() method
     *
     * @return Node
     */
    private function createNewNode()
    {
        return $this
            ->container
            ->get('elcodi.factory.menu_node')
            ->create();
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var EntityTranslatorInterface $entityTranslator
         */
        $entityTranslator = $this->get('elcodi.entity_translator');

        /**
         * User
         */

        $adminUsersNode = $this
            ->createNewNode()
            ->setName('Admin users')
            ->setUrl('admin_admin_user_list')
            ->enable();

        $manager->persist($adminUsersNode);


        $customersNode = $this
            ->createNewNode()
            ->setName('Customers')
            ->setUrl('admin_customer_list')
            ->enable();

        $manager->persist($customersNode);

        $userNode = $this
            ->createNewNode()
            ->setName('Users')
            ->setCode('users')
            ->addSubnode($adminUsersNode)
            ->addSubnode($customersNode)
            ->enable();

        $manager->persist($userNode);
        $manager->flush();

        $entityTranslator->save($userNode, array(
            'en' => array(
                'name' => 'Users',
            ),
            'es' => array(
                'name' => 'Usuarios',
            ),
            'fr' => array(
                'name' => 'Utilisateurs',
            ),
        ));

        $entityTranslator->save($adminUsersNode, array(
            'en' => array(
                'name' => 'Admin users',
            ),
            'es' => array(
                'name' => 'Usuarios admin',
            ),
            'fr' => array(
                'name' => 'Utilisateurs d\'administrateur',
            ),
        ));

        $entityTranslator->save($customersNode, array(
            'en' => array(
                'name' => 'Customers',
            ),
            'es' => array(
                'name' => 'Clientes',
            ),
            'fr' => array(
                'name' => 'Clientèle',
            ),
        ));

        /**
         * Catalog
         */

        $attributesNode = $this
            ->createNewNode()
            ->setName('Attribute')
            ->setUrl('admin_attribute_list')
            ->enable();

        $productsNode = $this
            ->createNewNode()
            ->setName('Products')
            ->setUrl('admin_product_list')
            ->enable();

        $manager->persist($productsNode);

        $categoriesNode = $this
            ->createNewNode()
            ->setName('Categories')
            ->setUrl('admin_category_list')
            ->enable();

        $manager->persist($categoriesNode);

        $manufacturersNode = $this
            ->createNewNode()
            ->setName('Manufacturers')
            ->setUrl('admin_manufacturer_list')
            ->enable();

        $manager->persist($manufacturersNode);

        $catalogNode = $this
            ->createNewNode()
            ->setName('Catalog')
            ->setCode('tags')
            ->setUrl('')
            ->addSubnode($attributesNode)
            ->addSubnode($productsNode)
            ->addSubnode($categoriesNode)
            ->addSubnode($manufacturersNode)
            ->enable();

        $manager->persist($catalogNode);
        $manager->flush();

        $entityTranslator->save($attributesNode, array(
            'en' => array(
                'name' => 'Attribute',
            ),
            'es' => array(
                'name' => 'Características',
            ),
            'fr' => array(
                'name' => 'Attributs',
            ),
        ));

        $entityTranslator->save($productsNode, array(
            'en' => array(
                'name' => 'Products',
            ),
            'es' => array(
                'name' => 'Productos',
            ),
            'fr' => array(
                'name' => 'Produits',
            ),
        ));

        $entityTranslator->save($categoriesNode, array(
            'en' => array(
                'name' => 'Categories',
            ),
            'es' => array(
                'name' => 'Categorías',
            ),
            'fr' => array(
                'name' => 'Catégories',
            ),
        ));

        $entityTranslator->save($manufacturersNode, array(
            'en' => array(
                'name' => 'Manufacturers',
            ),
            'es' => array(
                'name' => 'Fabricantes',
            ),
            'fr' => array(
                'name' => 'Fabricants',
            ),
        ));

        $entityTranslator->save($catalogNode, array(
            'en' => array(
                'name' => 'Catalog',
            ),
            'es' => array(
                'name' => 'Catálogo',
            ),
            'fr' => array(
                'name' => 'Catalogue',
            ),
        ));

        /*
         * Purchases
         */

        $cartsNode = $this
            ->createNewNode()
            ->setName('Carts')
            ->setUrl('admin_cart_list')
            ->enable();

        $manager->persist($cartsNode);

        $ordersNode = $this
            ->createNewNode()
            ->setName('Orders')
            ->setUrl('admin_order_list')
            ->enable();

        $manager->persist($ordersNode);

        $purchasesNode = $this
            ->createNewNode()
            ->setName('Purchases')
            ->setCode('shopping-cart')
            ->setUrl('')
            ->addSubnode($cartsNode)
            ->addSubnode($ordersNode)
            ->enable();

        $manager->persist($purchasesNode);
        $manager->flush();

        $entityTranslator->save($cartsNode, array(
            'en' => array(
                'name' => 'Carts',
            ),
            'es' => array(
                'name' => 'Carros',
            ),
            'fr' => array(
                'name' => 'Charrette',
            ),
        ));

        $entityTranslator->save($ordersNode, array(
            'en' => array(
                'name' => 'Orders',
            ),
            'es' => array(
                'name' => 'Pedidos',
            ),
            'fr' => array(
                'name' => 'Ordres',
            ),
        ));

        $entityTranslator->save($purchasesNode, array(
            'en' => array(
                'name' => 'Purchases',
            ),
            'es' => array(
                'name' => 'Compras',
            ),
            'fr' => array(
                'name' => 'Achats',
            ),
        ));

        /*
         * Media server
         */

        $mediasNode = $this
            ->createNewNode()
            ->setName('Medias')
            ->setCode('picture-o')
            ->setUrl('admin_image_list')
            ->enable();

        $manager->persist($mediasNode);
        $manager->flush();

        $entityTranslator->save($mediasNode, array(
            'en' => array(
                'name' => 'Medias',
            ),
            'es' => array(
                'name' => 'Multimedia',
            ),
            'fr' => array(
                'name' => 'Médias',
            ),
        ));

        /*
         * Banners
         */

        $bannerzonesNode = $this
            ->createNewNode()
            ->setName('Banner Zones')
            ->setUrl('admin_banner_zone_list')
            ->enable();

        $manager->persist($bannerzonesNode);

        $simpleBannersNode = $this
            ->createNewNode()
            ->setName('Banners')
            ->setUrl('admin_banner_list')
            ->enable();

        $manager->persist($simpleBannersNode);

        $bannersNode = $this
            ->createNewNode()
            ->setName('Banners')
            ->setUrl('')
            ->addSubnode($bannerzonesNode)
            ->addSubnode($simpleBannersNode)
            ->enable();

        $manager->persist($bannersNode);
        $manager->flush();

        $entityTranslator->save($bannerzonesNode, array(
            'en' => array(
                'name' => 'Banner Zones',
            ),
            'es' => array(
                'name' => 'Zonas de banners',
            ),
            'fr' => array(
                'name' => 'Zones banner',
            ),
        ));

        $entityTranslator->save($simpleBannersNode, array(
            'en' => array(
                'name' => 'Banners',
            ),
            'es' => array(
                'name' => 'Banners',
            ),
            'fr' => array(
                'name' => 'Banners',
            ),
        ));

        $entityTranslator->save($bannersNode, array(
            'en' => array(
                'name' => 'Banners',
            ),
            'es' => array(
                'name' => 'Banners',
            ),
            'fr' => array(
                'name' => 'Banners',
            ),
        ));

        /*
         * Coupon
         */

        $couponsNode = $this
            ->createNewNode()
            ->setName('Coupons')
            ->setUrl('admin_coupon_list')
            ->enable();

        $manager->persist($couponsNode);
        $manager->flush();

        $entityTranslator->save($couponsNode, array(
            'en' => array(
                'name' => 'Coupons',
            ),
            'es' => array(
                'name' => 'Cupones',
            ),
            'fr' => array(
                'name' => 'Coupons',
            ),
        ));

        /*
         * Currencies
         */

        $currenciesNode = $this
            ->createNewNode()
            ->setName('Currencies')
            ->setCode('btc')
            ->setUrl('admin_currency_list')
            ->enable();

        $manager->persist($currenciesNode);
        $manager->flush();

        $entityTranslator->save($currenciesNode, array(
            'en' => array(
                'name' => 'Currencies',
            ),
            'es' => array(
                'name' => 'Modenas',
            ),
            'fr' => array(
                'name' => 'Devises',
            ),
        ));

        /*
         * Rules
         */

        $ruleGroupsNode = $this
            ->createNewNode()
            ->setName('Rule Groups')
            ->setUrl('admin_rule_group_list')
            ->enable();

        $manager->persist($ruleGroupsNode);

        $simpleRulesNode = $this
            ->createNewNode()
            ->setName('Rules')
            ->setUrl('admin_rule_list')
            ->enable();

        $manager->persist($simpleRulesNode);

        $rulesNode = $this
            ->createNewNode()
            ->setName('Rules')
            ->setUrl('')
            ->addSubnode($ruleGroupsNode)
            ->addSubnode($simpleRulesNode)
            ->enable();

        $manager->persist($rulesNode);
        $manager->flush();

        $entityTranslator->save($ruleGroupsNode, array(
            'en' => array(
                'name' => 'Rule Groups',
            ),
            'es' => array(
                'name' => 'Grupos de reglas',
            ),
            'fr' => array(
                'name' => 'Groupes de régles',
            ),
        ));

        $entityTranslator->save($simpleRulesNode, array(
            'en' => array(
                'name' => 'Rules',
            ),
            'es' => array(
                'name' => 'Reglas',
            ),
            'fr' => array(
                'name' => 'Régles',
            ),
        ));

        $entityTranslator->save($rulesNode, array(
            'en' => array(
                'name' => 'Rules',
            ),
            'es' => array(
                'name' => 'Reglas',
            ),
            'fr' => array(
                'name' => 'Régles',
            ),
        ));

        /*
         * Currencies
         */

        $configurationNode = $this
            ->createNewNode()
            ->setName('Configuration')
            ->setCode('gear')
            ->setUrl('admin_configuration_list')
            ->enable();

        $manager->persist($configurationNode);
        $manager->flush();

        $entityTranslator->save($configurationNode, array(
            'en' => array(
                'name' => 'Configuration',
            ),
            'es' => array(
                'name' => 'Configuración',
            ),
            'fr' => array(
                'name' => 'Configuration',
            ),
        ));

        /*
         * Admin side Menu
         */

        /**
         * @var Menu $adminMenu
         */
        $adminMenu = $this
            ->container
            ->get('elcodi.factory.menu')
            ->create();

        $adminMenu
            ->setCode('admin')
            ->addSubnode($userNode)
            ->addSubnode($catalogNode)
            ->addSubnode($purchasesNode)
            ->addSubnode($mediasNode)
            ->addSubnode($bannersNode)
            ->addSubnode($couponsNode)
            ->addSubnode($currenciesNode)
            ->addSubnode($rulesNode)
            ->addSubnode($configurationNode)
            ->enable();

        $manager->persist($adminMenu);
        $this->addReference('menu-admin', $adminMenu);

        $manager->flush();
    }
}
