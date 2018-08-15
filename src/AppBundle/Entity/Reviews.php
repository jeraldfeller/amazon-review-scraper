<?php

namespace AppBundle\Entity;

/**
 * Reviews
 */
class Reviews
{
    /**
     * @var \DateTime
     */
    private $time = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $status = '0';

    /**
     * @var string
     */
    private $itemId;

    /**
     * @var string
     */
    private $reviewStarRating;

    /**
     * @var string
     */
    private $reviewTitle;

    /**
     * @var string
     */
    private $reviewAuthor;

    /**
     * @var string
     */
    private $reviewDate;

    /**
     * @var string
     */
    private $reviewBody;

    /**
     * @var string
     */
    private $asin;

    /**
     * @var integer
     */
    private $pageno;

    /**
     * @var integer
     */
    private $total = '0';

    /**
     * @var string
     */
    private $locale = 'IT';

    /**
     * @var integer
     */
    private $id;


    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Reviews
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Reviews
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set itemId
     *
     * @param string $itemId
     *
     * @return Reviews
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return string
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set reviewStarRating
     *
     * @param string $reviewStarRating
     *
     * @return Reviews
     */
    public function setReviewStarRating($reviewStarRating)
    {
        $this->reviewStarRating = $reviewStarRating;

        return $this;
    }

    /**
     * Get reviewStarRating
     *
     * @return string
     */
    public function getReviewStarRating()
    {
        return $this->reviewStarRating;
    }

    /**
     * Set reviewTitle
     *
     * @param string $reviewTitle
     *
     * @return Reviews
     */
    public function setReviewTitle($reviewTitle)
    {
        $this->reviewTitle = $reviewTitle;

        return $this;
    }

    /**
     * Get reviewTitle
     *
     * @return string
     */
    public function getReviewTitle()
    {
        return $this->reviewTitle;
    }

    /**
     * Set reviewAuthor
     *
     * @param string $reviewAuthor
     *
     * @return Reviews
     */
    public function setReviewAuthor($reviewAuthor)
    {
        $this->reviewAuthor = $reviewAuthor;

        return $this;
    }

    /**
     * Get reviewAuthor
     *
     * @return string
     */
    public function getReviewAuthor()
    {
        return $this->reviewAuthor;
    }

    /**
     * Set reviewDate
     *
     * @param string $reviewDate
     *
     * @return Reviews
     */
    public function setReviewDate($reviewDate)
    {
        $this->reviewDate = $reviewDate;

        return $this;
    }

    /**
     * Get reviewDate
     *
     * @return string
     */
    public function getReviewDate()
    {
        return $this->reviewDate;
    }

    /**
     * Set reviewBody
     *
     * @param string $reviewBody
     *
     * @return Reviews
     */
    public function setReviewBody($reviewBody)
    {
        $this->reviewBody = $reviewBody;

        return $this;
    }

    /**
     * Get reviewBody
     *
     * @return string
     */
    public function getReviewBody()
    {
        return $this->reviewBody;
    }

    /**
     * Set asin
     *
     * @param string $asin
     *
     * @return Reviews
     */
    public function setAsin($asin)
    {
        $this->asin = $asin;

        return $this;
    }

    /**
     * Get asin
     *
     * @return string
     */
    public function getAsin()
    {
        return $this->asin;
    }

    /**
     * Set pageno
     *
     * @param integer $pageno
     *
     * @return Reviews
     */
    public function setPageno($pageno)
    {
        $this->pageno = $pageno;

        return $this;
    }

    /**
     * Get pageno
     *
     * @return integer
     */
    public function getPageno()
    {
        return $this->pageno;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return Reviews
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return Reviews
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var string
     */
    private $reviewId;

    /**
     * @var \AppBundle\Entity\Asins
     */
    private $asins;


    /**
     * Set reviewId
     *
     * @param string $reviewId
     *
     * @return Reviews
     */
    public function setReviewId($reviewId)
    {
        $this->reviewId = $reviewId;

        return $this;
    }

    /**
     * Get reviewId
     *
     * @return string
     */
    public function getReviewId()
    {
        return $this->reviewId;
    }

    /**
     * Set asins
     *
     * @param \AppBundle\Entity\Asins $asins
     *
     * @return Reviews
     */
    public function setAsins(\AppBundle\Entity\Asins $asins = null)
    {
        $this->asins = $asins;

        return $this;
    }

    /**
     * Get asins
     *
     * @return \AppBundle\Entity\Asins
     */
    public function getAsins()
    {
        return $this->asins;
    }
    /**
     * @var string
     */
    private $itemAsin;


    /**
     * Set itemAsin
     *
     * @param string $itemAsin
     *
     * @return Reviews
     */
    public function setItemAsin($itemAsin)
    {
        $this->itemAsin = $itemAsin;

        return $this;
    }

    /**
     * Get itemAsin
     *
     * @return string
     */
    public function getItemAsin()
    {
        return $this->itemAsin;
    }
    /**
     * @var \DateTime
     */
    private $dateCreated = 'CURRENT_TIMESTAMP';


    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Reviews
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
    /**
     * @var integer
     */
    private $pageNo;

    /**
     * @var integer
     */
    private $totalReviews = '0';


    /**
     * Set totalReviews
     *
     * @param integer $totalReviews
     *
     * @return Reviews
     */
    public function setTotalReviews($totalReviews)
    {
        $this->totalReviews = $totalReviews;

        return $this;
    }

    /**
     * Get totalReviews
     *
     * @return integer
     */
    public function getTotalReviews()
    {
        return $this->totalReviews;
    }
}
