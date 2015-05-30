<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>分页测试</title>
</head>
<body>
	<?php foreach (($articleList['subset']?:array()) as $article): ?>
	  <h2><?php echo $article['name']; ?></h2>
	  <p><?php echo $article['cityCode']; ?></p>
	<?php endforeach; ?>

	<?php $pn = new Pagination($articleList['total']);$pn->setLimit($articleList['limit']);echo $pn->serve(); ?>
</body>
</html>