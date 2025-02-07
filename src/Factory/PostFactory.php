<?php

namespace App\Factory;

use App\Entity\Post;
use Random\RandomException;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Post>
 */
final class PostFactory extends PersistentProxyObjectFactory
{
    private static $content;
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
        self::$content = self::faker()->sentences(15, true);
    }

    public static function class(): string
    {
        return Post::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     * @throws RandomException
     */
    protected function defaults(): array|callable
    {
        $createdAt = self::faker()->dateTimeBetween('-18 months', 'now');

        return [
            'content' => self::$content,
            'createdAt' => $createdAt,
            'title' => self::faker()->unique()->sentence(),
            'updatedAt' => $this->getRandomDate($createdAt, 60),
            'author' => UserFactory::random(),
            'theme' => PostThemeFactory::random(),
            'publishedAt' => $this->getRandomDate($createdAt, 20),
        ];
    }

    /**
     * @throws RandomException
     */
    private function getRandomDate(
        \DateTime $startDate,
        int $percentOfNull) : \DateTime|null
    {
        if(random_int(1,100) > $percentOfNull){
            return self::faker()->dateTimeBetween($startDate, 'now');
        }

        return null;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Post $post): void {})
        ;
    }
}
