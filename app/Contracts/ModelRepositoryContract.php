<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface ModelRepositoryContract
{
    /**
     * Retorna a instância de model do repositório
     *
     * @return Model
     */
    public function getModel();

    /**
     * Retorna uma instâcia de querybuilder parametrizada para a tabela do modelo
     *
     * @return Builder
     */
    public function getQuery() : Builder;

    /**
     * Recupera todos os registros no banco, podendo receber como parâmetros as colunas que devem ser exibidas e uma callback
     * para manipular a instância do query builder.
     *
     * @param array $colunas Array com nome das colunas a serem recuperadas.
     * @param array $callback Callback que recebe uma instância de Illuminate\Database\Eloquent\Builder como argumento.
     * @return Collection
     */
    public function all(array $colunas = ['*'], callable $callback = null);

    /**
     * Recupera um registro específico
     *
     * @param integer $id Identificador do registro a ser buscado
     * @param boolean $fail Determina se será lançada HttpNotFoundException caso o registro não seja encontrado
     * @param array $colunas Array com nome das colunas a serem recuperadas.
     * @param callable $callback Callback que recebe uma instância de Illuminate\Database\Eloquent\Builder como argumento.
     * @return Model
     */
    public function find(int $id, bool $fail = false, array $colunas = ['*'], callable $callback = null);

    /**
     * Persiste novo registro no banco de dados.
     *
     * @param array $dados Array com os dados a serem persistidos
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $dados);

    /**
     * Atualiza registro no banco de dados.
     *
     * @param array $dados Dados a serem persistidos.
     * @param Illuminate\Database\Eloquent\Model $model Instância do Model da
     * @return Model
     */
    public function update(array $dados, Model $model);

    /**
     * Exclui um registro no banco de dados.
     *
     * @param Model $model Instância do Model da
     * @return array Retorna um array vazio
     */
    public function delete(Model $model);

    /**
     * Retorna o modelo com informações atualizadas.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     * @return Model
     */
    public function refresh(Model $model);
}