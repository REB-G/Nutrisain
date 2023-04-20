<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;

class TwigListFilterExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new \Twig\TwigFilter('list', [$this, 'listFilter']),
        ];
    }

    public function listFilter($text)
    {
        $lines = explode("\n", $text);
        $listItems = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line)) {
                $listItems[] = '<li>' . $line . '</li>';
            }
        }

        return '<ul>' . implode('', $listItems) . '</ul>';
    }
}

