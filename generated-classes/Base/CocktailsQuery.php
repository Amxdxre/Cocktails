<?php

namespace Base;

use \Cocktails as ChildCocktails;
use \CocktailsQuery as ChildCocktailsQuery;
use \Exception;
use \PDO;
use Map\CocktailsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `cocktails` table.
 *
 * @method     ChildCocktailsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCocktailsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCocktailsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ChildCocktailsQuery groupById() Group by the id column
 * @method     ChildCocktailsQuery groupByName() Group by the name column
 * @method     ChildCocktailsQuery groupByDescription() Group by the description column
 *
 * @method     ChildCocktailsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCocktailsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCocktailsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCocktailsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCocktailsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCocktailsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCocktailsQuery leftJoinRecipe($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recipe relation
 * @method     ChildCocktailsQuery rightJoinRecipe($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recipe relation
 * @method     ChildCocktailsQuery innerJoinRecipe($relationAlias = null) Adds a INNER JOIN clause to the query using the Recipe relation
 *
 * @method     ChildCocktailsQuery joinWithRecipe($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Recipe relation
 *
 * @method     ChildCocktailsQuery leftJoinWithRecipe() Adds a LEFT JOIN clause and with to the query using the Recipe relation
 * @method     ChildCocktailsQuery rightJoinWithRecipe() Adds a RIGHT JOIN clause and with to the query using the Recipe relation
 * @method     ChildCocktailsQuery innerJoinWithRecipe() Adds a INNER JOIN clause and with to the query using the Recipe relation
 *
 * @method     \RecipeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCocktails|null findOne(?ConnectionInterface $con = null) Return the first ChildCocktails matching the query
 * @method     ChildCocktails findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCocktails matching the query, or a new ChildCocktails object populated from the query conditions when no match is found
 *
 * @method     ChildCocktails|null findOneById(int $id) Return the first ChildCocktails filtered by the id column
 * @method     ChildCocktails|null findOneByName(string $name) Return the first ChildCocktails filtered by the name column
 * @method     ChildCocktails|null findOneByDescription(string $description) Return the first ChildCocktails filtered by the description column
 *
 * @method     ChildCocktails requirePk($key, ?ConnectionInterface $con = null) Return the ChildCocktails by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCocktails requireOne(?ConnectionInterface $con = null) Return the first ChildCocktails matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCocktails requireOneById(int $id) Return the first ChildCocktails filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCocktails requireOneByName(string $name) Return the first ChildCocktails filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCocktails requireOneByDescription(string $description) Return the first ChildCocktails filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCocktails[]|Collection find(?ConnectionInterface $con = null) Return ChildCocktails objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCocktails> find(?ConnectionInterface $con = null) Return ChildCocktails objects based on current ModelCriteria
 *
 * @method     ChildCocktails[]|Collection findById(int|array<int> $id) Return ChildCocktails objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCocktails> findById(int|array<int> $id) Return ChildCocktails objects filtered by the id column
 * @method     ChildCocktails[]|Collection findByName(string|array<string> $name) Return ChildCocktails objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildCocktails> findByName(string|array<string> $name) Return ChildCocktails objects filtered by the name column
 * @method     ChildCocktails[]|Collection findByDescription(string|array<string> $description) Return ChildCocktails objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildCocktails> findByDescription(string|array<string> $description) Return ChildCocktails objects filtered by the description column
 *
 * @method     ChildCocktails[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCocktails> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CocktailsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CocktailsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cocktails', $modelName = '\\Cocktails', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCocktailsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCocktailsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCocktailsQuery) {
            return $criteria;
        }
        $query = new ChildCocktailsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCocktails|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CocktailsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CocktailsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCocktails A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, description FROM cocktails WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCocktails $obj */
            $obj = new ChildCocktails();
            $obj->hydrate($row);
            CocktailsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildCocktails|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(CocktailsTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(CocktailsTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CocktailsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CocktailsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CocktailsTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CocktailsTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $description The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription($description = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CocktailsTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Recipe object
     *
     * @param \Recipe|ObjectCollection $recipe the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRecipe($recipe, ?string $comparison = null)
    {
        if ($recipe instanceof \Recipe) {
            $this
                ->addUsingAlias(CocktailsTableMap::COL_ID, $recipe->getCocktailId(), $comparison);

            return $this;
        } elseif ($recipe instanceof ObjectCollection) {
            $this
                ->useRecipeQuery()
                ->filterByPrimaryKeys($recipe->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByRecipe() only accepts arguments of type \Recipe or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Recipe relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinRecipe(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Recipe');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Recipe');
        }

        return $this;
    }

    /**
     * Use the Recipe relation Recipe object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RecipeQuery A secondary query class using the current class as primary query
     */
    public function useRecipeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRecipe($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Recipe', '\RecipeQuery');
    }

    /**
     * Use the Recipe relation Recipe object
     *
     * @param callable(\RecipeQuery):\RecipeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRecipeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useRecipeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Recipe table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \RecipeQuery The inner query object of the EXISTS statement
     */
    public function useRecipeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \RecipeQuery */
        $q = $this->useExistsQuery('Recipe', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Recipe table for a NOT EXISTS query.
     *
     * @see useRecipeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \RecipeQuery The inner query object of the NOT EXISTS statement
     */
    public function useRecipeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \RecipeQuery */
        $q = $this->useExistsQuery('Recipe', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Recipe table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \RecipeQuery The inner query object of the IN statement
     */
    public function useInRecipeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \RecipeQuery */
        $q = $this->useInQuery('Recipe', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Recipe table for a NOT IN query.
     *
     * @see useRecipeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \RecipeQuery The inner query object of the NOT IN statement
     */
    public function useNotInRecipeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \RecipeQuery */
        $q = $this->useInQuery('Recipe', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCocktails $cocktails Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($cocktails = null)
    {
        if ($cocktails) {
            $this->addUsingAlias(CocktailsTableMap::COL_ID, $cocktails->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cocktails table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CocktailsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CocktailsTableMap::clearInstancePool();
            CocktailsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CocktailsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CocktailsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CocktailsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CocktailsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
