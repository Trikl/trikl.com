<?php


/**
 * Base class that represents a query for the 'votes' table.
 *
 *
 *
 * @method VotesQuery orderByVoteid($order = Criteria::ASC) Order by the voteid column
 * @method VotesQuery orderByPostid($order = Criteria::ASC) Order by the postid column
 * @method VotesQuery orderByUserid($order = Criteria::ASC) Order by the userid column
 * @method VotesQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method VotesQuery groupByVoteid() Group by the voteid column
 * @method VotesQuery groupByPostid() Group by the postid column
 * @method VotesQuery groupByUserid() Group by the userid column
 * @method VotesQuery groupByValue() Group by the value column
 *
 * @method VotesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VotesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VotesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Votes findOne(PropelPDO $con = null) Return the first Votes matching the query
 * @method Votes findOneOrCreate(PropelPDO $con = null) Return the first Votes matching the query, or a new Votes object populated from the query conditions when no match is found
 *
 * @method Votes findOneByPostid(int $postid) Return the first Votes filtered by the postid column
 * @method Votes findOneByUserid(int $userid) Return the first Votes filtered by the userid column
 * @method Votes findOneByValue(int $value) Return the first Votes filtered by the value column
 *
 * @method array findByVoteid(int $voteid) Return Votes objects filtered by the voteid column
 * @method array findByPostid(int $postid) Return Votes objects filtered by the postid column
 * @method array findByUserid(int $userid) Return Votes objects filtered by the userid column
 * @method array findByValue(int $value) Return Votes objects filtered by the value column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseVotesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVotesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'Votes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VotesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     VotesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VotesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VotesQuery) {
            return $criteria;
        }
        $query = new VotesQuery();
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
     * @return   Votes|Votes[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VotesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VotesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Votes A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByVoteid($key, $con = null)
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
     * @return   Votes A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `VOTEID`, `POSTID`, `USERID`, `VALUE` FROM `votes` WHERE `VOTEID` = :p0';
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
            $obj = new Votes();
            $obj->hydrate($row);
            VotesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Votes|Votes[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Votes[]|mixed the list of results, formatted by the current formatter
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
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VotesPeer::VOTEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VotesPeer::VOTEID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the voteid column
     *
     * Example usage:
     * <code>
     * $query->filterByVoteid(1234); // WHERE voteid = 1234
     * $query->filterByVoteid(array(12, 34)); // WHERE voteid IN (12, 34)
     * $query->filterByVoteid(array('min' => 12)); // WHERE voteid > 12
     * </code>
     *
     * @param     mixed $voteid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByVoteid($voteid = null, $comparison = null)
    {
        if (is_array($voteid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(VotesPeer::VOTEID, $voteid, $comparison);
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
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByPostid($postid = null, $comparison = null)
    {
        if (is_array($postid)) {
            $useMinMax = false;
            if (isset($postid['min'])) {
                $this->addUsingAlias(VotesPeer::POSTID, $postid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postid['max'])) {
                $this->addUsingAlias(VotesPeer::POSTID, $postid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotesPeer::POSTID, $postid, $comparison);
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
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(VotesPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(VotesPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotesPeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue(1234); // WHERE value = 1234
     * $query->filterByValue(array(12, 34)); // WHERE value IN (12, 34)
     * $query->filterByValue(array('min' => 12)); // WHERE value > 12
     * </code>
     *
     * @param     mixed $value The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (is_array($value)) {
            $useMinMax = false;
            if (isset($value['min'])) {
                $this->addUsingAlias(VotesPeer::VALUE, $value['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($value['max'])) {
                $this->addUsingAlias(VotesPeer::VALUE, $value['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotesPeer::VALUE, $value, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Votes $votes Object to remove from the list of results
     *
     * @return VotesQuery The current query, for fluid interface
     */
    public function prune($votes = null)
    {
        if ($votes) {
            $this->addUsingAlias(VotesPeer::VOTEID, $votes->getVoteid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
