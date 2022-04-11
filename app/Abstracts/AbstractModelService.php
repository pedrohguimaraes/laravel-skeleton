<?php

namespace App\Abstracts;


use App\Contracts\ModelRepositoryContract;
use App\Exceptions\Etc\UndefinedMethodException;

abstract class AbstractModelService
{
    /**
     * Eloquent model
     *
     * @var ModelRepositoryContract
     */
    protected $repository;

    /**
     * Lista de metodos do repositoty
     *
     * @var array
     */
    protected $repositoryHooks = [
        'all',
        'find',
        'create',
        'update',
        'delete',
        'refresh'
    ];

    /**
     * Construtor da classe
     *
     * @param ModelRepositoryContract $repository
     */
    public function __construct(ModelRepositoryContract $repository)
    {
        $this->repository = $repository;
        $this->changeRepositoryHooks();
    }

    /**
     * Altera o valor default da lista de funções usadas do repository
     */
    protected function changeRepositoryHooks() : void {}


    /**
     * Construtor da classe
     */
    public function __call($method, $arguments)
    {
        dd('12');
        if(in_array($method, $this->repositoryHooks))
        {
            return call_user_func_array([$this->repository, $method], $arguments);
        } else {
            throw new UndefinedMethodException(self::class, $method);
        }
    }
}
