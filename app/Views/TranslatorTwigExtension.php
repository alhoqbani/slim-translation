<?php

namespace App\Views;

use Symfony\Component\Translation\Translator;

class TranslatorTwigExtension extends \Twig_Extension
{
    
    /**
     * @var \Symfony\Component\Translation\Translator
     */
    private $translator;
    
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }
    
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('trans', [$this, 'trans']),
            new \Twig_SimpleFunction('trans_choice', [$this, 'transChoice']),
        ];
    }
    
    public function trans($id, array $parameters = [], $domain = null, $locale = null)
    {
        return $this->translator->trans($id, $parameters, $domain, $locale);
    }
    
    public function transChoice($id, $number, array $parameters = [], $domain = null, $locale = null)
    {
        return $this->translator->transChoice($id, $number, $parameters, $domain, $locale);
    }
}
