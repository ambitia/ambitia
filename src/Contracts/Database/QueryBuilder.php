<?php namespace Ambitia\Contracts\Database;


interface QueryBuilder
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
     * @param array $columns
     * @return QueryBuilder
     */
    public function select(array $columns = ['*']): QueryBuilder;

    /**
     * Choose table to which the query is targeting
     *
     * @param string $table
     * @param string|null $alias
     * @return QueryBuilder
     */
    public function from(string $table, string $alias = null): QueryBuilder;

    /**
     * Join other table to the query
     *
     * @param string $table
     * @param string $conditions String of conditions of joining the tables:
     * 'table1.column1 = table2.column2 AND table1.column2 > table2.column4'
     * @param string $type
     * @return QueryBuilder
     */
    public function join(string $table, string $conditions, string $type = self::JOIN_INNER): QueryBuilder;

    /**
     * Add simple where part of the query.
     *
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @param string $sign
     * @return QueryBuilder
     */
    public function where(string $column, string $operator, $value, string $sign = self::SIGN_AND): QueryBuilder;

    /**
     * Where in query part
     *
     * @param string $column
     * @param array $value
     * @param string $sign
     * @return QueryBuilder
     */
    public function whereIn(string $column, array $value, string $sign = self::SIGN_AND): QueryBuilder;

    /**
     * Add nested where part of the query. For example:
     * function(QueryBuilder $query) use ($user, $user2) {
     *      $query->where('user', '=', $user)
     *          ->orWhere('user', '=', $user2)
     * }
     *
     * @param \Closure $callback
     * @param string $sign
     * @return QueryBuilder
     */
    public function whereNested(\Closure $callback, $sign = self::SIGN_AND): QueryBuilder;

    /**
     * Add where column IS NULL|IS NOT NULL part of the query
     *
     * @param string $column
     * @param string $sign
     * @param bool $not
     * @return QueryBuilder
     */
    public function whereNull(string $column, string $sign = self::SIGN_AND, bool $not = false): QueryBuilder;

    /**
     * Add where column IS NOT NULL part of the query
     *
     * @param string $column
     * @param string $sign
     * @return QueryBuilder
     */
    public function whereNotNull(string $column, string $sign = self::SIGN_AND): QueryBuilder;

    /**
     * Add group by part of the query
     *
     * @param mixed $groups
     * @return QueryBuilder
     */
    public function groupBy($groups): QueryBuilder;

    /**
     * Add having part of the query
     *
     * @param string $column
     * @param string $operator
     * @param $value
     * @param string $sign
     * @return QueryBuilder
     */
    public function having(string $column, string $operator, $value, $sign = self::SIGN_AND): QueryBuilder;

    /**
     * Add order by part of the query. Use multiple times for sorting by many fields
     *
     * @param string $column
     * @param string $direction
     * @return QueryBuilder
     */
    public function orderBy(string $column, $direction = self::DIRECTION_ASC): QueryBuilder;

    /**
     * Limit the query results to number of records
     *
     * @param int $value
     * @return QueryBuilder
     */
    public function limit(int $value): QueryBuilder;

    /**
     * Skip first number of results of the query
     *
     * @param int $value
     * @return QueryBuilder
     */
    public function offset(int $value): QueryBuilder;

    /**
     * Add a union part of the query
     *
     * @param QueryBuilder $query
     * @param bool $all
     * @return QueryBuilder
     */
    public function union(QueryBuilder $query, bool $all = false): QueryBuilder;

    /**
     * Dump query builder to sql string and replace placeholders with bindings
     *
     * @param bool $bindPlaceholders
     * @return string
     */
    public function toSql($bindPlaceholders = true): string;
}