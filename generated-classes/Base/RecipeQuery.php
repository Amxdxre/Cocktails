<?php

namespace Base;

use \Recipe as ChildRecipe;
use \RecipeQuery as ChildRecipeQuery;
use \Exception;
use \PDO;
use Map\RecipeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `recipe` table.
 *
 * @method     ChildRecipeQuery orderByCocktailId($order = Criteria::ASC) Order by the cocktail_id column
 * @method     ChildRecipeQuery orderByIngredientId($order = Criteria::ASC) Order by the ingredient_id column
 * @method     ChildRecipeQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildRecipeQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildRecipeQuery orderByMeasure($order = Criteria::ASC) Order by the measure column
 * @method     ChildRecipeQuery orderByVariation($order = Criteria::ASC) Order by the variation column
 *
 * @method     ChildRecipeQuery groupByCocktailId() Group by the cocktail_id column
 * @method     ChildRecipeQuery groupByIngredientId() Group by the ingredient_id column
 * @method     ChildRecipeQuery groupByItemId() Group by the item_id column
 * @method     ChildRecipeQuery groupByAmount() Group by the amount column
 * @method     ChildRecipeQuery groupByMeasure() Group by the measure column
 * @method     ChildRecipeQuery groupByVariation() Group by the variation column
 *
 * @method     ChildRecipeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRecipeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRecipeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRecipeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRecipeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRecipeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRecipeQuery leftJoinCocktails($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cocktails relation
 * @method     ChildRecipeQuery rightJoinCocktails($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cocktails relation
 * @method     ChildRecipeQuery innerJoinCocktails($relationAlias = null) Adds a INNER JOIN clause to the query using the Cocktails relation
 *
 * @method     ChildRecipeQuery joinWithCocktails($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cocktails relation
 *
 * @method     ChildRecipeQuery leftJoinWithCocktails() Adds a LEFT JOIN clause and with to the query using the Cocktails relation
 * @method     ChildRecipeQuery rightJoinWithCocktails() Adds a RIGHT JOIN clause and with to the query using the Cocktails relation
 * @method     ChildRecipeQuery innerJoinWithCocktails() Adds a INNER JOIN clause and with to the query using the Cocktails relation
 *
 * @method     ChildRecipeQuery leftJoinIngredients($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ingredients relation
 * @method     ChildRecipeQuery rightJoinIngredients($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ingredients relation
 * @method     ChildRecipeQuery innerJoinIngredients($relationAlias = null) Adds a INNER JOIN clause to the query using the Ingredients relation
 *
 * @method     ChildRecipeQuery joinWithIngredients($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ingredients relation
 *
 * @method     ChildRecipeQuery leftJoinWithIngredients() Adds a LEFT JOIN clause and with to the query using the Ingredients relation
 * @method     ChildRecipeQuery rightJoinWithIngredients() Adds a RIGHT JOIN clause and with to the query using the Ingredients relation
 * @method     ChildRecipeQuery innerJoinWithIngredients() Adds a INNER JOIN clause and with to the query using the Ingredients relation
 *
 * @method     \CocktailsQuery|\IngredientsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRecipe|null findOne(?ConnectionInterface $con = null) Return the first ChildRecipe matching the query
 * @method     ChildRecipe findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildRecipe matching the query, or a new ChildRecipe object populated from the query conditions when no match is found
 *
 * @method     ChildRecipe|null findOneByCocktailId(int $cocktail_id) Return the first ChildRecipe filtered by the cocktail_id column
 * @method     ChildRecipe|null findOneByIngredientId(int $ingredient_id) Return the first ChildRecipe filtered by the ingredient_id column
 * @method     ChildRecipe|null findOneByItemId(int $item_id) Return the first ChildRecipe filtered by the item_id column
 * @method     ChildRecipe|null findOneByAmount(int $amount) Return the first ChildRecipe filtered by the amount column
 * @method     ChildRecipe|null findOneByMeasure(string $measure) Return the first ChildRecipe filtered by the measure column
 * @method     ChildRecipe|null findOneByVariation(int $variation) Return the first ChildRecipe filtered by the variation column
 *
 * @method     ChildRecipe requirePk($key, ?ConnectionInterface $con = null) Return the ChildRecipe by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOne(?ConnectionInterface $con = null) Return the first ChildRecipe matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRecipe requireOneByCocktailId(int $cocktail_id) Return the first ChildRecipe filtered by the cocktail_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOneByIngredientId(int $ingredient_id) Return the first ChildRecipe filtered by the ingredient_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOneByItemId(int $item_id) Return the first ChildRecipe filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOneByAmount(int $amount) Return the first ChildRecipe filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOneByMeasure(string $measure) Return the first ChildRecipe filtered by the measure column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOneByVariation(int $variation) Return the first ChildRecipe filtered by the variation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRecipe[]|Collection find(?ConnectionInterface $con = null) Return ChildRecipe objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildRecipe> find(?ConnectionInterface $con = null) Return ChildRecipe objects based on current ModelCriteria
 *
 * @method     ChildRecipe[]|Collection findByCocktailId(int|array<int> $cocktail_id) Return ChildRecipe objects filtered by the cocktail_id column
 * @psalm-method Collection&\Traversable<ChildRecipe> findByCocktailId(int|array<int> $cocktail_id) Return ChildRecipe objects filtered by the cocktail_id column
 * @method     ChildRecipe[]|Collection findByIngredientId(int|array<int> $ingredient_id) Return ChildRecipe objects filtered by the ingredient_id column
 * @psalm-method Collection&\Traversable<ChildRecipe> findByIngredientId(int|array<int> $ingredient_id) Return ChildRecipe objects filtered by the ingredient_id column
 * @method     ChildRecipe[]|Collection findByItemId(int|array<int> $item_id) Return ChildRecipe objects filtered by the item_id column
 * @psalm-method Collection&\Traversable<ChildRecipe> findByItemId(int|array<int> $item_id) Return ChildRecipe objects filtered by the item_id column
 * @method     ChildRecipe[]|Collection findByAmount(int|array<int> $amount) Return ChildRecipe objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildRecipe> findByAmount(int|array<int> $amount) Return ChildRecipe objects filtered by the amount column
 * @method     ChildRecipe[]|Collection findByMeasure(string|array<string> $measure) Return ChildRecipe objects filtered by the measure column
 * @psalm-method Collection&\Traversable<ChildRecipe> findByMeasure(string|array<string> $measure) Return ChildRecipe objects filtered by the measure column
 * @method     ChildRecipe[]|Collection findByVariation(int|array<int> $variation) Return ChildRecipe objects filtered by the variation column
 * @psalm-method Collection&\Traversable<ChildRecipe> findByVariation(int|array<int> $variation) Return ChildRecipe objects filtered by the variation column
 *
 * @method     ChildRecipe[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildRecipe> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class RecipeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RecipeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cocktails', $modelName = '\\Recipe', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRecipeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRecipeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildRecipeQuery) {
            return $criteria;
        }
        $query = new ChildRecipeQuery();
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
     * @return ChildRecipe|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RecipeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RecipeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRecipe A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT cocktail_id, ingredient_id, item_id, amount, measure, variation FROM recipe WHERE item_id = :p0';
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
            /** @var ChildRecipe $obj */
            $obj = new ChildRecipe();
            $obj->hydrate($row);
            RecipeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRecipe|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(RecipeTableMap::COL_ITEM_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(RecipeTableMap::COL_ITEM_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the cocktail_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCocktailId(1234); // WHERE cocktail_id = 1234
     * $query->filterByCocktailId(array(12, 34)); // WHERE cocktail_id IN (12, 34)
     * $query->filterByCocktailId(array('min' => 12)); // WHERE cocktail_id > 12
     * </code>
     *
     * @see       filterByCocktails()
     *
     * @param mixed $cocktailId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCocktailId($cocktailId = null, ?string $comparison = null)
    {
        if (is_array($cocktailId)) {
            $useMinMax = false;
            if (isset($cocktailId['min'])) {
                $this->addUsingAlias(RecipeTableMap::COL_COCKTAIL_ID, $cocktailId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cocktailId['max'])) {
                $this->addUsingAlias(RecipeTableMap::COL_COCKTAIL_ID, $cocktailId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RecipeTableMap::COL_COCKTAIL_ID, $cocktailId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ingredient_id column
     *
     * Example usage:
     * <code>
     * $query->filterByIngredientId(1234); // WHERE ingredient_id = 1234
     * $query->filterByIngredientId(array(12, 34)); // WHERE ingredient_id IN (12, 34)
     * $query->filterByIngredientId(array('min' => 12)); // WHERE ingredient_id > 12
     * </code>
     *
     * @see       filterByIngredients()
     *
     * @param mixed $ingredientId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIngredientId($ingredientId = null, ?string $comparison = null)
    {
        if (is_array($ingredientId)) {
            $useMinMax = false;
            if (isset($ingredientId['min'])) {
                $this->addUsingAlias(RecipeTableMap::COL_INGREDIENT_ID, $ingredientId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ingredientId['max'])) {
                $this->addUsingAlias(RecipeTableMap::COL_INGREDIENT_ID, $ingredientId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RecipeTableMap::COL_INGREDIENT_ID, $ingredientId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByItemId(1234); // WHERE item_id = 1234
     * $query->filterByItemId(array(12, 34)); // WHERE item_id IN (12, 34)
     * $query->filterByItemId(array('min' => 12)); // WHERE item_id > 12
     * </code>
     *
     * @param mixed $itemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, ?string $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(RecipeTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(RecipeTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RecipeTableMap::COL_ITEM_ID, $itemId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount($amount = null, ?string $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(RecipeTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(RecipeTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RecipeTableMap::COL_AMOUNT, $amount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the measure column
     *
     * Example usage:
     * <code>
     * $query->filterByMeasure('fooValue');   // WHERE measure = 'fooValue'
     * $query->filterByMeasure('%fooValue%', Criteria::LIKE); // WHERE measure LIKE '%fooValue%'
     * $query->filterByMeasure(['foo', 'bar']); // WHERE measure IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $measure The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMeasure($measure = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($measure)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RecipeTableMap::COL_MEASURE, $measure, $comparison);

        return $this;
    }

    /**
     * Filter the query on the variation column
     *
     * Example usage:
     * <code>
     * $query->filterByVariation(1234); // WHERE variation = 1234
     * $query->filterByVariation(array(12, 34)); // WHERE variation IN (12, 34)
     * $query->filterByVariation(array('min' => 12)); // WHERE variation > 12
     * </code>
     *
     * @param mixed $variation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVariation($variation = null, ?string $comparison = null)
    {
        if (is_array($variation)) {
            $useMinMax = false;
            if (isset($variation['min'])) {
                $this->addUsingAlias(RecipeTableMap::COL_VARIATION, $variation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($variation['max'])) {
                $this->addUsingAlias(RecipeTableMap::COL_VARIATION, $variation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RecipeTableMap::COL_VARIATION, $variation, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Cocktails object
     *
     * @param \Cocktails|ObjectCollection $cocktails The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCocktails($cocktails, ?string $comparison = null)
    {
        if ($cocktails instanceof \Cocktails) {
            return $this
                ->addUsingAlias(RecipeTableMap::COL_COCKTAIL_ID, $cocktails->getId(), $comparison);
        } elseif ($cocktails instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(RecipeTableMap::COL_COCKTAIL_ID, $cocktails->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCocktails() only accepts arguments of type \Cocktails or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cocktails relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCocktails(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cocktails');

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
            $this->addJoinObject($join, 'Cocktails');
        }

        return $this;
    }

    /**
     * Use the Cocktails relation Cocktails object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CocktailsQuery A secondary query class using the current class as primary query
     */
    public function useCocktailsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCocktails($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cocktails', '\CocktailsQuery');
    }

    /**
     * Use the Cocktails relation Cocktails object
     *
     * @param callable(\CocktailsQuery):\CocktailsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCocktailsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCocktailsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Cocktails table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \CocktailsQuery The inner query object of the EXISTS statement
     */
    public function useCocktailsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \CocktailsQuery */
        $q = $this->useExistsQuery('Cocktails', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Cocktails table for a NOT EXISTS query.
     *
     * @see useCocktailsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \CocktailsQuery The inner query object of the NOT EXISTS statement
     */
    public function useCocktailsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \CocktailsQuery */
        $q = $this->useExistsQuery('Cocktails', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Cocktails table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \CocktailsQuery The inner query object of the IN statement
     */
    public function useInCocktailsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \CocktailsQuery */
        $q = $this->useInQuery('Cocktails', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Cocktails table for a NOT IN query.
     *
     * @see useCocktailsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \CocktailsQuery The inner query object of the NOT IN statement
     */
    public function useNotInCocktailsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \CocktailsQuery */
        $q = $this->useInQuery('Cocktails', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Ingredients object
     *
     * @param \Ingredients|ObjectCollection $ingredients The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIngredients($ingredients, ?string $comparison = null)
    {
        if ($ingredients instanceof \Ingredients) {
            return $this
                ->addUsingAlias(RecipeTableMap::COL_INGREDIENT_ID, $ingredients->getId(), $comparison);
        } elseif ($ingredients instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(RecipeTableMap::COL_INGREDIENT_ID, $ingredients->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByIngredients() only accepts arguments of type \Ingredients or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ingredients relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinIngredients(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ingredients');

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
            $this->addJoinObject($join, 'Ingredients');
        }

        return $this;
    }

    /**
     * Use the Ingredients relation Ingredients object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \IngredientsQuery A secondary query class using the current class as primary query
     */
    public function useIngredientsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIngredients($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ingredients', '\IngredientsQuery');
    }

    /**
     * Use the Ingredients relation Ingredients object
     *
     * @param callable(\IngredientsQuery):\IngredientsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withIngredientsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useIngredientsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Ingredients table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \IngredientsQuery The inner query object of the EXISTS statement
     */
    public function useIngredientsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \IngredientsQuery */
        $q = $this->useExistsQuery('Ingredients', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Ingredients table for a NOT EXISTS query.
     *
     * @see useIngredientsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \IngredientsQuery The inner query object of the NOT EXISTS statement
     */
    public function useIngredientsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \IngredientsQuery */
        $q = $this->useExistsQuery('Ingredients', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Ingredients table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \IngredientsQuery The inner query object of the IN statement
     */
    public function useInIngredientsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \IngredientsQuery */
        $q = $this->useInQuery('Ingredients', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Ingredients table for a NOT IN query.
     *
     * @see useIngredientsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \IngredientsQuery The inner query object of the NOT IN statement
     */
    public function useNotInIngredientsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \IngredientsQuery */
        $q = $this->useInQuery('Ingredients', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildRecipe $recipe Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($recipe = null)
    {
        if ($recipe) {
            $this->addUsingAlias(RecipeTableMap::COL_ITEM_ID, $recipe->getItemId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the recipe table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RecipeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RecipeTableMap::clearInstancePool();
            RecipeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RecipeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RecipeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RecipeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RecipeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
