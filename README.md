## SIMPLE PAGINATION

This package is very easy to use and allows you to set up a paging system in very short time

## INSTALATION

Require this package with composer:

```
composer require vex6/pagination
```

## USAGE

```
$pagination = new Pagination($data, 'home');
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pagination->setPerpage(4);
$pagination->setCurrentPage($page);
```

For a simple display:

```
<ul class="pagination-items">
    <?php if($pagination->getFirstPage()):?> <li><a href="<?=$pagination->getFirstPage()?>"><<</a></li><?php endif; ?>
    <?php if($pagination->prev()):?><li><a href="<?=$pagination->prev()?>">&larr;</a></li><?php endif; ?>
    <?php if($pagination->next()):?><li><a href="<?=$pagination->next()?>">&rarr;</a></li><?php endif; ?>
    <?php if($pagination->getLastPage()):?><li><a href="<?=$pagination->getLastPage()?>"> >></a></li><?php endif; ?>
</ul>
```

For a complex display:

```
<ul class="pagination-items">
    <?php if($pagination->getFirstPage()):?> <li><a href="<?=$pagination->getFirstPage()?>"><<</a></li><?php endif; ?>
    <?php foreach($pagination->getPageUrls() as $link): ?>
        <li>
            <a href="<?=$link['link']?>"><?=$link['page']?></a>
        </li>
    <?php endforeach; ?>
    <?php if($pagination->getLastPage()):?><li><a href="<?=$pagination->getLastPage()?>"> >></a></li><?php endif; ?>
</ul>
```