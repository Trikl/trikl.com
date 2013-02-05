<?php


/**
 * Base class that represents a query for the 'message_users' table.
 *
 *
 *
 * @method MessageUsersQuery orderByMessageid($order = Criteria::ASC) Order by the MessageID column
 * @method MessageUsersQuery orderByUserid($order = Criteria::ASC) Order by the UserID column
 *
 * @method MessageUsersQuery groupByMessageid() Group by the MessageID column
 * @method MessageUsersQuery groupByUserid() Group by the UserID column
 *
 * @method MessageUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MessageUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MessageUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MessageUsers findOne(PropelPDO $con = null) Return the first MessageUsers matching the query
 * @method MessageUsers findOneOrCreate(PropelPDO $con = null) Return the first MessageUsers matching the query, or a new MessageUsers object populated from the query conditions when no match is found
 *
 * @method MessageUsers findOneByUserid(int $UserID) Return the first MessageUsers filtered by the UserID column
 *
 * @method array findByMessageid(int $MessageID) Return MessageUsers objects filtered by the MessageID column
 * @method array findByUserid(int $UserID) Return MessageUsers objects filtered by the UserID column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseMessageUsersQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMessageUsersQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'MessageUsers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MessageUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MessageUsersQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MessageUsersQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MessageUsersQuery) {
            return $criteria;
        }
        $query = new MessageUsersQuery();
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
     * @return   MessageUsers|MessageUsers[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MessageUsersPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MessageUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MessageUsers A model object, or null if the key is not found
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
     * @return   MessageUsers A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `MESSAGEID`, `USERID` FROM `message_users` WHERE `MESSAGEID` = :p0';
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
            $obj = new MessageUsers();
            $obj->hydrate($row);
            MessageUsersPeer::addInstanceToPool($obj, (string) $key);
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
     * @return MessageUsers|MessageUsers[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MessageUsers[]|mixed the list of results, formatted by the current formatter
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
     * @return MessageUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MessageUsersPeer::MESSAGEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MessageUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MessageUsersPeer::MESSAGEID, $keys, Criteria::IN);
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
     * @return MessageUsersQuery The current query, for fluid interface
     */
    public function filterByMessageid($messageid = null, $comparison = null)
    {
        if (is_array($messageid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MessageUsersPeer::MESSAGEID, $messageid, $comparison);
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
     * @return MessageUsersQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(MessageUsersPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(MessageUsersPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageUsersPeer::USERID, $userid, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   MessageUsers $messageUsers Object to remove from the list of results
     *
     * @return MessageUsersQuery The current query, for fluid interface
     */
    public function prune($messageUsers = null)
    {
        if ($messageUsers) {
            $this->addUsingAlias(MessageUsersPeer::MESSAGEID, $messageUsers->getMessageid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
