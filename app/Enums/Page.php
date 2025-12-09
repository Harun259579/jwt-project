<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Page extends Enum
{
    const HomePage = 'home_page';
    const ServicePage = 'service_page';
    const BlogPage = 'blog_page';
}
