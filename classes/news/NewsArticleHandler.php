<?php

/**
 * @author Thomas
 */
class NewsArticleHandler {

    private $session;

    function __construct(Session $session) {
        $this->session = $session;
    }

    public function getArticle($id) {
        $info = $this->session->getConnection()->query("SELECT title, post_date, content FROM news_articles WHERE id = ?", array($id), true);
        if ($this->session->getConnection()->getRowAmount() < 0)
            return null;

        return $info;
    }

    public function getArticles($limit) {
        $info = $this->session->getConnection()->query("SELECT * FROM news_articles ORDER BY id DESC LIMIT ". $limit, array(), true);

        if ($this->session->getConnection()->getRowAmount() < 0)
            return null;

        return $info;
    }

    public function displayRecent() {
        $articles = $this->getArticles(5);
        if ($articles == null)
            return;

        echo '
        <img class="narrowscroll-top" src="img/scroll/scroll457_top.gif" alt="" width="466" height="50">
            <div class="narrowscroll-bg">
                <div class="narrowscroll-bgimg">
                    <div class="narrowscroll-content">
                        <dl class="news scroll">
                            <dt style="text-align: center;"><IMG alt="Recent News" src="img/title2/recent_news.gif"></dt>
                            <dt>&nbsp;</dt>
        ';

        foreach ($articles as $article) {

            echo '
                  <dt>
                    <span class="newsdate">'. $article['post_date'] .'</span>
                    '. $article['title'] .'
                  </dt>
                  
                  <dd>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="text-align: justify; vertical-align: top">
                                    '. $article['content'] .'
                                </td>
                                <td style="text-align: right; padding-left: 1em; vertical-align: top;">
                                    <img width="50" height="50" src="img/news/behind_the-scenes_2.gif">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="margin-top: 0.5em;">
                        <a href="?page=news_article&id='. $article['id'] .'">Read more...</a>
                    </div>
                  </dd> 
            ';

        }


        echo '
        
        <div class="right" style="margin-bottom: 0.5em">
                            <a href="#">Browse the news archives</a>
                        </div>
                    </div>
                </div>
            </div>
            <img class="narrowscroll-bottom" src="img/scroll/scroll457_bottom.gif" alt="" width="466" height="50">
        
        ';
    }

}