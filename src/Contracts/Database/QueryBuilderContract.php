<?php namespace Ambitia\Contracts\Database;


interface QueryBuilderContract extends PaginatorContract
{
    const JOIN_INNER = 'inner';
    const JOIN_LEFT = 'left';
    const JOIN_RIGHT = 'right';
    const JOIN_FULL = 'full';
    const JOIN_CROSS = 'cross';

    const DIRECTION_ASC = 'ASC';
    const DIRECTION_DESC = 'DESC';

    const SIGN_AND = 'AND';
    const SIGN_OR = 'OR';

    const OPERATOR_EQUAL = '=';
    const OPERATOR_IN = 'IN';

    /**
     * Choose which columns to pull from database table.
     * If key of the array is not numeric, it should be used as an alias of the column.
     *
     * @param mixed $columns
     * @return QueryBuilderContract
     */
    public function select($columns = '*'): QueryBuilderContract;

    /**
     * Choose table to which the query is targeting
     *
     * @param string $table
     * @param string|null $alias
     * @return QueryBuilderContract
     */
    public function from(string $table, string $alias = null): QueryBuilderContract;

    /**
     * Join other table to the query
     *
     * @param string $table
     * @param string $conditions String of conditions of joining the tables:
     * 'table1.column1 = table2.column2 AND table1.column2 > table2.column4'
     * @param string $type
     * @return QueryBuilderContract
     */
    public function join(string $table, string $conditions, string $type = self::JOIN_INNER): QueryBuilderContract;

    /**
     * Add simple where part of the query.
     *
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @param string $sign
     * @return QueryBuilderContract
     */
    public function where(string $column, string $operator, $value, string $sign = self::SIGN_AND): QueryBuilderContract;

    /**
     * Where in query part
     *
     * @param string $column
     * @param array $value
     * @param string $sign
     * @return QueryBuilderContract
     */
    public function whereIn(string $column, array $value, string $sign = self::SIGN_AND): QueryBuilderContract;

    /**
     * Add nested where part of the query. For example:
     * function(QueryBuilder $query) use ($user, $user2) {
     *      $query->where('user', '=', $user)
     *          ->orWhere('user', '=', $user2)
     * }
     *
     * @param \Closure $callback
     * @param string $sign
     * @return QueryBuilderContract
     */
    public function whereNested(\Closure $callback, $sign = self::SIGN_AND): QueryBuilderContract;

    /**
     * Add where column IS NULL|IS NOT NULL part of the query
     *
     * @param string $column
     * @param string $sign
     * @param bool $not
     * @return QueryBuilderContract
     */
    public function whereNull(string $column, string $sign = self::SIGN_AND, bool $not = false): QueryBuilderContract;

    /**
     * Add where column IS NOT NULL part of the query
     *
     * @param string $column
     * @param string $sign
     * @return QueryBuilderContract
     */
    public function whereNotNull(string $column, string $sign = self::SIGN_AND): QueryBuilderContract;

    /**
     * Add group by part of the query
     *
     * @param mixed $groups
     * @return QueryBuilderContract
     */
    public function groupBy($groups): QueryBuilderContract;

    /**
     * Add having part of the query
     *
     * @param string $column
     * @param string $operator
     * @param $value
     * @param string $sign
     * @return QueryBuilderContract
     */
    public function having(string $column, string $operator, $value, $sign = self::SIGN_AND): QueryBuilderContract;

    /**
     * Add order by part of the query. Use multiple times for sorting by many fields
     *
     * @param string $column
     * @param string $direction
     * @return QueryBuilderContract
     */
    public function orderBy(string $column, $direction = self::DIRECTION_ASC): QueryBuilderContract;

    /**
     * Limit the query results to number of records
     *
     * @param int $value
     * @return QueryBuilderContract
     */
    public function limit(int $value): QueryBuilderContract;

    /**
     * Skip first number of results of the query
     *
     * @param int $value
     * @return QueryBuilderContract
     */
    public function offset(int $value): QueryBuilderContract;

    /**
     * Add a union part of the query
     *
     * @param QueryBuilderContract $query
     * @param bool $all
     * @return QueryBuilderContract
     */
    public function union(QueryBuilderContract $query, bool $all = false): QueryBuilderContract;

    /**
     * Dump query builder to sql string and replace placeholders with bindings
     *
     * @param bool $bindPlaceholders
     * @return string
     */
    public function toSql($bindPlaceholders = true): string;

    /**
     * Run the query. If $dataModelClass is passed, method project() will be invoked instead, to map query
     * results onto an instance of a given class. Otherwise will return data formatted by PDO::fetchMode.
     *
     * @param string $dataModelClass
     * @param int $fetchMode
     * @return mixed
     */
    public function get(string $dataModelClass = null, int $fetchMode = \PDO::FETCH_ASSOC);

    /**
     * Run the query and return first record that it match by the given conditions.
     * If $dataModelClass is passed, method project() will be invoked instead, to map query
     * results onto an instance of a given class. Otherwise will return data formatted by PDO::fetchMode.
     *
     * Returns null when no record is found.
     *
     * @param string $dataModelClass
     * @param int $fetchMode
     * @return mixed|null
     */
    public function first(string $dataModelClass = null, int $fetchMode = \PDO::FETCH_ASSOC);

    /**
     * Project data rows onto model class. When possible it will try to use camel cased setter
     * methods, and if not found, will try to assign onto object properties
     *
     * @param string $dataModelClass
     * @return mixed
     */
    public function project(string $dataModelClass);
}