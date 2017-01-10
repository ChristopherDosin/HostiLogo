<?php
class Shopware_Plugins_Frontend_HostiLogo_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{

    public function getLabel()
    {
        return 'Logo Größe ändern';
    }

    public function getVersion()
    {
        return '1.9';
    }

    public function getInfo()
    {
        return array(
            'version' => $this->getVersion(),
            'label' => $this->getLabel(),
            'author' => 'Shopwareianer.com',
            'supplier' => 'Shopwareianer.com',
            'description' => 'Ändert die Größe des Logos',
            'support' => 'info@shopwareianer.com',
            'link' => 'https://shopwareianer.com'
        );
    }

    public function install()
    {

        $this->subscribeEvent(
            'Theme_Compiler_Collect_Plugin_Less',
            'addLessFiles'
        );

        $this->createConfig();

        return true;
    }

    private function createConfig()
    {

        $form = $this->Form();

        $form->setElement(
            'number',
            'number',
            [ 'scope' => Shopware\Models\Config\Element::SCOPE_SHOP, 'label' => 'Logo Höhe', 'minValue' => 0, 'description' => 'Gebe die Höhe des Logos in px an.']
        );

        $form->setElement(
            'text',
            'marginTop',
            ['scope' => Shopware\Models\Config\Element::SCOPE_SHOP, 'label' => 'Logo Abstand nach oben','value' => '0', 'description' => 'Gebe den Abstand nach oben an. Bitte nur Zahlen. Verschiebe das Logo nach oben mit bspw. -50']
        );

        $form->setElement(
            'number',
            'marginBottom',
            ['scope' => Shopware\Models\Config\Element::SCOPE_SHOP, 'label' => 'Logo Abstand nach unten','value' => '0', 'description' => 'Gebe den Abstand nach unten an.']
        );

        $form->setElement(
            'number',
            'minimalLogoHeight',
            ['scope' => Shopware\Models\Config\Element::SCOPE_SHOP, 'label' => 'Logo Checkout Höhe', 'value' => '0', 'description' => 'Geben Sie die Höhe des Logos an für den minimalen Checkout.']
        );


        $form->setElement(
            'number',
            'minimalMarginTop',
            ['scope' => Shopware\Models\Config\Element::SCOPE_SHOP, 'label' => 'Logo Checkout Abstand oben', 'value' => '0', 'description' => 'Geben Sie den Abstand des Logos nach oben an für den minimalen Checkout.']
        );

        $form->setElement(
            'number',
            'minimalMarginBottom',
            ['scope' => Shopware\Models\Config\Element::SCOPE_SHOP, 'label' => 'Logo Checkout Abstand unten', 'value' => '0', 'description' => 'Geben Sie den Abstand des Logos nach unten an für den minimalen Checkout.']
        );

        $form->setElement(
            'number',
            'navigationTop',
            ['scope' => Shopware\Models\Config\Element::SCOPE_SHOP, 'label' => 'Shopnavigation Abstand nach oben', 'value' => '0', 'description' => 'Gebe den Abstand der Shopnavigation nach oben an.']
        );

        $form->setElement(
            'number',
            'minimalNavigationTop',
            ['scope' => Shopware\Models\Config\Element::SCOPE_SHOP, 'label' => 'Shopnavigation Checkout Abstand nach oben', 'value' => '0', 'description' => 'Gebe den Abstand der Shopnavigation nach oben an für den minimalen Checkout.']
        );

        $form->setElement(
            'boolean',
            'center',
            [ 'scope' => Shopware\Models\Config\Element::SCOPE_SHOP, 'label' => 'Logo mobil zentrieren', 'value' => true, 'description' => 'Soll das Logo in der mobilen Ansicht zentriert werden?']
        );

    }


    public function addLessFiles(Enlight_Event_EventArgs $args)
    {
        $less = new \Shopware\Components\Theme\LessDefinition(
        //configuration
            array(
                'center' => $this->Config()->get('center'),
                'height' => $this->Config()->get('number'),
                'marginTop' => $this->Config()->get('marginTop'),
                'marginBottom' => $this->Config()->get('marginBottom'),
                'navigationTop' => $this->Config()->get('navigationTop'),
                'minimalMarginTop' => $this->Config()->get('minimalMarginTop'),
                'minimalMarginBottom' => $this->Config()->get('minimalMarginBottom'),
                'minimalNavigationTop' => $this->Config()->get('minimalNavigationTop'),
                'minimalLogoHeight' => $this->Config()->get('minimalLogoHeight')
            ),
            //less files to compile
            array(
                __DIR__ . '/Views/frontend/_public/src/less/all.less'
            ),

            //import directory
            __DIR__
        );

        return new Doctrine\Common\Collections\ArrayCollection(array($less));
    }
}
