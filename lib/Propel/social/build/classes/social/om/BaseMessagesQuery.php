<?php


/**
 * Base class that represents a query for the 'messages' table.
 *
 *
 *
 * @method MessagesQuery orderByMessageid($order = Criteria::ASC) Order by the MessageID column
 * @method MessagesQuery orderByDate($order = Criteria::ASC) Order by the Date column
 * @method MessagesQuery orderBySubject($order = Criteria::ASC) Order by the Subject column
 *
 * @method MessagesQuery groupByMessageid() Group by the MessageID column
 * @method MessagesQuery groupByDate() Group by the Date column
 * @method MessagesQuery groupBySubject() Group by the Subject column
 *
 * @method MessagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MessagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MessagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Messages findOne(PropelPDO $con = null) Return the first Messages matching the query
 * @method Messages findOneOrCreate(PropelPDO $con = null) Return the first Messages matching the query, or a new Messages object populated from the query conditions when no match is found
 *
 * @method Messages findOneByDate(string $Date) Return the first Messages filtered by the Date column
 * @method Messages findOneBySubject(string $Subject) Return the first Messages filtered by the Subject column
 *
 * @method array findByMessageid(int $MessageID) Return Messages objects filtered by the MessageID column
 * @method array findByDate(string $Date) Return Messages objects filtered by the Date column
 * @method array findBySubject(string $Subject) Return Messages objects filtered by the Subject column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseMessagesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMessagesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'Messages', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MessagesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MessagesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MessagesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MessagesQuery) {
            return $criteria;
        }
        $query = new MessagesQuery();
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
     * @return   Messages|Messages[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MessagesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MessagesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Messages A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByMessageid($key, $con = null)
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
     * @return   Messages A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `MESSAGEID`, `DATE`, `SUBJECT` FROM `messages` WHERE `MESSAGEID` = :p0';
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
            $obj = new Messages();
            $obj->hydrate($row);
            MessagesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Messages|Messages[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Messages[]|mixed the list of results, formatted by the current formatter
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
     * @return MessagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MessagesPeer::MESSAGEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MessagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MessagesPeer::MESSAGEID, $keys, Criteria::IN);
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
     * @return MessagesQuery The current query, for fluid interface
     */
    public function filterByMessageid($messageid = null, $comparison = null)
    {
        if (is_array($messageid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MessagesPeer::MESSAGEID, $messageid, $comparison);
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
     * @return MessagesQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(MessagesPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(MessagesPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesPeer::DATE, $date, $comparison);
    }

    /**
     * Filter the query on the Subject column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE Subject = 'fooValue'
     * $query->filterBySubject('%fooValue%'); // WHERE Subject LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subject The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MessagesQuery The current query, for fluid interface
     */
    public function filterBySubject($subject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subject)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subject)) {
                $subject = str_replace('*', '%', $subject);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MessagesPeer::SUBJECT, $subject, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Messages $messages Object to remove from the list of results
     *
     * @return MessagesQuery The current query, for fluid interface
     */
    public function prune($messages = null)
    {
        if ($messages) {
            $this->addUsingAlias(MessagesPeer::MESSAGEID, $messages->getMessageid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
