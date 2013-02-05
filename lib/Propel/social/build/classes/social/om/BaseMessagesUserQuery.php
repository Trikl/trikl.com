<?php


/**
 * Base class that represents a query for the 'messages_user' table.
 *
 *
 *
 * @method MessagesUserQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method MessagesUserQuery orderByThreadId($order = Criteria::ASC) Order by the thread_id column
 *
 * @method MessagesUserQuery groupByUserId() Group by the user_id column
 * @method MessagesUserQuery groupByThreadId() Group by the thread_id column
 *
 * @method MessagesUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MessagesUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MessagesUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MessagesUserQuery leftJoinMessages($relationAlias = null) Adds a LEFT JOIN clause to the query using the Messages relation
 * @method MessagesUserQuery rightJoinMessages($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Messages relation
 * @method MessagesUserQuery innerJoinMessages($relationAlias = null) Adds a INNER JOIN clause to the query using the Messages relation
 *
 * @method MessagesUser findOne(PropelPDO $con = null) Return the first MessagesUser matching the query
 * @method MessagesUser findOneOrCreate(PropelPDO $con = null) Return the first MessagesUser matching the query, or a new MessagesUser object populated from the query conditions when no match is found
 *
 * @method MessagesUser findOneByThreadId(int $thread_id) Return the first MessagesUser filtered by the thread_id column
 *
 * @method array findByUserId(int $user_id) Return MessagesUser objects filtered by the user_id column
 * @method array findByThreadId(int $thread_id) Return MessagesUser objects filtered by the thread_id column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseMessagesUserQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMessagesUserQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'MessagesUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MessagesUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MessagesUserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MessagesUserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MessagesUserQuery) {
            return $criteria;
        }
        $query = new MessagesUserQuery();
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
     * @return   MessagesUser|MessagesUser[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MessagesUserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MessagesUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MessagesUser A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByUserId($key, $con = null)
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
     * @return   MessagesUser A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `USER_ID`, `THREAD_ID` FROM `messages_user` WHERE `USER_ID` = :p0';
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
            $obj = new MessagesUser();
            $obj->hydrate($row);
            MessagesUserPeer::addInstanceToPool($obj, (string) $key);
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
     * @return MessagesUser|MessagesUser[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MessagesUser[]|mixed the list of results, formatted by the current formatter
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
     * @return MessagesUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MessagesUserPeer::USER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MessagesUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MessagesUserPeer::USER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MessagesUserQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MessagesUserPeer::USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the thread_id column
     *
     * Example usage:
     * <code>
     * $query->filterByThreadId(1234); // WHERE thread_id = 1234
     * $query->filterByThreadId(array(12, 34)); // WHERE thread_id IN (12, 34)
     * $query->filterByThreadId(array('min' => 12)); // WHERE thread_id > 12
     * </code>
     *
     * @param     mixed $threadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MessagesUserQuery The current query, for fluid interface
     */
    public function filterByThreadId($threadId = null, $comparison = null)
    {
        if (is_array($threadId)) {
            $useMinMax = false;
            if (isset($threadId['min'])) {
                $this->addUsingAlias(MessagesUserPeer::THREAD_ID, $threadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($threadId['max'])) {
                $this->addUsingAlias(MessagesUserPeer::THREAD_ID, $threadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesUserPeer::THREAD_ID, $threadId, $comparison);
    }

    /**
     * Filter the query by a related Messages object
     *
     * @param   Messages|PropelObjectCollection $messages  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MessagesUserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMessages($messages, $comparison = null)
    {
        if ($messages instanceof Messages) {
            return $this
                ->addUsingAlias(MessagesUserPeer::USER_ID, $messages->getUserId(), $comparison);
        } elseif ($messages instanceof PropelObjectCollection) {
            return $this
                ->useMessagesQuery()
                ->filterByPrimaryKeys($messages->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMessages() only accepts arguments of type Messages or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Messages relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MessagesUserQuery The current query, for fluid interface
     */
    public function joinMessages($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Messages');

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
            $this->addJoinObject($join, 'Messages');
        }

        return $this;
    }

    /**
     * Use the Messages relation Messages object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   MessagesQuery A secondary query class using the current class as primary query
     */
    public function useMessagesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMessages($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Messages', 'MessagesQuery');
    }

    /**
     * Filter the query by a related MessagesContents object
     * using the messages table as cross reference
     *
     * @param   MessagesContents $messagesContents the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MessagesUserQuery The current query, for fluid interface
     */
    public function filterByMessagesContents($messagesContents, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useMessagesQuery()
            ->filterByMessagesContents($messagesContents, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   MessagesUser $messagesUser Object to remove from the list of results
     *
     * @return MessagesUserQuery The current query, for fluid interface
     */
    public function prune($messagesUser = null)
    {
        if ($messagesUser) {
            $this->addUsingAlias(MessagesUserPeer::USER_ID, $messagesUser->getUserId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
