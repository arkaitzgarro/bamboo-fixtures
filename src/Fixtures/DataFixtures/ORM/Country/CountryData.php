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

namespace Elcodi\Fixtures\DataFixtures\ORM\Country;

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\Abstracts\AbstractFixture;
use Elcodi\Component\Geo\Entity\Country;

/**
 * Class CountryData
 */
class CountryData extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $countries = [
            ["DE","Germany"],
            ["AT","Austria"],
            ["BE","Belgium"],
            ["CA","Canada"],
            ["CN","China"],
            ["FI","Finland"],
            ["FR","France"],
            ["GR","Greece"],
            ["IT","Italy"],
            ["JP","Japan"],
            ["LU","Luxemburg"],
            ["NL","Netherlands"],
            ["PL","Poland"],
            ["PT","Portugal"],
            ["CZ","Czech Republic"],
            ["GB","United Kingdom"],
            ["SE","Sweden"],
            ["CH","Switzerland"],
            ["DK","Denmark"],
            ["US","Usa"],
            ["HK","Hongkong"],
            ["NO","Norway"],
            ["AU","Australia"],
            ["SG","Singapore"],
            ["IE","Ireland"],
            ["NZ","New Zealand"],
            ["KR","South Korea"],
            ["IL","Israel"],
            ["ZA","South Africa"],
            ["NG","Nigeria"],
            ["CI","Ivory Coast"],
            ["TG","Togo"],
            ["BO","Bolivia"],
            ["MU","Mauritius"],
            ["RO","Romania"],
            ["SK","Slovakia"],
            ["DZ","Algeria"],
            ["AS","American Samoa"],
            ["AD","Andorra"],
            ["AO","Angola"],
            ["AI","Anguilla"],
            ["AG","Antigua And Barbuda"],
            ["AR","Argentina"],
            ["AM","Armenia"],
            ["AW","Aruba"],
            ["AZ","Azerbaijan"],
            ["BS","Bahamas"],
            ["BH","Bahrain"],
            ["BD","Bangladesh"],
            ["BB","Barbados"],
            ["BY","Belarus"],
            ["BZ","Belize"],
            ["BJ","Benin"],
            ["BM","Bermuda"],
            ["BT","Bhutan"],
            ["BW","Botswana"],
            ["BR","Brazil"],
            ["BN","Brunei"],
            ["BF","Burkina Faso"],
            ["MM","Burma (myanmar)"],
            ["BI","Burundi"],
            ["KH","Cambodia"],
            ["CM","Cameroon"],
            ["CV","Cape Verde"],
            ["CF","Central African Republic"],
            ["TD","Chad"],
            ["CL","Chile"],
            ["CO","Colombia"],
            ["KM","Comoros"],
            ["CD","Congo, Dem. Republic"],
            ["CG","Congo, Republic"],
            ["CR","Costa Rica"],
            ["HR","Croatia"],
            ["CU","Cuba"],
            ["CY","Cyprus"],
            ["DJ","Djibouti"],
            ["DM","Dominica"],
            ["DO","Dominican Republic"],
            ["TL","East Timor"],
            ["EC","Ecuador"],
            ["EG","Egypt"],
            ["SV","El Salvador"],
            ["GQ","Equatorial Guinea"],
            ["ER","Eritrea"],
            ["EE","Estonia"],
            ["ET","Ethiopia"],
            ["FK","Falkland Islands"],
            ["FO","Faroe Islands"],
            ["FJ","Fiji"],
            ["GA","Gabon"],
            ["GM","Gambia"],
            ["GE","Georgia"],
            ["GH","Ghana"],
            ["GD","Grenada"],
            ["GL","Greenland"],
            ["GI","Gibraltar"],
            ["GP","Guadeloupe"],
            ["GU","Guam"],
            ["GT","Guatemala"],
            ["GG","Guernsey"],
            ["GN","Guinea"],
            ["GW","Guinea-bissau"],
            ["GY","Guyana"],
            ["HT","Haiti"],
            ["HM","Heard Island And Mcdonald Islands"],
            ["VA","Vatican City State"],
            ["HN","Honduras"],
            ["IS","Iceland"],
            ["IN","India"],
            ["ID","Indonesia"],
            ["IR","Iran"],
            ["IQ","Iraq"],
            ["IM","Isle Of Man"],
            ["JM","Jamaica"],
            ["JE","Jersey"],
            ["JO","Jordan"],
            ["KZ","Kazakhstan"],
            ["KE","Kenya"],
            ["KI","Kiribati"],
            ["KP","Korea, Dem. Republic Of"],
            ["KW","Kuwait"],
            ["KG","Kyrgyzstan"],
            ["LA","Laos"],
            ["LV","Latvia"],
            ["LB","Lebanon"],
            ["LS","Lesotho"],
            ["LR","Liberia"],
            ["LY","Libya"],
            ["LI","Liechtenstein"],
            ["LT","Lithuania"],
            ["MO","Macau"],
            ["MK","Macedonia"],
            ["MG","Madagascar"],
            ["MW","Malawi"],
            ["MY","Malaysia"],
            ["MV","Maldives"],
            ["ML","Mali"],
            ["MT","Malta"],
            ["MH","Marshall Islands"],
            ["MQ","Martinique"],
            ["MR","Mauritania"],
            ["HU","Hungary"],
            ["YT","Mayotte"],
            ["MX","Mexico"],
            ["FM","Micronesia"],
            ["MD","Moldova"],
            ["MC","Monaco"],
            ["MN","Mongolia"],
            ["ME","Montenegro"],
            ["MS","Montserrat"],
            ["MA","Morocco"],
            ["MZ","Mozambique"],
            ["NA","Namibia"],
            ["NR","Nauru"],
            ["NP","Nepal"],
            ["AN","Netherlands Antilles"],
            ["NC","New Caledonia"],
            ["NI","Nicaragua"],
            ["NE","Niger"],
            ["NU","Niue"],
            ["NF","Norfolk Island"],
            ["MP","Northern Mariana Islands"],
            ["OM","Oman"],
            ["PK","Pakistan"],
            ["PW","Palau"],
            ["PS","Palestinian Territories"],
            ["PA","Panama"],
            ["PG","Papua New Guinea"],
            ["PY","Paraguay"],
            ["PE","Peru"],
            ["PH","Philippines"],
            ["PN","Pitcairn"],
            ["PR","Puerto Rico"],
            ["QA","Qatar"],
            ["RE","Réunion"],
            ["RU","Russian Federation"],
            ["RW","Rwanda"],
            ["BL","Saint Barthélemy"],
            ["KN","Saint Kitts And Nevis"],
            ["LC","Saint Lucia"],
            ["MF","Saint Martin"],
            ["PM","Saint Pierre And Miquelon"],
            ["VC","Saint Vincent And The Grenadines"],
            ["WS","Samoa"],
            ["SM","San Marino"],
            ["ST","São Tomé And Príncipe"],
            ["SA","Saudi Arabia"],
            ["SN","Senegal"],
            ["RS","Serbia"],
            ["SC","Seychelles"],
            ["SL","Sierra Leone"],
            ["SI","Slovenia"],
            ["SB","Solomon Islands"],
            ["SO","Somalia"],
            ["GS","South Georgia And The South Sandwich Islands"],
            ["LK","Sri Lanka"],
            ["SD","Sudan"],
            ["SR","Suriname"],
            ["SJ","Svalbard And Jan Mayen"],
            ["SZ","Swaziland"],
            ["SY","Syria"],
            ["TW","Taiwan"],
            ["TJ","Tajikistan"],
            ["TZ","Tanzania"],
            ["TH","Thailand"],
            ["TK","Tokelau"],
            ["TO","Tonga"],
            ["TT","Trinidad And Tobago"],
            ["TN","Tunisia"],
            ["TR","Turkey"],
            ["TM","Turkmenistan"],
            ["TC","Turks And Caicos Islands"],
            ["TV","Tuvalu"],
            ["UG","Uganda"],
            ["UA","Ukraine"],
            ["AE","United Arab Emirates"],
            ["UY","Uruguay"],
            ["UZ","Uzbekistan"],
            ["VU","Vanuatu"],
            ["VE","Venezuela"],
            ["VN","Vietnam"],
            ["VG","Virgin Islands (british)"],
            ["VI","Virgin Islands (u.s.)"],
            ["WF","Wallis And Futuna"],
            ["EH","Western Sahara"],
            ["YE","Yemen"],
            ["ZM","Zambia"],
            ["ZW","Zimbabwe"],
            ["AL","Albania"],
            ["AF","Afghanistan"],
            ["AQ","Antarctica"],
            ["BA","Bosnia And Herzegovina"],
            ["BV","Bouvet Island"],
            ["IO","British Indian Ocean Territory"],
            ["BG","Bulgaria"],
            ["KY","Cayman Islands"],
            ["CX","Christmas Island"],
            ["CC","Cocos (keeling) Islands"],
            ["CK","Cook Islands"],
            ["GF","French Guiana"],
            ["PF","French Polynesia"],
            ["TF","French Southern Territories"],
            ["AX","Åland Islands"]
        ];

        foreach ($countries as $country) {

            /**
             * @var Country $countryInstance
             */
            $countryInstance = $this
                ->container
                ->get('elcodi.factory.country')
                ->create();

            $countryInstance
                ->setCode(strtolower($country[0]))
                ->setName(ucfirst($country[1]));

            $manager->persist($countryInstance);
            $this->setReference('country-' . $countryInstance->getCode(), $countryInstance);
        }

        $manager->flush();
    }
}
