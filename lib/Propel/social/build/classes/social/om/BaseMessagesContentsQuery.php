<?php


/**
 * Base class that represents a query for the 'messages_contents' table.
 *
 *
 *
 * @method MessagesContentsQuery orderByMessageId($order = Criteria::ASC) Order by the message_id column
 * @method MessagesContentsQuery orderByThreadId($order = Criteria::ASC) Order by the thread_id column
 * @method MessagesContentsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method MessagesContentsQuery orderByContents($order = Criteria::ASC) Order by the contents column
 *
 * @method MessagesContentsQuery groupByMessageId() Group by the message_id column
 * @method MessagesContentsQuery groupByThreadId() Group by the thread_id column
 * @method MessagesContentsQuery groupByUserId() Group by the user_id column
 * @method MessagesContentsQuery groupByContents() Group by the contents column
 *
 * @method MessagesContentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MessagesContentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MessagesContentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MessagesContentsQuery leftJoinMessages($relationAlias = null) Adds a LEFT JOIN clause to the query using the Messages relation
 * @method MessagesContentsQuery rightJoinMessages($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Messages relation
 * @method MessagesContentsQuery innerJoinMessages($relationAlias = null) Adds a INNER JOIN clause to the query using the Messages relation
 *
 * @method MessagesContents findOne(PropelPDO $con = null) Return the first MessagesContents matching the query
 * @method MessagesContents findOneOrCreate(PropelPDO $con = null) Return the first MessagesContents matching the query, or a new MessagesContents object populated from the query conditions when no match is found
 *
 * @method MessagesContents findOneByThreadId(int $thread_id) Return the first MessagesContents filtered by the thread_id column
 * @method MessagesContents findOneByUserId(int $user_id) Return the first MessagesContents filtered by the user_id column
 * @method MessagesContents findOneByContents(string $contents) Return the first MessagesContents filtered by the contents column
 *
 * @method array findByMessageId(int $message_id) Return MessagesContents objects filtered by the message_id column
 * @method array findByThreadId(int $thread_id) Return MessagesContents objects filtered by the thread_id column
 * @method array findByUserId(int $user_id) Return MessagesContents objects filtered by the user_id column
 * @method array findByContents(string $contents) Return MessagesContents objects filtered by the contents column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseMessagesContentsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMessagesContentsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'MessagesContents', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MessagesContentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MessagesContentsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MessagesContentsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MessagesContentsQuery) {
            return $criteria;
        }
        $query = new MessagesContentsQuery();
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
     * @return   MessagesContents|MessagesContents[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MessagesContentsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MessagesContentsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MessagesContents A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByMessageId($key, $con = null)
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
     * @return   MessagesContents A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `MESSAGE_ID`, `THREAD_ID`, `USER_ID`, `CONTENTS` FROM `messages_contents` WHERE `MESSAGE_ID` = :p0';
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
            $obj = new MessagesContents();
            $obj->hydrate($row);
            MessagesContentsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return MessagesContents|MessagesContents[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MessagesContents[]|mixed the list of results, formatted by the current formatter
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
     * @return MessagesContentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MessagesContentsPeer::MESSAGE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MessagesContentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MessagesContentsPeer::MESSAGE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the message_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMessageId(1234); // WHERE message_id = 1234
     * $query->filterByMessageId(array(12, 34)); // WHERE message_id IN (12, 34)
     * $query->filterByMessageId(array('min' => 12)); // WHERE message_id > 12
     * </code>
     *
     * @param     mixed $messageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MessagesContentsQuery The current query, for fluid interface
     */
    public function filterByMessageId($messageId = null, $comparison = null)
    {
        if (is_array($messageId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MessagesContentsPeer::MESSAGE_ID, $messageId, $comparison);
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
     * @return MessagesContentsQuery The current query, for fluid interface
     */
    public function filterByThreadId($threadId = null, $comparison = null)
    {
        if (is_array($threadId)) {
            $useMinMax = false;
            if (isset($threadId['min'])) {
                $this->addUsingAlias(MessagesContentsPeer::THREAD_ID, $threadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($threadId['max'])) {
                $this->addUsingAlias(MessagesContentsPeer::THREAD_ID, $threadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesContentsPeer::THREAD_ID, $threadId, $comparison);
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
     * @return MessagesContentsQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(MessagesContentsPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(MessagesContentsPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesContentsPeer::USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the contents column
     *
     * Example usage:
     * <code>
     * $query->filterByContents('fooValue');   // WHERE contents = 'fooValue'
     * $query->filterByContents('%fooValue%'); // WHERE contents LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contents The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MessagesContentsQuery The current query, for fluid interface
     */
    public function filterByContents($contents = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contents)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contents)) {
                $contents = str_replace('*', '%', $contents);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MessagesContentsPeer::CONTENTS, $contents, $comparison);
    }

    /**
     * Filter the query by a related Messages object
     *
     * @param   Messages|PropelObjectCollection $messages  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MessagesContentsQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMessages($messages, $comparison = null)
    {
        if ($messages instanceof Messages) {
            return $this
                ->addUsingAlias(MessagesContentsPeer::MESSAGE_ID, $messages->getMessageId(), $comparison);
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
     * @return MessagesContentsQuery The current query, for fluid interface
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
     * Filter the query by a related MessagesUser object
     * using the messages table as cross reference
     *
     * @param   MessagesUser $messagesUser the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MessagesContentsQuery The current query, for fluid interface
     */
    public function filterByMessagesUser($messagesUser, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useMessagesQuery()
            ->filterByMessagesUser($messagesUser, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   MessagesContents $messagesContents Object to remove from the list of results
     *
     * @return MessagesContentsQuery The current query, for fluid interface
     */
    public function prune($messagesContents = null)
    {
        if ($messagesContents) {
            $this->addUsingAlias(MessagesContentsPeer::MESSAGE_ID, $messagesContents->getMessageId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
