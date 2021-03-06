<?php foreach($aNews as $news):  endforeach; $this->title = "News - " .$news->getTitle(); ?>
    <article>
        <header>
            <h1><?= $news->getTitle() ?></h1>
            <h3><time> Created <?= date('d/m/Y \a\t H\hi', strtotime($news->getCreationDate())) ?></time></h3>
            <?php if(!$news->getUpdateDate() === false) : ?>
                <Br/><time> Updated <?= date('d/m/Y \a\t H\hi', strtotime($news->getUpdateDate())) ?></time>
            <?php endif; ?>
        </header>
        <p><?= $news->getContent() ?></p>
            <?php if($request->getSession()->existAttribut('administrator') && $request->getSession()->getAttribut('administrator')) : ?>
                    <div class="flexboxC">
                        <form class="form-group flex" method="post" action="admin/updateNewsPage">
                            <input type="hidden" name="newsId" value="<?= $news->getId() ?>" />
                            <input type="hidden" name="title" value="<?= $news->getTitle() ?>" />
                            <input type="hidden" name="content" value="<?= $news->getContent() ?>" />
                            <input class="form-control yellow-submit" type="submit" value="Edit" />
                        </form>
                        <form class="form-group flex" method="post" action="admin/deleteNews">
                            <input type="hidden" name="newsId" value="<?= $news->getId() ?>" />
                            <input class="form-control red-submit" type="submit" value="Delete" />
                        </form>
                    </div>
        <?php endif; ?>
    </article>

<Br/><Br/>

<header>
    <h2>Answer to <?= $news->getTitle() ?></h2>
</header>
<div class="flexboxCL">
    <?php foreach ($comments as $comment): ?>
        <p class="user"><?= $comment->getPseudo()." :" ?></p>
        <p><?= $comment->getContent() ?></p>
        <time><?= date('d/m/Y \a\t H\hi', strtotime($comment->getCreationDate())) ?></time>
        <?php if($request->getSession()->existAttribut('id') && $request->getSession()->getAttribut('id') == $comment->getUserId() 
            || $request->getSession()->existAttribut('administrator') && $request->getSession()->getAttribut('administrator')) : ?>
            <form class="form-group" method="post" action="admin/deleteComment">
                    <input type="hidden" name="newsId" value="<?= $comment->getNewsId() ?>" />
                    <input type="hidden" name="commentId" value="<?= $comment->getId() ?>" />
                <input class="form-control red-submit" type="submit" value="Delete comment" />
            </form>
        <?php endif; ?>
    <?php endforeach; ?>
<Br/><br/>
<?php if($request->getSession()->existAttribut("id")) : ?>
    <form class="form-group" method="post" action="news/addComment">
        <input class="form-control" type="hidden" name="newsId" value="<?= $news->getId() ?>" />
        <textarea class="form-control" id="content" name="content" rows="4" placeholder="Your comment" required></textarea></br>
        <input class="form-control blue-submit" type="submit" value="Comment" />
    </form>
<?php endif; ?>
</div>