<?php


/**
 * Base class that represents a query for the 'comments' table.
 *
 *
 *
 * @method CommentsQuery orderByPostid($order = Criteria::ASC) Order by the PostID column
 * @method CommentsQuery orderByCommentid($order = Criteria::ASC) Order by the CommentID column
 * @method CommentsQuery orderByUserid($order = Criteria::ASC) Order by the UserID column
 * @method CommentsQuery orderByDate($order = Criteria::ASC) Order by the Date column
 * @method CommentsQuery orderByContent($order = Criteria::ASC) Order by the Content column
 * @method CommentsQuery orderByTier($order = Criteria::ASC) Order by the Tier column
 *
 * @method CommentsQuery groupByPostid() Group by the PostID column
 * @method CommentsQuery groupByCommentid() Group by the CommentID column
 * @method CommentsQuery groupByUserid() Group by the UserID column
 * @method CommentsQuery groupByDate() Group by the Date column
 * @method CommentsQuery groupByContent() Group by the Content column
 * @method CommentsQuery groupByTier() Group by the Tier column
 *
 * @method CommentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CommentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CommentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Comments findOne(PropelPDO $con = null) Return the first Comments matching the query
 * @method Comments findOneOrCreate(PropelPDO $con = null) Return the first Comments matching the query, or a new Comments object populated from the query conditions when no match is found
 *
 * @method Comments findOneByPostid(int $PostID) Return the first Comments filtered by the PostID column
 * @method Comments findOneByUserid(int $UserID) Return the first Comments filtered by the UserID column
 * @method Comments findOneByDate(string $Date) Return the first Comments filtered by the Date column
 * @method Comments findOneByContent(string $Content) Return the first Comments filtered by the Content column
 * @method Comments findOneByTier(int $Tier) Return the first Comments filtered by the Tier column
 *
 * @method array findByPostid(int $PostID) Return Comments objects filtered by the PostID column
 * @method array findByCommentid(int $CommentID) Return Comments objects filtered by the CommentID column
 * @method array findByUserid(int $UserID) Return Comments objects filtered by the UserID column
 * @method array findByDate(string $Date) Return Comments objects filtered by the Date column
 * @method array findByContent(string $Content) Return Comments objects filtered by the Content column
 * @method array findByTier(int $Tier) Return Comments objects filtered by the Tier column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseCommentsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCommentsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'Comments', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CommentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CommentsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CommentsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CommentsQuery) {
            return $criteria;
        }
        $query = new CommentsQuery();
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
     * @return   Comments|Comments[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CommentsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CommentsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Comments A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByCommentid($key, $con = null)
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
     * @return   Comments A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `POSTID`, `COMMENTID`, `USERID`, `DATE`, `CONTENT`, `TIER` FROM `comments` WHERE `COMMENTID` = :p0';
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
            $obj = new Comments();
            $obj->hydrate($row);
            CommentsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Comments|Comments[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Comments[]|mixed the list of results, formatted by the current formatter
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
     * @return CommentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CommentsPeer::COMMENTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CommentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CommentsPeer::COMMENTID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the PostID column
     *
     * Example usage:
     * <code>
     * $query->filterByPostid(1234); // WHERE PostID = 1234
     * $query->filterByPostid(array(12, 34)); // WHERE PostID IN (12, 34)
     * $query->filterByPostid(array('min' => 12)); // WHERE PostID > 12
     * </code>
     *
     * @param     mixed $postid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CommentsQuery The current query, for fluid interface
     */
    public function filterByPostid($postid = null, $comparison = null)
    {
        if (is_array($postid)) {
            $useMinMax = false;
            if (isset($postid['min'])) {
                $this->addUsingAlias(CommentsPeer::POSTID, $postid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postid['max'])) {
                $this->addUsingAlias(CommentsPeer::POSTID, $postid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsPeer::POSTID, $postid, $comparison);
    }

    /**
     * Filter the query on the CommentID column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentid(1234); // WHERE CommentID = 1234
     * $query->filterByCommentid(array(12, 34)); // WHERE CommentID IN (12, 34)
     * $query->filterByCommentid(array('min' => 12)); // WHERE CommentID > 12
     * </code>
     *
     * @param     mixed $commentid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CommentsQuery The current query, for fluid interface
     */
    public function filterByCommentid($commentid = null, $comparison = null)
    {
        if (is_array($commentid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CommentsPeer::COMMENTID, $commentid, $comparison);
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
     * @return CommentsQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(CommentsPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(CommentsPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsPeer::USERID, $userid, $comparison);
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
     * @return CommentsQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(CommentsPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(CommentsPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsPeer::DATE, $date, $comparison);
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
     * @return CommentsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CommentsPeer::CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the Tier column
     *
     * Example usage:
     * <code>
     * $query->filterByTier(1234); // WHERE Tier = 1234
     * $query->filterByTier(array(12, 34)); // WHERE Tier IN (12, 34)
     * $query->filterByTier(array('min' => 12)); // WHERE Tier > 12
     * </code>
     *
     * @param     mixed $tier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CommentsQuery The current query, for fluid interface
     */
    public function filterByTier($tier = null, $comparison = null)
    {
        if (is_array($tier)) {
            $useMinMax = false;
            if (isset($tier['min'])) {
                $this->addUsingAlias(CommentsPeer::TIER, $tier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tier['max'])) {
                $this->addUsingAlias(CommentsPeer::TIER, $tier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsPeer::TIER, $tier, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Comments $comments Object to remove from the list of results
     *
     * @return CommentsQuery The current query, for fluid interface
     */
    public function prune($comments = null)
    {
        if ($comments) {
            $this->addUsingAlias(CommentsPeer::COMMENTID, $comments->getCommentid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
