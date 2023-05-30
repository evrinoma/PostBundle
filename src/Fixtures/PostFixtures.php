<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\PostBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Entity\Post\BasePost;
use Evrinoma\TestUtilsBundle\Fixtures\AbstractFixture;

class PostFixtures extends AbstractFixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    protected static array $data = [
        0 => [
            PostApiDtoInterface::TITLE => '3601',
            'created_at' => '2008-10-23 10:21:50',
        ],
        1 => [
            PostApiDtoInterface::TITLE => '3602',
            'created_at' => '2015-10-23 10:21:50',
        ],
        2 => [
            PostApiDtoInterface::TITLE => '3603',
            'created_at' => '2020-10-23 10:21:50',
        ],
        3 => [
            PostApiDtoInterface::TITLE => '3604',
            'created_at' => '2020-10-23 10:21:50',
        ],
        4 => [
            PostApiDtoInterface::TITLE => '3605',
            'created_at' => '2015-10-23 10:21:50',
        ],
        5 => [
            PostApiDtoInterface::TITLE => '3606',
            'created_at' => '2010-10-23 10:21:50',
        ],
        6 => [
            PostApiDtoInterface::TITLE => '3607',
            'created_at' => '2010-10-23 10:21:50',
        ],
        7 => [
            PostApiDtoInterface::TITLE => '3608',
            'created_at' => '2011-10-23 10:21:50',
        ],
    ];

    protected static string $class = BasePost::class;

    /**
     * @param ObjectManager $manager
     *
     * @return $this
     *
     * @throws \Exception
     */
    protected function create(ObjectManager $manager): self
    {
        $short = static::getReferenceName();
        $i = 0;

        foreach ($this->getData() as $record) {
            /** @var BasePost $entity */
            $entity = $this->getEntity();
            $entity
                ->setTitle($record[PostApiDtoInterface::TITLE])
                ->setCreatedAt(new \DateTimeImmutable($record['created_at']));

            $this->expandEntity($entity, $record);

            $this->addReference($short.$i, $entity);
            $manager->persist($entity);
            $i++;
        }

        return $this;
    }

    public static function getGroups(): array
    {
        return [
            FixtureInterface::POST_FIXTURES,
        ];
    }

    public function getOrder()
    {
        return 0;
    }
}
