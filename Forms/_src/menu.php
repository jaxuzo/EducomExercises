<?php
function showMenu(array $menu_items) : void
{
    echo '<nav><ul class="menu">'.PHP_EOL;
    foreach ($menu_items as $page => $title)
    {
        showMenuItem($page, $title);
    }
    echo '</ul><nav>'.PHP_EOL;
}

function showMenuItem(string $page_value, string $item_title) : void	
{
    echo '<li class="menu_item"><a href="?page='.$page_value.'">'.$item_title.'</a></li>'.PHP_EOL;
}

