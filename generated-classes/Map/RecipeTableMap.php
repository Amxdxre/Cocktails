<?php

namespace Map;

use \Recipe;
use \RecipeQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'recipe' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class RecipeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.RecipeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'cocktails';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'recipe';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Recipe';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Recipe';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Recipe';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the cocktail_id field
     */
    public const COL_COCKTAIL_ID = 'recipe.cocktail_id';

    /**
     * the column name for the ingredient_id field
     */
    public const COL_INGREDIENT_ID = 'recipe.ingredient_id';

    /**
     * the column name for the item_id field
     */
    public const COL_ITEM_ID = 'recipe.item_id';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'recipe.amount';

    /**
     * the column name for the measure field
     */
    public const COL_MEASURE = 'recipe.measure';

    /**
     * the column name for the variation field
     */
    public const COL_VARIATION = 'recipe.variation';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['CocktailId', 'IngredientId', 'ItemId', 'Amount', 'Measure', 'Variation', ],
        self::TYPE_CAMELNAME     => ['cocktailId', 'ingredientId', 'itemId', 'amount', 'measure', 'variation', ],
        self::TYPE_COLNAME       => [RecipeTableMap::COL_COCKTAIL_ID, RecipeTableMap::COL_INGREDIENT_ID, RecipeTableMap::COL_ITEM_ID, RecipeTableMap::COL_AMOUNT, RecipeTableMap::COL_MEASURE, RecipeTableMap::COL_VARIATION, ],
        self::TYPE_FIELDNAME     => ['cocktail_id', 'ingredient_id', 'item_id', 'amount', 'measure', 'variation', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['CocktailId' => 0, 'IngredientId' => 1, 'ItemId' => 2, 'Amount' => 3, 'Measure' => 4, 'Variation' => 5, ],
        self::TYPE_CAMELNAME     => ['cocktailId' => 0, 'ingredientId' => 1, 'itemId' => 2, 'amount' => 3, 'measure' => 4, 'variation' => 5, ],
        self::TYPE_COLNAME       => [RecipeTableMap::COL_COCKTAIL_ID => 0, RecipeTableMap::COL_INGREDIENT_ID => 1, RecipeTableMap::COL_ITEM_ID => 2, RecipeTableMap::COL_AMOUNT => 3, RecipeTableMap::COL_MEASURE => 4, RecipeTableMap::COL_VARIATION => 5, ],
        self::TYPE_FIELDNAME     => ['cocktail_id' => 0, 'ingredient_id' => 1, 'item_id' => 2, 'amount' => 3, 'measure' => 4, 'variation' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'CocktailId' => 'COCKTAIL_ID',
        'Recipe.CocktailId' => 'COCKTAIL_ID',
        'cocktailId' => 'COCKTAIL_ID',
        'recipe.cocktailId' => 'COCKTAIL_ID',
        'RecipeTableMap::COL_COCKTAIL_ID' => 'COCKTAIL_ID',
        'COL_COCKTAIL_ID' => 'COCKTAIL_ID',
        'cocktail_id' => 'COCKTAIL_ID',
        'recipe.cocktail_id' => 'COCKTAIL_ID',
        'IngredientId' => 'INGREDIENT_ID',
        'Recipe.IngredientId' => 'INGREDIENT_ID',
        'ingredientId' => 'INGREDIENT_ID',
        'recipe.ingredientId' => 'INGREDIENT_ID',
        'RecipeTableMap::COL_INGREDIENT_ID' => 'INGREDIENT_ID',
        'COL_INGREDIENT_ID' => 'INGREDIENT_ID',
        'ingredient_id' => 'INGREDIENT_ID',
        'recipe.ingredient_id' => 'INGREDIENT_ID',
        'ItemId' => 'ITEM_ID',
        'Recipe.ItemId' => 'ITEM_ID',
        'itemId' => 'ITEM_ID',
        'recipe.itemId' => 'ITEM_ID',
        'RecipeTableMap::COL_ITEM_ID' => 'ITEM_ID',
        'COL_ITEM_ID' => 'ITEM_ID',
        'item_id' => 'ITEM_ID',
        'recipe.item_id' => 'ITEM_ID',
        'Amount' => 'AMOUNT',
        'Recipe.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'recipe.amount' => 'AMOUNT',
        'RecipeTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'Measure' => 'MEASURE',
        'Recipe.Measure' => 'MEASURE',
        'measure' => 'MEASURE',
        'recipe.measure' => 'MEASURE',
        'RecipeTableMap::COL_MEASURE' => 'MEASURE',
        'COL_MEASURE' => 'MEASURE',
        'Variation' => 'VARIATION',
        'Recipe.Variation' => 'VARIATION',
        'variation' => 'VARIATION',
        'recipe.variation' => 'VARIATION',
        'RecipeTableMap::COL_VARIATION' => 'VARIATION',
        'COL_VARIATION' => 'VARIATION',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('recipe');
        $this->setPhpName('Recipe');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Recipe');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addForeignKey('cocktail_id', 'CocktailId', 'INTEGER', 'cocktails', 'id', true, null, null);
        $this->addForeignKey('ingredient_id', 'IngredientId', 'INTEGER', 'ingredients', 'id', true, null, null);
        $this->addPrimaryKey('item_id', 'ItemId', 'INTEGER', true, null, null);
        $this->addColumn('amount', 'Amount', 'INTEGER', true, null, null);
        $this->addColumn('measure', 'Measure', 'VARCHAR', true, 255, null);
        $this->addColumn('variation', 'Variation', 'INTEGER', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Cocktails', '\\Cocktails', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':cocktail_id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Ingredients', '\\Ingredients', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ingredient_id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? RecipeTableMap::CLASS_DEFAULT : RecipeTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Recipe object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = RecipeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RecipeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RecipeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RecipeTableMap::OM_CLASS;
            /** @var Recipe $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RecipeTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = RecipeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RecipeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Recipe $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RecipeTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(RecipeTableMap::COL_COCKTAIL_ID);
            $criteria->addSelectColumn(RecipeTableMap::COL_INGREDIENT_ID);
            $criteria->addSelectColumn(RecipeTableMap::COL_ITEM_ID);
            $criteria->addSelectColumn(RecipeTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(RecipeTableMap::COL_MEASURE);
            $criteria->addSelectColumn(RecipeTableMap::COL_VARIATION);
        } else {
            $criteria->addSelectColumn($alias . '.cocktail_id');
            $criteria->addSelectColumn($alias . '.ingredient_id');
            $criteria->addSelectColumn($alias . '.item_id');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.measure');
            $criteria->addSelectColumn($alias . '.variation');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(RecipeTableMap::COL_COCKTAIL_ID);
            $criteria->removeSelectColumn(RecipeTableMap::COL_INGREDIENT_ID);
            $criteria->removeSelectColumn(RecipeTableMap::COL_ITEM_ID);
            $criteria->removeSelectColumn(RecipeTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(RecipeTableMap::COL_MEASURE);
            $criteria->removeSelectColumn(RecipeTableMap::COL_VARIATION);
        } else {
            $criteria->removeSelectColumn($alias . '.cocktail_id');
            $criteria->removeSelectColumn($alias . '.ingredient_id');
            $criteria->removeSelectColumn($alias . '.item_id');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.measure');
            $criteria->removeSelectColumn($alias . '.variation');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(RecipeTableMap::DATABASE_NAME)->getTable(RecipeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Recipe or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Recipe object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RecipeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Recipe) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RecipeTableMap::DATABASE_NAME);
            $criteria->add(RecipeTableMap::COL_ITEM_ID, (array) $values, Criteria::IN);
        }

        $query = RecipeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RecipeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RecipeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the recipe table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return RecipeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Recipe or Criteria object.
     *
     * @param mixed $criteria Criteria or Recipe object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RecipeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Recipe object
        }

        if ($criteria->containsKey(RecipeTableMap::COL_ITEM_ID) && $criteria->keyContainsValue(RecipeTableMap::COL_ITEM_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RecipeTableMap::COL_ITEM_ID.')');
        }


        // Set the correct dbName
        $query = RecipeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
