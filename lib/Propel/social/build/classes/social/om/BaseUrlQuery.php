<?php


/**
 * Base class that represents a query for the 'url' table.
 *
 *
 *
 * @method UrlQuery orderByUrlid($order = Criteria::ASC) Order by the urlid column
 * @method UrlQuery orderByUrlhost($order = Criteria::ASC) Order by the urlhost column
 * @method UrlQuery orderByUrlpath($order = Criteria::ASC) Order by the urlpath column
 * @method UrlQuery orderByUrlquery($order = Criteria::ASC) Order by the urlquery column
 * @method UrlQuery orderByContenttype($order = Criteria::ASC) Order by the contenttype column
 * @method UrlQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method UrlQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method UrlQuery orderByContentimg($order = Criteria::ASC) Order by the contentimg column
 *
 * @method UrlQuery groupByUrlid() Group by the urlid column
 * @method UrlQuery groupByUrlhost() Group by the urlhost column
 * @method UrlQuery groupByUrlpath() Group by the urlpath column
 * @method UrlQuery groupByUrlquery() Group by the urlquery column
 * @method UrlQuery groupByContenttype() Group by the contenttype column
 * @method UrlQuery groupByTitle() Group by the title column
 * @method UrlQuery groupByContent() Group by the content column
 * @method UrlQuery groupByContentimg() Group by the contentimg column
 *
 * @method UrlQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UrlQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UrlQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Url findOne(PropelPDO $con = null) Return the first Url matching the query
 * @method Url findOneOrCreate(PropelPDO $con = null) Return the first Url matching the query, or a new Url object populated from the query conditions when no match is found
 *
 * @method Url findOneByUrlhost(string $urlhost) Return the first Url filtered by the urlhost column
 * @method Url findOneByUrlpath(string $urlpath) Return the first Url filtered by the urlpath column
 * @method Url findOneByUrlquery(string $urlquery) Return the first Url filtered by the urlquery column
 * @method Url findOneByContenttype(string $contenttype) Return the first Url filtered by the contenttype column
 * @method Url findOneByTitle(string $title) Return the first Url filtered by the title column
 * @method Url findOneByContent(string $content) Return the first Url filtered by the content column
 * @method Url findOneByContentimg(string $contentimg) Return the first Url filtered by the contentimg column
 *
 * @method array findByUrlid(int $urlid) Return Url objects filtered by the urlid column
 * @method array findByUrlhost(string $urlhost) Return Url objects filtered by the urlhost column
 * @method array findByUrlpath(string $urlpath) Return Url objects filtered by the urlpath column
 * @method array findByUrlquery(string $urlquery) Return Url objects filtered by the urlquery column
 * @method array findByContenttype(string $contenttype) Return Url objects filtered by the contenttype column
 * @method array findByTitle(string $title) Return Url objects filtered by the title column
 * @method array findByContent(string $content) Return Url objects filtered by the content column
 * @method array findByContentimg(string $contentimg) Return Url objects filtered by the contentimg column
 *
 * @package    propel.generator.social.om
 */
abstract class BaseUrlQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUrlQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'social', $modelName = 'Url', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UrlQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     UrlQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UrlQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UrlQuery) {
            return $criteria;
        }
        $query = new UrlQuery();
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
     * @return   Url|Url[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UrlPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UrlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Url A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByUrlid($key, $con = null)
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
     * @return   Url A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `URLID`, `URLHOST`, `URLPATH`, `URLQUERY`, `CONTENTTYPE`, `TITLE`, `CONTENT`, `CONTENTIMG` FROM `url` WHERE `URLID` = :p0';
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
            $obj = new Url();
            $obj->hydrate($row);
            UrlPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Url|Url[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Url[]|mixed the list of results, formatted by the current formatter
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
     * @return UrlQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UrlPeer::URLID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UrlQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UrlPeer::URLID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the urlid column
     *
     * Example usage:
     * <code>
     * $query->filterByUrlid(1234); // WHERE urlid = 1234
     * $query->filterByUrlid(array(12, 34)); // WHERE urlid IN (12, 34)
     * $query->filterByUrlid(array('min' => 12)); // WHERE urlid > 12
     * </code>
     *
     * @param     mixed $urlid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UrlQuery The current query, for fluid interface
     */
    public function filterByUrlid($urlid = null, $comparison = null)
    {
        if (is_array($urlid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(UrlPeer::URLID, $urlid, $comparison);
    }

    /**
     * Filter the query on the urlhost column
     *
     * Example usage:
     * <code>
     * $query->filterByUrlhost('fooValue');   // WHERE urlhost = 'fooValue'
     * $query->filterByUrlhost('%fooValue%'); // WHERE urlhost LIKE '%fooValue%'
     * </code>
     *
     * @param     string $urlhost The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UrlQuery The current query, for fluid interface
     */
    public function filterByUrlhost($urlhost = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($urlhost)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $urlhost)) {
                $urlhost = str_replace('*', '%', $urlhost);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UrlPeer::URLHOST, $urlhost, $comparison);
    }

    /**
     * Filter the query on the urlpath column
     *
     * Example usage:
     * <code>
     * $query->filterByUrlpath('fooValue');   // WHERE urlpath = 'fooValue'
     * $query->filterByUrlpath('%fooValue%'); // WHERE urlpath LIKE '%fooValue%'
     * </code>
     *
     * @param     string $urlpath The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UrlQuery The current query, for fluid interface
     */
    public function filterByUrlpath($urlpath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($urlpath)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $urlpath)) {
                $urlpath = str_replace('*', '%', $urlpath);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UrlPeer::URLPATH, $urlpath, $comparison);
    }

    /**
     * Filter the query on the urlquery column
     *
     * Example usage:
     * <code>
     * $query->filterByUrlquery('fooValue');   // WHERE urlquery = 'fooValue'
     * $query->filterByUrlquery('%fooValue%'); // WHERE urlquery LIKE '%fooValue%'
     * </code>
     *
     * @param     string $urlquery The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UrlQuery The current query, for fluid interface
     */
    public function filterByUrlquery($urlquery = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($urlquery)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $urlquery)) {
                $urlquery = str_replace('*', '%', $urlquery);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UrlPeer::URLQUERY, $urlquery, $comparison);
    }

    /**
     * Filter the query on the contenttype column
     *
     * Example usage:
     * <code>
     * $query->filterByContenttype('fooValue');   // WHERE contenttype = 'fooValue'
     * $query->filterByContenttype('%fooValue%'); // WHERE contenttype LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contenttype The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UrlQuery The current query, for fluid interface
     */
    public function filterByContenttype($contenttype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contenttype)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contenttype)) {
                $contenttype = str_replace('*', '%', $contenttype);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UrlPeer::CONTENTTYPE, $contenttype, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UrlQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UrlPeer::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UrlQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UrlPeer::CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the contentimg column
     *
     * Example usage:
     * <code>
     * $query->filterByContentimg('fooValue');   // WHERE contentimg = 'fooValue'
     * $query->filterByContentimg('%fooValue%'); // WHERE contentimg LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contentimg The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UrlQuery The current query, for fluid interface
     */
    public function filterByContentimg($contentimg = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contentimg)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contentimg)) {
                $contentimg = str_replace('*', '%', $contentimg);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UrlPeer::CONTENTIMG, $contentimg, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Url $url Object to remove from the list of results
     *
     * @return UrlQuery The current query, for fluid interface
     */
    public function prune($url = null)
    {
        if ($url) {
            $this->addUsingAlias(UrlPeer::URLID, $url->getUrlid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
