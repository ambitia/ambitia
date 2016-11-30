<?php namespace Ambitia\Database\SQL;

use Ambitia\Contracts\Database\QueryBuilder;
use Ambitia\Database\SQL\Exceptions\InvalidJoinException;
use Ambitia\Database\SQL\Exceptions\InvalidOrderDirectionException;
use Ambitia\Database\SQL\Exceptions\UnsupportedJoinException;
use Doctrine\DBAL\Query\QueryBuilder as DoctrineQueryBuilder;

class SQLBuilder implements QueryBuilder
{
    /**
     * @var DoctrineQueryBuilder
     */
    protected $builder;

    /**
     * @var ['query' => SQLBuilder, 'all' => bool]
     */
    protected $unions = [];

    /**
     * Initialize new query builder.
     *
     * @param DoctrineQueryBuilder $builder
     */
    public function __construct(DoctrineQueryBuilder $builder)
    {
        $this->builder = $builder;
        $this->builder->select('*');
    }

    /**
     * @inheritDoc
     */
    public function select(array $columns = ['*']): QueryBuilder
    {
        $this->builder->select(...$columns);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function from(string $table, string $alias = null): QueryBuilder
    {
        $this->builder->from($table, $alias);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function join(string $table, string $condition, string $type = self::JOIN_INNER): QueryBuilder
    {
        $name = explode(' ', $table);
        $alias = !empty($name[1]) ? $name[1] : substr($table, 0, 2);

        $from = $this->builder->getQueryPart('from');

        if (empty($from[0])) {
            throw new InvalidJoinException();
        }

        $joinType = $this->chooseJoinType($type);
        $this->builder->{$joinType}($from[0]['alias'], $name[0], $alias, $condition);

        return $this;
    }

    /**
     * Choose join type
     *
     * @param string $type
     * @return string
     * @throws \Exception
     */
    protected function chooseJoinType($type = self::JOIN_INNER): string
    {
        switch ($type) {
            case self::JOIN_LEFT:
                return 'leftJoin';
            case self::JOIN_RIGHT:
                return 'rightJoin';
            case self::JOIN_CROSS:
            case self::JOIN_FULL:
                throw new UnsupportedJoinException();
            case self::JOIN_INNER:
            default:
                return 'innerJoin';
        }
    }

    /**
     * @inheritDoc
     */
    public function where(string $column, string $operator, $value, string $sign = self::SIGN_AND): QueryBuilder
    {
        if (is_array($value)) {
            return $this->whereIn($column, $value, $sign);
        }

        $type = $this->chooseWhereSign($sign);
        $placeholder = $this->builder->createNamedParameter($value);
        $this->builder->{$type}(sprintf('%s %s %s', $column, $operator, $placeholder));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function whereIn(string $column, array $value, string $sign = self::SIGN_AND): QueryBuilder
    {
        $type = $this->chooseWhereSign($sign);

        $placeholders = [];
        foreach ($value as $v) {
            $paramType = is_numeric($v) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
            $placeholders[] = $this->builder->createNamedParameter($v, $paramType);
        }

        $this->builder->{$type}(sprintf('%s IN (%s)', $column, implode(',', $placeholders)));

        return $this;
    }

    /**
     * Get method name used by doctrine for where sign (AND | OR)
     *
     * @param string $sign
     * @return string
     */
    protected function chooseWhereSign(string $sign): string
    {
        switch ($sign) {
            case self::SIGN_OR:
                return 'orWhere';
            case self::SIGN_AND:
            default:
                return 'andWhere';
        }
    }

    /**
     * @inheritDoc
     */
    public function whereNested(\Closure $callback, $sign = self::SIGN_AND): QueryBuilder
    {
        $type = $this->chooseWhereSign($sign);
        $query = $this->cloneQueryBuilder();

        $callback($query);

        $nestedWhere = $query->builder->getQueryPart('where');
        $bindings = $query->builder->getParameters();

        $this->builder->{$type}($nestedWhere);

        foreach ($bindings as $key => $value) {
            $this->builder->setParameter($key, $value);
        }

        return $this;
    }

    /**
     * Clone query builder for nested parts of the query
     *
     * @return SQLBuilder
     */
    protected function cloneQueryBuilder(): SQLBuilder
    {
        $query = clone $this;
        $query->builder = clone $this->builder;
        $query->builder->resetQueryParts();

        return $query;
    }

    /**
     * @inheritDoc
     */
    public function whereNull(string $column, string $sign = self::SIGN_AND, bool $not = false): QueryBuilder
    {
        $type = $this->chooseWhereSign($sign);
        $this->builder->{$type}(sprintf('%s IS %s', $column, $not ? 'NOT NULL' : 'NULL'));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function whereNotNull(string $column, string $sign = self::SIGN_AND): QueryBuilder
    {
        $this->whereNull($column, $sign, true);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function groupBy($groups): QueryBuilder
    {
        $this->builder->groupBy((array) $groups);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function having(string $column, string $operator, $value, $sign = self::SIGN_AND): QueryBuilder
    {
        $this->builder->having(sprintf('%s %s %s', $column, $operator, $value));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function orderBy(string $column, $direction = self::DIRECTION_ASC): QueryBuilder
    {
        $direction = strtoupper($direction);
        if (!in_array($direction, [self::DIRECTION_ASC, self::DIRECTION_DESC])) {
            throw new InvalidOrderDirectionException($direction);
        }

        $this->builder->addOrderBy($column, $direction);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function limit(int $value): QueryBuilder
    {
        $this->builder->setMaxResults($value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function offset(int $value): QueryBuilder
    {
        $this->builder->setFirstResult($value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function union(QueryBuilder $query, bool $all = false): QueryBuilder
    {
        $this->unions[] = compact('query', 'all');

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toSql($bindPlaceholders = true): string
    {
        $query = $this->builder->getSQL();
        if (!$bindPlaceholders) {
            return $query;
        }

        $query = $this->replaceBindings($query);

        return $this->applyUnions($query, $bindPlaceholders);
    }

    /**
     * Replace named (:bind) and positional (?) bindings in the query
     *
     * @param string $query
     * @return string
     */
    protected function replaceBindings(string $query): string
    {
        $bindings = $this->builder->getParameters();
        $numeric = [];

        foreach ($bindings as $index => $binding) {
            if (is_numeric($index)) {
                $numeric[] = $binding;
                continue;
            }

            $query = str_replace(':'.$index, $binding, $query);
        }

        return $this->replaceNumericBindinds($query, $numeric);
    }

    /**
     * Replace positional (?) bindinds in the query
     *
     * @param string $query
     * @param array $numeric
     * @return string
     */
    protected function replaceNumericBindinds(string $query, array $numeric): string
    {
        foreach ($numeric as $binding) {
            $query = preg_replace('/\?/', $binding, $query, 1);
        }

        return $query;
    }

    /**
     * Apply unions to sql
     *
     * @param string $query
     * @param bool $bindPlaceholders
     * @return string
     */
    protected function applyUnions(string $query, $bindPlaceholders = true): string
    {
        foreach ($this->unions as $union) {
            /** @var SQLBuilder $uQuery */
            $uQuery = $union['query'];
            $uQuery = $uQuery->toSql($bindPlaceholders);
            $union = $union['all'] ? 'UNION ALL' : 'UNION';
            $query .= sprintf(' %s %s', $union, $uQuery);
        }

        return $query;
    }

    /**
     * Get all bindings, from base query and all unions.
     *
     * @return array
     */
    protected function allBindings(): array
    {
        $params = $this->builder->getParameters();

        foreach ($this->unions as $union) {
            /** @var SQLBuilder $uQuery */
            $uQuery = $union['query'];
            $params = array_merge($params, $uQuery->builder->getParameters());
        }

        return $params;
    }

    /**
     * @inheritDoc
     */
    public function get(int $fetchMode = \PDO::FETCH_ASSOC)
    {
        $connection = $this->builder->getConnection();
        $connection->setFetchMode($fetchMode);

        $sql = $this->toSql(false);
        $bindings = $this->allBindings();

        return $connection->fetchAll($sql, $bindings);
    }
}