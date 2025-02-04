<?php
namespace App\Twig;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

#[AsTaggedItem('twig.extension')]
class AppContextExtension extends AbstractExtension implements GlobalsInterface
{
    public function getGlobals(): array
    {
        return [
            'currentYear' => date('Y'),
        ];
    }
}