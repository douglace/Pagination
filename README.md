## SIMPLE PAGINATION

This package is very easy to use and allows you to set up a paging system in very short time

## INSTALATION

Require this package with composer:

```
composer require vex6/pagination
```

## USAGE

```php
<?php

use App\Cd\Pagination\Pagination;

$pagination = new Pagination($data, 'your_site.com/home');
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pagination->setPerpage(4);
$pagination->setCurrentPage($page);
```

The `$data` is an array

For a simple display:

```php
<ul class="pagination-items">
    <?php if($pagination->getFirstPage()):?> <li><a href="<?=$pagination->getFirstPage()?>"><<</a></li><?php endif; ?>
    <?php if($pagination->prev()):?><li><a href="<?=$pagination->prev()?>">&larr;</a></li><?php endif; ?>
    <?php if($pagination->next()):?><li><a href="<?=$pagination->next()?>">&rarr;</a></li><?php endif; ?>
    <?php if($pagination->getLastPage()):?><li><a href="<?=$pagination->getLastPage()?>"> >></a></li><?php endif; ?>
</ul>
```

For a complex display:

```php
<ul class="pagination-items">
    <?php if($pagination->getFirstPage()): ?> 
     <li>
        <a href="<?=$pagination->getFirstPage()?>"><<</a>
     </li>
    <?php endif; ?>
    <?php foreach($pagination->getPageUrls() as $link): ?>
        <li>
            <a href="<?=$link['link']?>"><?=$link['page']?></a>
        </li>
    <?php endforeach; ?>
    <?php if($pagination->getLastPage()):?><li><a href="<?=$pagination->getLastPage()?>"> >></a></li><?php endif; ?>
</ul>
```