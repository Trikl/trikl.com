<?php


/**
 * Base class that represents a query for the 'status' table.
 *
 *
 *
 * @method StatusQuery orderByPostid($order = Criteria::ASC) Order by the postid column
 * @method StatusQuery orderByUserid($order = Criteria::ASC) Order by the userid column
 * @method StatusQuery orderByBucketid($order = Criteria::ASC) Order by the bucketid column
 * @method StatusQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method StatusQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method StatusQuery orderByDrops($order = Criteria::ASC) Order by the drops column
 *
 * @method StatusQuery groupByPostid() Group by the postid column
 * @method StatusQuery groupByUserid() Group by the userid column
 * @method StatusQuery groupByBucketid() Group by the bucketid column
 * @method StatusQuery groupByDate() Group by the date column
 * @method StatusQuery groupByStatus() Group by the status column
 * @method StatusQuery groupByDrops() Group by the drops column
 *
 * @method StatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method StatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method StatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Status findOne(PropelPDO $con = null) Return the first Status matching the query
 * @method Status findOneOrCreate(PropelPDO $con = null) Return the first Status matching the query, or a new Status object populated from the query conditions when no match is found
 *
 * @method Status findOneByUserid(int $userid) Return the first Status filtered by the userid column
 * @method Status findOneByBucketid(int $bucketid) Return the first Status filtered by the bucketid column
 * @method Status findOneByDate(string $date) Return the first Status filtered by the date column
 * @method Status findOneByStatus(string $status) Return the first Status filtered by the status column
 * @method Status findOneByDrops(int $drops) Return the first Status filtered by the drops column
 *
 * @method array findByPostid(int $postid) Return Status objects filtered by the postid column
 * @method array findByUserid(int $userid) Return Status objects filtered by the userid column
 * @method array findByBucketid(int $bucketid) Return Status objects filtered by the bucketid column
 * @method array findByDate(string $date) Return Status objects filtered by the date column
 * @method array findByStatus(string $status) Return Status objects filtered by the status column
 * @method array findByDrops(int $drops) Return Status objects filtered by the drops column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseStatusQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseStatusQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'Status', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new StatusQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     StatusQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return StatusQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof StatusQuery) {
            return $criteria;
        }
        $query = new StatusQuery();
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
     * @return   Status|Status[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = StatusPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(StatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Status A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByPostid($key, $con = null)
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
     * @return   Status A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `POSTID`, `USERID`, `BUCKETID`, `DATE`, `STATUS`, `DROPS` FROM `status` WHERE `POSTID` = :p0';
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
            $obj = new Status();
            $obj->hydrate($row);
            StatusPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Status|Status[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Status[]|mixed the list of results, formatted by the current formatter
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
     * @return StatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StatusPeer::POSTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return StatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StatusPeer::POSTID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the postid column
     *
     * Example usage:
     * <code>
     * $query->filterByPostid(1234); // WHERE postid = 1234
     * $query->filterByPostid(array(12, 34)); // WHERE postid IN (12, 34)
     * $query->filterByPostid(array('min' => 12)); // WHERE postid > 12
     * </code>
     *
     * @param     mixed $postid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return StatusQuery The current query, for fluid interface
     */
    public function filterByPostid($postid = null, $comparison = null)
    {
        if (is_array($postid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(StatusPeer::POSTID, $postid, $comparison);
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
     * @return StatusQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(StatusPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(StatusPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusPeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the bucketid column
     *
     * Example usage:
     * <code>
     * $query->filterByBucketid(1234); // WHERE bucketid = 1234
     * $query->filterByBucketid(array(12, 34)); // WHERE bucketid IN (12, 34)
     * $query->filterByBucketid(array('min' => 12)); // WHERE bucketid > 12
     * </code>
     *
     * @param     mixed $bucketid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return StatusQuery The current query, for fluid interface
     */
    public function filterByBucketid($bucketid = null, $comparison = null)
    {
        if (is_array($bucketid)) {
            $useMinMax = false;
            if (isset($bucketid['min'])) {
                $this->addUsingAlias(StatusPeer::BUCKETID, $bucketid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bucketid['max'])) {
                $this->addUsingAlias(StatusPeer::BUCKETID, $bucketid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusPeer::BUCKETID, $bucketid, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return StatusQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(StatusPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(StatusPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusPeer::DATE, $date, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%'); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return StatusQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $status)) {
                $status = str_replace('*', '%', $status);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(StatusPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the drops column
     *
     * Example usage:
     * <code>
     * $query->filterByDrops(1234); // WHERE drops = 1234
     * $query->filterByDrops(array(12, 34)); // WHERE drops IN (12, 34)
     * $query->filterByDrops(array('min' => 12)); // WHERE drops > 12
     * </code>
     *
     * @param     mixed $drops The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return StatusQuery The current query, for fluid interface
     */
    public function filterByDrops($drops = null, $comparison = null)
    {
        if (is_array($drops)) {
            $useMinMax = false;
            if (isset($drops['min'])) {
                $this->addUsingAlias(StatusPeer::DROPS, $drops['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($drops['max'])) {
                $this->addUsingAlias(StatusPeer::DROPS, $drops['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusPeer::DROPS, $drops, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Status $status Object to remove from the list of results
     *
     * @return StatusQuery The current query, for fluid interface
     */
    public function prune($status = null)
    {
        if ($status) {
            $this->addUsingAlias(StatusPeer::POSTID, $status->getPostid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
