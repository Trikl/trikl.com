<?php


/**
 * Base class that represents a query for the 'message_contents' table.
 *
 *
 *
 * @method MessageContentsQuery orderByMessageid($order = Criteria::ASC) Order by the MessageID column
 * @method MessageContentsQuery orderByThreadid($order = Criteria::ASC) Order by the ThreadID column
 * @method MessageContentsQuery orderByUserid($order = Criteria::ASC) Order by the UserID column
 * @method MessageContentsQuery orderByContent($order = Criteria::ASC) Order by the Content column
 * @method MessageContentsQuery orderByDate($order = Criteria::ASC) Order by the Date column
 *
 * @method MessageContentsQuery groupByMessageid() Group by the MessageID column
 * @method MessageContentsQuery groupByThreadid() Group by the ThreadID column
 * @method MessageContentsQuery groupByUserid() Group by the UserID column
 * @method MessageContentsQuery groupByContent() Group by the Content column
 * @method MessageContentsQuery groupByDate() Group by the Date column
 *
 * @method MessageContentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MessageContentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MessageContentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MessageContents findOne(PropelPDO $con = null) Return the first MessageContents matching the query
 * @method MessageContents findOneOrCreate(PropelPDO $con = null) Return the first MessageContents matching the query, or a new MessageContents object populated from the query conditions when no match is found
 *
 * @method MessageContents findOneByMessageid(int $MessageID) Return the first MessageContents filtered by the MessageID column
 * @method MessageContents findOneByUserid(int $UserID) Return the first MessageContents filtered by the UserID column
 * @method MessageContents findOneByContent(string $Content) Return the first MessageContents filtered by the Content column
 * @method MessageContents findOneByDate(string $Date) Return the first MessageContents filtered by the Date column
 *
 * @method array findByMessageid(int $MessageID) Return MessageContents objects filtered by the MessageID column
 * @method array findByThreadid(int $ThreadID) Return MessageContents objects filtered by the ThreadID column
 * @method array findByUserid(int $UserID) Return MessageContents objects filtered by the UserID column
 * @method array findByContent(string $Content) Return MessageContents objects filtered by the Content column
 * @method array findByDate(string $Date) Return MessageContents objects filtered by the Date column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseMessageContentsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMessageContentsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'MessageContents', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MessageContentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MessageContentsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MessageContentsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MessageContentsQuery) {
            return $criteria;
        }
        $query = new MessageContentsQuery();
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
     * @return   MessageContents|MessageContents[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MessageContentsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MessageContentsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MessageContents A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByThreadid($key, $con = null)
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
     * @return   MessageContents A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `MESSAGEID`, `THREADID`, `USERID`, `CONTENT`, `DATE` FROM `message_contents` WHERE `THREADID` = :p0';
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
            $obj = new MessageContents();
            $obj->hydrate($row);
            MessageContentsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return MessageContents|MessageContents[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MessageContents[]|mixed the list of results, formatted by the current formatter
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
     * @return MessageContentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MessageContentsPeer::THREADID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MessageContentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MessageContentsPeer::THREADID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MessageID column
     *
     * Example usage:
     * <code>
     * $query->filterByMessageid(1234); // WHERE MessageID = 1234
     * $query->filterByMessageid(array(12, 34)); // WHERE MessageID IN (12, 34)
     * $query->filterByMessageid(array('min' => 12)); // WHERE MessageID > 12
     * </code>
     *
     * @param     mixed $messageid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MessageContentsQuery The current query, for fluid interface
     */
    public function filterByMessageid($messageid = null, $comparison = null)
    {
        if (is_array($messageid)) {
            $useMinMax = false;
            if (isset($messageid['min'])) {
                $this->addUsingAlias(MessageContentsPeer::MESSAGEID, $messageid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($messageid['max'])) {
                $this->addUsingAlias(MessageContentsPeer::MESSAGEID, $messageid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageContentsPeer::MESSAGEID, $messageid, $comparison);
    }

    /**
     * Filter the query on the ThreadID column
     *
     * Example usage:
     * <code>
     * $query->filterByThreadid(1234); // WHERE ThreadID = 1234
     * $query->filterByThreadid(array(12, 34)); // WHERE ThreadID IN (12, 34)
     * $query->filterByThreadid(array('min' => 12)); // WHERE ThreadID > 12
     * </code>
     *
     * @param     mixed $threadid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MessageContentsQuery The current query, for fluid interface
     */
    public function filterByThreadid($threadid = null, $comparison = null)
    {
        if (is_array($threadid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MessageContentsPeer::THREADID, $threadid, $comparison);
    }

    /**
     * Filter the query on the UserID column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE UserID = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE UserID IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE UserID > 12
     * </code>
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MessageContentsQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(MessageContentsPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(MessageContentsPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageContentsPeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the Content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE Content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE Content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MessageContentsQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $content)) {
                $content = str_replace('*', '%', $content);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MessageContentsPeer::CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the Date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE Date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE Date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE Date > '2011-03-13'
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
     * @return MessageContentsQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(MessageContentsPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(MessageContentsPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageContentsPeer::DATE, $date, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   MessageContents $messageContents Object to remove from the list of results
     *
     * @return MessageContentsQuery The current query, for fluid interface
     */
    public function prune($messageContents = null)
    {
        if ($messageContents) {
            $this->addUsingAlias(MessageContentsPeer::THREADID, $messageContents->getThreadid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
