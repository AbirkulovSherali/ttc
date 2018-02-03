<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>КРЕСТИКИ-НОЛИКИ</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<style type="text/css">
	/* style for user image (overwrite .o) */
	.o {
		<?php if(isset($_SESSION['photo'])): ?>
			background: url('uploads/<?= $_SESSION['photo'] ?>') no-repeat center center !important;
		<?php else: ?>
			background: url('assets/img/default.png') no-repeat center center !important;
		<?php endif ?>
		background-size: 60px !important;
		border-radius: 50%;
		border: 1px solid rgba(0, 0, 0, .2) !important;
	}
	</style>
	<!-- put any js-code into this file -->
	<script src="assets/js/jquery-2.1.1.min.js"></script>
	<script src="assets/js/app.js"></script>
</head>
<body>
<section class="container-game">
	<article class="title-row">
		<h1>КРЕСТИКИ-НОЛИКИ</h1>
	</article>
	<article class="row initial-page">
		<article class="col">
			<article class="subtitle-row">
				<h2>Правила</h2>
			</article>
			<article class="container-row">
				Правила игры:
				<ul>
					<li>Выбрать фото (по желанию)</li>
					<li>Нажмите "Новая игра"</li>
					<li>Играйте: соберите в ряд по горизонтали, вертикали или диагонали отметки быстрее чем компьютер</li>
				</ul>
			</article>
			<article class="subtitle-row">
				<h2>Результаты</h2>
			</article>
			<article class="container-row high scroll">
				<article class="scroll-view">
					<?php if($results): ?>
						<?php foreach($results as $result): ?>
							<article class="score">
								<?php if($result['img']): ?>
									<h4 class="pos" style="background: url('uploads/<?= $result['img'] ?>')no-repeat center center;background-size: cover">3</h4>
								<?php else: ?>
									<h4 class="pos" style="background: url('assets/img/default.png')no-repeat center center;background-size: cover">3</h4>
								<?php endif ?>
								<h4 class="name-high"><?= $result['user_name'] ?> <span class="moves"><span><?= $result['count_move_user'] ?></span>-<span><?= $result['count_move_user'] ?></span></span></h4>
								<p><span class="date-high"><?= $result['date'] ?></span><span class="time-high"><?= $result['sec'] ?> сек.</span></p>
							</article>
						<?php endforeach ?>
					<?php else: ?>
						<h4>Пока нет результатов</h4>
					<?php endif ?>
				</article>
		</article>
		</article>

		<!-- Including the view -->
		<?php require_once $view.'.php' ?>


	</section>
</section>
</body>
</html>
