<?php

namespace ORM\Base;

use \Exception;
use \PDO;
use ORM\RowHistory as ChildRowHistory;
use ORM\RowHistoryQuery as ChildRowHistoryQuery;
use ORM\Map\RowHistoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'row_history' table.
 *
 *
 *
 * @method     ChildRowHistoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRowHistoryQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method     ChildRowHistoryQuery orderByRowId($order = Criteria::ASC) Order by the row_id column
 * @method     ChildRowHistoryQuery orderByTime($order = Criteria::ASC) Order by the time column
 * @method     ChildRowHistoryQuery orderByOperation($order = Criteria::ASC) Order by the operation column
 * @method     ChildRowHistoryQuery orderByUserID($order = Criteria::ASC) Order by the user_id column
 *
 * @method     ChildRowHistoryQuery groupById() Group by the id column
 * @method     ChildRowHistoryQuery groupByData() Group by the data column
 * @method     ChildRowHistoryQuery groupByRowId() Group by the row_id column
 * @method     ChildRowHistoryQuery groupByTime() Group by the time column
 * @method     ChildRowHistoryQuery groupByOperation() Group by the operation column
 * @method     ChildRowHistoryQuery groupByUserID() Group by the user_id column
 *
 * @method     ChildRowHistoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRowHistoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRowHistoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRowHistoryQuery leftJoinUserDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserDetail relation
 * @method     ChildRowHistoryQuery rightJoinUserDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserDetail relation
 * @method     ChildRowHistoryQuery innerJoinUserDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the UserDetail relation
 *
 * @method     \ORM\UserDetailQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRowHistory findOne(ConnectionInterface $con = null) Return the first ChildRowHistory matching the query
 * @method     ChildRowHistory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRowHistory matching the query, or a new ChildRowHistory object populated from the query conditions when no match is found
 *
 * @method     ChildRowHistory findOneById(string $id) Return the first ChildRowHistory filtered by the id column
 * @method     ChildRowHistory findOneByData(string $data) Return the first ChildRowHistory filtered by the data column
 * @method     ChildRowHistory findOneByRowId(string $row_id) Return the first ChildRowHistory filtered by the row_id column
 * @method     ChildRowHistory findOneByTime(string $time) Return the first ChildRowHistory filtered by the time column
 * @method     ChildRowHistory findOneByOperation(string $operation) Return the first ChildRowHistory filtered by the operation column
 * @method     ChildRowHistory findOneByUserID(string $user_id) Return the first ChildRowHistory filtered by the user_id column
 *
 * @method     ChildRowHistory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRowHistory objects based on current ModelCriteria
 * @method     ChildRowHistory[]|ObjectCollection findById(string $id) Return ChildRowHistory objects filtered by the id column
 * @method     ChildRowHistory[]|ObjectCollection findByData(string $data) Return ChildRowHistory objects filtered by the data column
 * @method     ChildRowHistory[]|ObjectCollection findByRowId(string $row_id) Return ChildRowHistory objects filtered by the row_id column
 * @method     ChildRowHistory[]|ObjectCollection findByTime(string $time) Return ChildRowHistory objects filtered by the time column
 * @method     ChildRowHistory[]|ObjectCollection findByOperation(string $operation) Return ChildRowHistory objects filtered by the operation column
 * @method     ChildRowHistory[]|ObjectCollection findByUserID(string $user_id) Return ChildRowHistory objects filtered by the user_id column
 * @method     ChildRowHistory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RowHistoryQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \ORM\Base\RowHistoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'pos', $modelName = '\\ORM\\RowHistory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRowHistoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRowHistoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRowHistoryQuery) {
            return $criteria;
        }
        $query = new ChildRowHistoryQuery();
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
     * @return ChildRowHistory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RowHistoryTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RowHistoryTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildRowHistory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, DATA, ROW_ID, TIME, OPERATION, USER_ID FROM row_history WHERE ID = :p0';
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
            /** @var ChildRowHistory $obj */
            $obj = new ChildRowHistory();
            $obj->hydrate($row);
            RowHistoryTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildRowHistory|array|mixed the result, formatted by the current formatter
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
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
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
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildRowHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RowHistoryTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRowHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RowHistoryTableMap::COL_ID, $keys, Criteria::IN);
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
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRowHistoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RowHistoryTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RowHistoryTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RowHistoryTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('fooValue');   // WHERE data = 'fooValue'
     * $query->filterByData('%fooValue%'); // WHERE data LIKE '%fooValue%'
     * </code>
     *
     * @param     string $data The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRowHistoryQuery The current query, for fluid interface
     */
    public function filterByData($data = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($data)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $data)) {
                $data = str_replace('*', '%', $data);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RowHistoryTableMap::COL_DATA, $data, $comparison);
    }

    /**
     * Filter the query on the row_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRowId(1234); // WHERE row_id = 1234
     * $query->filterByRowId(array(12, 34)); // WHERE row_id IN (12, 34)
     * $query->filterByRowId(array('min' => 12)); // WHERE row_id > 12
     * </code>
     *
     * @param     mixed $rowId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRowHistoryQuery The current query, for fluid interface
     */
    public function filterByRowId($rowId = null, $comparison = null)
    {
        if (is_array($rowId)) {
            $useMinMax = false;
            if (isset($rowId['min'])) {
                $this->addUsingAlias(RowHistoryTableMap::COL_ROW_ID, $rowId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rowId['max'])) {
                $this->addUsingAlias(RowHistoryTableMap::COL_ROW_ID, $rowId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RowHistoryTableMap::COL_ROW_ID, $rowId, $comparison);
    }

    /**
     * Filter the query on the time column
     *
     * Example usage:
     * <code>
     * $query->filterByTime('2011-03-14'); // WHERE time = '2011-03-14'
     * $query->filterByTime('now'); // WHERE time = '2011-03-14'
     * $query->filterByTime(array('max' => 'yesterday')); // WHERE time > '2011-03-13'
     * </code>
     *
     * @param     mixed $time The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRowHistoryQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (is_array($time)) {
            $useMinMax = false;
            if (isset($time['min'])) {
                $this->addUsingAlias(RowHistoryTableMap::COL_TIME, $time['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($time['max'])) {
                $this->addUsingAlias(RowHistoryTableMap::COL_TIME, $time['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RowHistoryTableMap::COL_TIME, $time, $comparison);
    }

    /**
     * Filter the query on the operation column
     *
     * Example usage:
     * <code>
     * $query->filterByOperation('fooValue');   // WHERE operation = 'fooValue'
     * $query->filterByOperation('%fooValue%'); // WHERE operation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $operation The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRowHistoryQuery The current query, for fluid interface
     */
    public function filterByOperation($operation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($operation)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $operation)) {
                $operation = str_replace('*', '%', $operation);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RowHistoryTableMap::COL_OPERATION, $operation, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserID(1234); // WHERE user_id = 1234
     * $query->filterByUserID(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserID(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUserDetail()
     *
     * @param     mixed $userID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRowHistoryQuery The current query, for fluid interface
     */
    public function filterByUserID($userID = null, $comparison = null)
    {
        if (is_array($userID)) {
            $useMinMax = false;
            if (isset($userID['min'])) {
                $this->addUsingAlias(RowHistoryTableMap::COL_USER_ID, $userID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userID['max'])) {
                $this->addUsingAlias(RowHistoryTableMap::COL_USER_ID, $userID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RowHistoryTableMap::COL_USER_ID, $userID, $comparison);
    }

    /**
     * Filter the query by a related \ORM\UserDetail object
     *
     * @param \ORM\UserDetail|ObjectCollection $userDetail The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRowHistoryQuery The current query, for fluid interface
     */
    public function filterByUserDetail($userDetail, $comparison = null)
    {
        if ($userDetail instanceof \ORM\UserDetail) {
            return $this
                ->addUsingAlias(RowHistoryTableMap::COL_USER_ID, $userDetail->getId(), $comparison);
        } elseif ($userDetail instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RowHistoryTableMap::COL_USER_ID, $userDetail->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserDetail() only accepts arguments of type \ORM\UserDetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRowHistoryQuery The current query, for fluid interface
     */
    public function joinUserDetail($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserDetail');

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
            $this->addJoinObject($join, 'UserDetail');
        }

        return $this;
    }

    /**
     * Use the UserDetail relation UserDetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ORM\UserDetailQuery A secondary query class using the current class as primary query
     */
    public function useUserDetailQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserDetail', '\ORM\UserDetailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRowHistory $rowHistory Object to remove from the list of results
     *
     * @return $this|ChildRowHistoryQuery The current query, for fluid interface
     */
    public function prune($rowHistory = null)
    {
        if ($rowHistory) {
            $this->addUsingAlias(RowHistoryTableMap::COL_ID, $rowHistory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the row_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RowHistoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RowHistoryTableMap::clearInstancePool();
            RowHistoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RowHistoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RowHistoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RowHistoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RowHistoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RowHistoryQuery
