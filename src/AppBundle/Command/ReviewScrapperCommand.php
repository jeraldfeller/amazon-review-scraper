<?php

namespace AppBundle\Command;

use AppBundle\Entity\Reviews;
use AppBundle\Entity\TotalReviews;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\Tools\Pagination\Paginator;
use AppBundle\Controller\SessionController;

use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;


class ReviewScrapperCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('execute:scrape-review')
            // the short description shown while running "php bin/console list"
            ->setDescription('scrape amazon reviews')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('')//==   ->addArgument('action', InputArgument::REQUIRED, 'What type of action do you want to execute?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dateNow = date('Y-m-d');
        $locale = 'it';
        $em = $this->getContainer()->get('doctrine')->getManager();
        $asins = $this->getAsins($em);
        for ($i = 0; $i < count($asins); $i++) {
            $entity = $asins[$i];
            $asin = $asins[$i]->getAsin();
            $url = "https://www.amazon.$locale/dp/$asin";
            $reviewLink = $asins[$i]->getAsinReviewUrl();
            $client = new Client();
            if ($reviewLink == '') {
                $crawler = $client->request('GET', $url);
                if ($crawler) {
                    $reviewLinkNode = $crawler->filter('#dp-summary-see-all-reviews');
                    if ($reviewLinkNode) {
                        $href = $reviewLinkNode->attr('href');
                        $reviewLink = "https://www.amazon.$locale.$href&sortBy=recent";
                        $output->writeln([
                            $reviewLink
                        ]);
                        $entity->setAsinReviewUrl($reviewLink);
                        $em->flush();
                    }
                }
            }


            $pg = 1;
            $continue = true;
            while ($continue == true) {
                // new client for review url
                $crawler = $client->request('GET', $reviewLink . '&pageNumber=' . $pg);
                if ($crawler) {
                    $output->writeln(['URL: ' . $reviewLink . '&pageNumber=' . $pg, 'Page: ' . $pg]);
                    // get total number of reviews
                    $totalReviewCount = str_replace('.', '', $crawler->filter('.totalReviewCount')->text());
                    $output->writeln(['Review count: ' . $totalReviewCount]);
                    // get reviews
                    $reviews = array();
                    $crawler->filter('#cm_cr-review_list > .review')->each(function ($node) use (&$reviews, &$output) {
                        $reviewId = $node->attr('id');
                        $output->writeln([$reviewId]);
                        $reviews[] = array(
                            'id' => $reviewId,
                            'rating' => $rating = $node->filter('.review-rating')->eq(0)->text(),
                            'title' => $title = $node->filter('.review-title')->eq(0)->text(),
                            'author' => $author = $node->filter('.author')->eq(0)->text(),
                            'date' => $date = $node->filter('.review-date')->eq(0)->text(),
                            'message' => $message = $node->filter('.review-text')->eq(0)->text()
                        );
                    });
                    if (count($reviews) == 0) {
                        $continue = false;
                    }
                    $currentReviewListCount = 0;
                    for ($x = 0; $x < count($reviews); $x++) {
                        $reviewEntity = $em->getRepository('AppBundle:Reviews')->findOneBy(array('reviewId' => $reviews[$x]['id']));
                        if (!$reviewEntity) {

                            $datePosted = explode(' ', $reviews[$x]['date']);
                            $year = $datePosted[count($datePosted) - 1];

                            if ($year >= 2016) {
                                $reviewEntity = new Reviews();
                                $reviewEntity->setAsins($entity);
                                $reviewEntity->setItemAsin($asin);
                                $reviewEntity->setStatus(1);
                                $reviewEntity->setReviewId($reviews[$x]['id']);
                                $reviewEntity->setReviewStarRating($reviews[$x]['rating']);
                                $reviewEntity->setReviewTitle(addslashes($reviews[$x]['title']));
                                $reviewEntity->setReviewAuthor(addslashes($reviews[$x]['author']));
                                $reviewEntity->setReviewDate($reviews[$x]['date']);
                                $reviewEntity->setReviewBody(addslashes($reviews[$x]['message']));
                                $reviewEntity->setDateCreated(new \DateTime($dateNow));
                                $em->persist($reviewEntity);
                            } else {
                                $continue == false;
                            }
                        }

                        $currentReviewListCount++;
                        if ($currentReviewListCount < 10) {
                            $continue = false;
                        }
                    }
                    $em->flush();


                    // record total number of reviews
                    if ($pg == 1) {
                        $countEntity = $em->getRepository('AppBundle:TotalReviews')->findOneBy(array('asins' => $entity, 'locale' => $locale));
                        if ($countEntity) {
                            $countEntity->setTotalReviewCount($totalReviewCount);
                        } else {
                            $countEntity = new TotalReviews();
                            $countEntity->setAsins($entity);
                            $countEntity->setTotalReviewCount($totalReviewCount);
                            $countEntity->setLocale($locale);
                            $em->persist($countEntity);
                        }
                    }
                }
                $pg++;
                sleep(mt_rand(1, 3));
            }


            sleep(mt_rand(1, 3));
        }
        $em->flush();
        $em->close();
    }


    public function getAsins($em, $maxResults = 10)
    {
        $sql = $em->createQuery(
            "SELECT e
                FROM AppBundle:Asins e
                WHERE e.status = 0 ORDER BY e.id
                "
        )->setMaxResults($maxResults);
        $result = $sql->getResult();
        $lists = array();

        if ($result) {
            for ($x = 0; $x < count($result); $x++) {
                // update status
                $entity = $em->getRepository('AppBundle:Asins')->find($result[$x]->getId());
                $entity->setStatus(1);
                $lists[] = $result[$x];
            }
            $em->flush();
        }


        return $lists;

    }
}