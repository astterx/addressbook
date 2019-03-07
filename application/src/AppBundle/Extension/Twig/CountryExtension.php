<?php

namespace AppBundle\Extension\Twig;

use Symfony\Component\Intl\Intl;
use Symfony\Component\Intl\Locale;

class CountryExtension extends \Twig_Extension
{
    public function getFilters(): array
    {
        return array(
            new \Twig_SimpleFilter("country", array($this, "countryFilter")),
        );
    }

    public function countryFilter($countryCode, $locale = "en"): string
    {
        Locale::setDefault($locale);
        $countryName = "";
        if ($countryCode) {
            $countryName = Intl::getRegionBundle()->getCountryName($countryCode);
        }

        return $countryName ?: $countryCode;
    }
    public function getName(): string 
    {
        return "country_twig_extension";
    }
}
