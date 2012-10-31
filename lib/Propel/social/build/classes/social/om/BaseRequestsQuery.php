<?php


/**
 * Base class that represents a query for the 'friend_requests' table.
 *
 *
 *
 * @method RequestsQuery orderByRequestid($order = Criteria::ASC) Order by the requestid column
 * @method RequestsQuery orderByUserid($order = Criteria::ASC) Order by the userid column
 * @method RequestsQuery orderByFriendid($order = Criteria::ASC) Order by the friendid column
 *
 * @method RequestsQuery groupByRequestid() Group by the requestid column
 * @method RequestsQuery groupByUserid() Group by the userid column
 * @method RequestsQuery groupByFriendid() Group by the friendid column
 *
 * @method RequestsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RequestsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RequestsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Requests findOne(PropelPDO $con = null) Return the first Requests matching the query
 * @method Requests findOneOrCreate(PropelPDO $con = null) Return the first Requests matching the query, or a new Requests object populated from the query conditions when no match is found
 *
 * @method Requests findOneByUserid(int $userid) Return the first Requests filtered by the userid column
 * @method Requests findOneByFriendid(int $friendid) Return the first Requests filtered by the friendid column
 *
 * @method array findByRequestid(int $requestid) Return Requests objects filtered by the requestid column
 * @method array findByUserid(int $userid) Return Requests objects filtered by the userid column
 * @method array findByFriendid(int $friendid) Return Requests objects filtered by the friendid column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseRequestsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRequestsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'Requests', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RequestsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     RequestsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RequestsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RequestsQuery) {
            return $criteria;
        }
        $query = new RequestsQuery();
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
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Requests|Requests[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RequestsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RequestsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Requests A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByRequestid($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Requests A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `REQUESTID`, `USERID`, `FRIENDID` FROM `friend_requests` WHERE `REQUESTID` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Requests();
            $obj->hydrate($row);
            RequestsPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Requests|Requests[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Requests[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return RequestsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RequestsPeer::REQUESTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RequestsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RequestsPeer::REQUESTID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the requestid column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestid(1234); // WHERE requestid = 1234
     * $query->filterByRequestid(array(12, 34)); // WHERE requestid IN (12, 34)
     * $query->filterByRequestid(array('min' => 12)); // WHERE requestid > 12
     * </code>
     *
     * @param     mixed $requestid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RequestsQuery The current query, for fluid interface
     */
    public function filterByRequestid($requestid = null, $comparison = null)
    {
        if (is_array($requestid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(RequestsPeer::REQUESTID, $requestid, $comparison);
    }

    /**
     * Filter the query on the userid column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE userid = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE userid IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE userid > 12
     * </code>
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RequestsQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(RequestsPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(RequestsPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestsPeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the friendid column
     *
     * Example usage:
     * <code>
     * $query->filterByFriendid(1234); // WHERE friendid = 1234
     * $query->filterByFriendid(array(12, 34)); // WHERE friendid IN (12, 34)
     * $query->filterByFriendid(array('min' => 12)); // WHERE friendid > 12
     * </code>
     *
     * @param     mixed $friendid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RequestsQuery The current query, for fluid interface
     */
    public function filterByFriendid($friendid = null, $comparison = null)
    {
        if (is_array($friendid)) {
            $useMinMax = false;
            if (isset($friendid['min'])) {
                $this->addUsingAlias(RequestsPeer::FRIENDID, $friendid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($friendid['max'])) {
                $this->addUsingAlias(RequestsPeer::FRIENDID, $friendid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestsPeer::FRIENDID, $friendid, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Requests $requests Object to remove from the list of results
     *
     * @return RequestsQuery The current query, for fluid interface
     */
    public function prune($requests = null)
    {
        if ($requests) {
            $this->addUsingAlias(RequestsPeer::REQUESTID, $requests->getRequestid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
