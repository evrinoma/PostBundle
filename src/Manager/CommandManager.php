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

namespace Evrinoma\PostBundle\Manager;

use Evrinoma\PostBundle\Dto\PostApiDtoInterface;
use Evrinoma\PostBundle\Exception\PostCannotBeCreatedException;
use Evrinoma\PostBundle\Exception\PostCannotBeRemovedException;
use Evrinoma\PostBundle\Exception\PostCannotBeSavedException;
use Evrinoma\PostBundle\Exception\PostInvalidException;
use Evrinoma\PostBundle\Exception\PostNotFoundException;
use Evrinoma\PostBundle\Factory\Post\FactoryInterface;
use Evrinoma\PostBundle\Mediator\CommandMediatorInterface;
use Evrinoma\PostBundle\Model\Post\PostInterface;
use Evrinoma\PostBundle\Repository\Post\PostRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private PostRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private FactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface       $validator
     * @param PostRepositoryInterface  $repository
     * @param FactoryInterface         $factory
     * @param CommandMediatorInterface $mediator
     */
    public function __construct(ValidatorInterface $validator, PostRepositoryInterface $repository, FactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param PostApiDtoInterface $dto
     *
     * @return PostInterface
     *
     * @throws PostInvalidException
     * @throws PostCannotBeCreatedException
     * @throws PostCannotBeSavedException
     */
    public function post(PostApiDtoInterface $dto): PostInterface
    {
        $post = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $post);

        $errors = $this->validator->validate($post);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new PostInvalidException($errorsString);
        }

        $this->repository->save($post);

        return $post;
    }

    /**
     * @param PostApiDtoInterface $dto
     *
     * @return PostInterface
     *
     * @throws PostInvalidException
     * @throws PostNotFoundException
     * @throws PostCannotBeSavedException
     */
    public function put(PostApiDtoInterface $dto): PostInterface
    {
        try {
            $post = $this->repository->find($dto->idToString());
        } catch (PostNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $post);

        $errors = $this->validator->validate($post);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new PostInvalidException($errorsString);
        }

        $this->repository->save($post);

        return $post;
    }

    /**
     * @param PostApiDtoInterface $dto
     *
     * @throws PostCannotBeRemovedException
     * @throws PostNotFoundException
     */
    public function delete(PostApiDtoInterface $dto): void
    {
        try {
            $post = $this->repository->find($dto->idToString());
        } catch (PostNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $post);
        try {
            $this->repository->remove($post);
        } catch (PostCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
