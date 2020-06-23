<?php

  $url = $_SERVER['REQUEST_URI'];
  $currentPath = rtrim(str_replace(PROOT, '', $url), '/');
  $ary = explode('/', $currentPath);
  $currentPage = $currentPath;

  if(count($ary) == 1) {
    if($ary[0] == '') {
      $currentPage = 'home/index';
    } else {
      $currentPage = $ary[0] . '/index';
    }
  }

  $menu = json_decode(file_get_contents(ROOT . DS . 'app' . DS . 'menu.json'), true);

?>
<ul class="nav-menu" id="nav">
  <?php foreach($menu as $label => $path): ?>
    <?php if($currentPage == $path): ?>
      <li class="nav-item nav-item-active">
    <?php else: ?>
      <li class="nav-item">
    <?php endif; ?>
      <a href="<?=PROOT.$path?>"><?=$label?></a>
    </li>
  <?php endforeach; ?>
</ul>
