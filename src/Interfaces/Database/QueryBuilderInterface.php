<?php namespace Ambitia\Interfaces\Database;


interface QueryBuilderInterface extends PaginatorInterface
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
     * @return QueryBuilderInterface
     */
    public function select($columns = '*'): QueryBuilderInterface;

    /**
     * Choose table to which the query is targeting
     *
     * @param string $table
     * @param string|null $alias
     * @return QueryBuilderInterface
     */
    public function from(string $table, string $alias = null): QueryBuilderInterface;

    /**
     * Join other table to the query
     *
     * @param string $table
     * @param string $conditions String of conditions of joining the tables:
     * 'table1.column1 = table2.column2 AND table1.column2 > table2.column4'
     * @param string $type
     * @return QueryBuilderInterface
     */
    public function join(string $table, string $conditions, string $type = self::JOIN_INNER): QueryBuilderInterface;

    /**
     * Add simple where part of the query.
     *
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @param string $sign
     * @return QueryBuilderInterface
     */
    public function where(string $column, string $operator, $value, string $sign = self::SIGN_AND): QueryBuilderInterface;

    /**
     * Where in query part
     *
     * @param string $column
     * @param array $value
     * @param string $sign
     * @return QueryBuilderInterface
     */
    public function whereIn(string $column, array $value, string $sign = self::SIGN_AND): QueryBuilderInterface;

    /**
     * Add nested where part of the query. For example:
     * function(QueryBuilder $query) use ($user, $user2) {
     *      $query->where('user', '=', $user)
     *          ->orWhere('user', '=', $user2)
     * }
     *
     * @param \Closure $callback
     * @param string $sign
     * @return QueryBuilderInterface
     */
    public function whereNested(\Closure $callback, $sign = self::SIGN_AND): QueryBuilderInterface;

    /**
     * Add where column IS NULL|IS NOT NULL part of the query
     *
     * @param string $column
     * @param string $sign
     * @param bool $not
     * @return QueryBuilderInterface
     */
    public function whereNull(string $column, string $sign = self::SIGN_AND, bool $not = false): QueryBuilderInterface;

    /**
     * Add where column IS NOT NULL part of the query
     *
     * @param string $column
     * @param string $sign
     * @return QueryBuilderInterface
     */
    public function whereNotNull(string $column, string $sign = self::SIGN_AND): QueryBuilderInterface;

    /**
     * Add group by part of the query
     *
     * @param mixed $groups
     * @return QueryBuilderInterface
     */
    public function groupBy($groups): QueryBuilderInterface;

    /**
     * Add having part of the query
     *
     * @param string $column
     * @param string $operator
     * @param $value
     * @param string $sign
     * @return QueryBuilderInterface
     */
    public function having(string $column, string $operator, $value, $sign = self::SIGN_AND): QueryBuilderInterface;

    /**
     * Add order by part of the query. Use multiple times for sorting by many fields
     *
     * @param string $column
     * @param string $direction
     * @return QueryBuilderInterface
     */
    public function orderBy(string $column, $direction = self::DIRECTION_ASC): QueryBuilderInterface;

    /**
     * Limit the query results to number of records
     *
     * @param int $value
     * @return QueryBuilderInterface
     */
    public function limit(int $value): QueryBuilderInterface;

    /**
     * Skip first number of results of the query
     *
     * @param int $value
     * @return QueryBuilderInterface
     */
    public function offset(int $value): QueryBuilderInterface;

    /**
     * Add a union part of the query
     *
     * @param QueryBuilderInterface $query
     * @param bool $all
     * @return QueryBuilderInterface
     */
    public function union(QueryBuilderInterface $query, bool $all = false): QueryBuilderInterface;

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