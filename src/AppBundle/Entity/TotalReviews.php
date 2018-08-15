<?php

namespace AppBundle\Entity;

/**
 * TotalReviews
 */
class TotalReviews
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @var integer
     */
    private $totalReviewCount;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Asins
     */
    private $asin;


    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return TotalReviews
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
     * Set totalReviewCount
     *
     * @param integer $totalReviewCount
     *
     * @return TotalReviews
     */
    public function setTotalReviewCount($totalReviewCount)
    {
        $this->totalReviewCount = $totalReviewCount;

        return $this;
    }

    /**
     * Get totalReviewCount
     *
     * @return integer
     */
    public function getTotalReviewCount()
    {
        return $this->totalReviewCount;
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
     * Set asin
     *
     * @param \AppBundle\Entity\Asins $asin
     *
     * @return TotalReviews
     */
    public function setAsin(\AppBundle\Entity\Asins $asin = null)
    {
        $this->asin = $asin;

        return $this;
    }

    /**
     * Get asin
     *
     * @return \AppBundle\Entity\Asins
     */
    public function getAsin()
    {
        return $this->asin;
    }
    /**
     * @var \AppBundle\Entity\Asins
     */
    private $asins;


    /**
     * Set asins
     *
     * @param \AppBundle\Entity\Asins $asins
     *
     * @return TotalReviews
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
}
