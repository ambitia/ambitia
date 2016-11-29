<?php

namespace spec\Ambitia\Database\SQL;

use Ambitia\Contracts\Database\QueryBuilder;
use Ambitia\Database\SQL\SQLBuilder;
use Ambitia\Database\SQL\Exceptions\InvalidJoinException;
use Ambitia\Database\SQL\Exceptions\UnsupportedJoinException;
use Doctrine\DBAL\DriverManager;
use PhpSpec\ObjectBehavior;

class SQLBuilderSpec extends ObjectBehavior
{
    function let()
    {
        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite'
        ]);
        $this->beConstructedWith(
            new \Doctrine\DBAL\Query\QueryBuilder($connection)
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SQLBuilder::class);
        $this->shouldImplement(QueryBuilder::class);
    }

    function it_should_return_sql_string()
    {
        $this->select()
            ->toSql()
            ->shouldReturn('SELECT *');
    }

    function it_should_allow_for_selection_of_specific_columns()
    {
        $this->select(['id', 'name'])
            ->toSql()
            ->shouldReturn('SELECT id, name');
    }

    function it_should_allow_setting_up_from_clause()
    {
        $this->select()->from('user')->toSql()->shouldReturn('SELECT * FROM user');
        $this->from('product', 'p')->toSql()->shouldReturn('SELECT * FROM user, product p');
        $this->from('test t')->toSql()->shouldReturn('SELECT * FROM user, product p, test t');
        $this->from('test2 AS t2')->toSql()->shouldReturn('SELECT * FROM user, product p, test t, test2 AS t2');
    }

    function it_should_join_tables()
    {
        $this->select()->from('user', 'u')
            ->join('product p', 'p.user_id = u.id')
            ->toSql()
            ->shouldReturn('SELECT * FROM user u INNER JOIN product p ON p.user_id = u.id');

        $this->join('company c', 'c.id = p.company_id', QueryBuilder::JOIN_LEFT)
            ->toSql()
            ->shouldReturn('SELECT * FROM user u INNER JOIN product p ON p.user_id = u.id LEFT JOIN company c ON c.id = p.company_id');

        $this->join('company c2', 'c2.id = p.company_id', QueryBuilder::JOIN_RIGHT)
            ->toSql()
            ->shouldReturn('SELECT * FROM user u INNER JOIN product p ON p.user_id = u.id LEFT JOIN company c ON c.id = p.company_id RIGHT JOIN company c2 ON c2.id = p.company_id');
    }

    function it_should_throw_exceptions_on_invalid_joins()
    {
        $this->shouldThrow(InvalidJoinException::class)
            ->during('join', ['user u', 'u.id = 1']);

        $this->from('table', 't');
        $this->shouldThrow(UnsupportedJoinException::class)
            ->during('join', ['user u', 'u.id = 1', QueryBuilder::JOIN_CROSS]);

        $this->shouldThrow(UnsupportedJoinException::class)
            ->during('join', ['user u', 'u.id = 1', QueryBuilder::JOIN_FULL]);
    }

    function it_should_allow_simple_where_conditions()
    {
        $this->from('table', 't')
            ->select()
            ->where('t.col1', '=', 1)
            ->where('t.col2', '>', 'cosmos', QueryBuilder::SIGN_OR)
            ->toSql(false)
            ->shouldReturn('SELECT * FROM table t WHERE (t.col1 = ?) OR (t.col2 > ?)');

        $this->toSql()
            ->shouldReturn('SELECT * FROM table t WHERE (t.col1 = 1) OR (t.col2 > cosmos)');
    }

    function it_should_allow_where_in_clause_with_array()
    {
        $a = 1;
        $b = 2;

        $this->from('table', 't')
            ->select()
            ->where('t.col1', 'IN', [0, 1, 2])
            ->where('t.col2', 'IN', compact('a', 'b'))
            ->toSql(false)
            ->shouldReturn('SELECT * FROM table t WHERE (t.col1 IN (?,?,?)) AND (t.col2 IN (?,?))');

        $this->toSql(true)
            ->shouldReturn('SELECT * FROM table t WHERE (t.col1 IN (0,1,2)) AND (t.col2 IN (1,2))');
    }

    function it_should_allow_null_condition()
    {
        $this->from('table', 't')
            ->select()
            ->whereNull('t.col2')
            ->toSql()
            ->shouldReturn('SELECT * FROM table t WHERE t.col2 IS NULL');
    }

    function it_should_allow_not_null_condition()
    {
        $this->from('table', 't')
            ->select()
            ->whereNotNull('t.col2')
            ->toSql()
            ->shouldReturn('SELECT * FROM table t WHERE t.col2 IS NOT NULL');
    }

    function it_should_allow_group_queries()
    {
        $this->from('table', 't')
            ->select(['name', 'SUM(apples) as apple_count'])
            ->groupBy('name')
            ->where('name', 'LIKE', '%a%')
            ->toSql()
            ->shouldReturn('SELECT name, SUM(apples) as apple_count FROM table t WHERE name LIKE %a% GROUP BY name');
    }

    function it_should_sort_columns_by_directions()
    {
        $this->from('table', 't')
            ->select()
            ->orderBy('name', QueryBuilder::DIRECTION_ASC)
            ->toSql()
            ->shouldReturn('SELECT * FROM table t ORDER BY name ASC');
    }

    function it_should_sort_multiple_columns_by_directions()
    {
        $this->from('table', 't')
            ->select()
            ->orderBy('name', QueryBuilder::DIRECTION_ASC)
            ->orderBy('id', QueryBuilder::DIRECTION_DESC)
            ->toSql()
            ->shouldReturn('SELECT * FROM table t ORDER BY name ASC, id DESC');
    }

    function it_should_limit_query_results()
    {
        $this->from('table', 't')
            ->select()
            ->limit(10)
            ->toSql()
            ->shouldReturn('SELECT * FROM table t LIMIT 10');
    }

    function it_should_offset_limit_query_results()
    {
        $this->from('table', 't')
            ->select()
            ->limit(10)
            ->offset(10)
            ->toSql()
            ->shouldReturn('SELECT * FROM table t LIMIT 10 OFFSET 10');
    }

    function it_should_be_possible_to_add_having_clause()
    {
        $this->from('Orders', 'o')
            ->select(['Employees.LastName', 'COUNT(Orders.OrderID) AS NumberOfOrders'])
            ->join('Employees e', 'Orders.EmployeeID = Employees.EmployeeID')
            ->groupBy('LastName')
            ->having('COUNT(Orders.OrderID)', '>', 10)
            ->toSql()
            ->shouldReturn('SELECT Employees.LastName, COUNT(Orders.OrderID) AS NumberOfOrders FROM Orders o INNER JOIN Employees e ON Orders.EmployeeID = Employees.EmployeeID GROUP BY LastName HAVING COUNT(Orders.OrderID) > 10');
    }

    function it_should_allow_nested_where_clause()
    {
        $this->from('table', 't')
            ->select()
            ->where('t.id', '>', 1)
            ->whereNested(function (QueryBuilder $query) {
                $query->where('t.name', 'like', '%a%')
                    ->where('t.name', 'like', '%b', QueryBuilder::SIGN_OR);
            })
            ->toSql()
            ->shouldReturn('SELECT * FROM table t WHERE (t.id > 1) AND ((t.name like %a%) OR (t.name like %b))');
    }

    function it_should_allow_union()
    {
        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite'
        ]);

        $builder = new SQLBuilder(new \Doctrine\DBAL\Query\QueryBuilder($connection));
        $builder->from('table', 't')
            ->select(['t.a', 't.b']);

        $this->from('table', 't')
            ->select(['t.a', 't.b'])
            ->union($builder, true)
            ->union($builder)
            ->toSql()
            ->shouldReturn('SELECT t.a, t.b FROM table t UNION ALL SELECT t.a, t.b FROM table t UNION SELECT t.a, t.b FROM table t');
    }

}
