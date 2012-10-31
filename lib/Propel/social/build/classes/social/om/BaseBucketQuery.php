<?php


/**
 * Base class that represents a query for the 'user_buckets' table.
 *
 *
 *
 * @method BucketQuery orderByBucketid($order = Criteria::ASC) Order by the bucketid column
 * @method BucketQuery orderByUserid($order = Criteria::ASC) Order by the userid column
 * @method BucketQuery orderByBucketName($order = Criteria::ASC) Order by the bucket_name column
 *
 * @method BucketQuery groupByBucketid() Group by the bucketid column
 * @method BucketQuery groupByUserid() Group by the userid column
 * @method BucketQuery groupByBucketName() Group by the bucket_name column
 *
 * @method BucketQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BucketQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BucketQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Bucket findOne(PropelPDO $con = null) Return the first Bucket matching the query
 * @method Bucket findOneOrCreate(PropelPDO $con = null) Return the first Bucket matching the query, or a new Bucket object populated from the query conditions when no match is found
 *
 * @method Bucket findOneByUserid(int $userid) Return the first Bucket filtered by the userid column
 * @method Bucket findOneByBucketName(string $bucket_name) Return the first Bucket filtered by the bucket_name column
 *
 * @method array findByBucketid(int $bucketid) Return Bucket objects filtered by the bucketid column
 * @method array findByUserid(int $userid) Return Bucket objects filtered by the userid column
 * @method array findByBucketName(string $bucket_name) Return Bucket objects filtered by the bucket_name column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseBucketQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBucketQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'Bucket', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BucketQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BucketQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BucketQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BucketQuery) {
            return $criteria;
        }
        $query = new BucketQuery();
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
     * @return   Bucket|Bucket[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BucketPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BucketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Bucket A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByBucketid($key, $con = null)
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
     * @return   Bucket A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `BUCKETID`, `USERID`, `BUCKET_NAME` FROM `user_buckets` WHERE `BUCKETID` = :p0';
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
            $obj = new Bucket();
            $obj->hydrate($row);
            BucketPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Bucket|Bucket[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Bucket[]|mixed the list of results, formatted by the current formatter
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
     * @return BucketQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BucketPeer::BUCKETID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BucketQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BucketPeer::BUCKETID, $keys, Criteria::IN);
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
     * @return BucketQuery The current query, for fluid interface
     */
    public function filterByBucketid($bucketid = null, $comparison = null)
    {
        if (is_array($bucketid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BucketPeer::BUCKETID, $bucketid, $comparison);
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
     * @return BucketQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(BucketPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(BucketPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BucketPeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the bucket_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBucketName('fooValue');   // WHERE bucket_name = 'fooValue'
     * $query->filterByBucketName('%fooValue%'); // WHERE bucket_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bucketName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BucketQuery The current query, for fluid interface
     */
    public function filterByBucketName($bucketName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bucketName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bucketName)) {
                $bucketName = str_replace('*', '%', $bucketName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BucketPeer::BUCKET_NAME, $bucketName, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Bucket $bucket Object to remove from the list of results
     *
     * @return BucketQuery The current query, for fluid interface
     */
    public function prune($bucket = null)
    {
        if ($bucket) {
            $this->addUsingAlias(BucketPeer::BUCKETID, $bucket->getBucketid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
