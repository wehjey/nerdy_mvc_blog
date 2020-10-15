<?php require APP_ROOT . '/views/includes/header.php'; ?>

<a href="<?php echo URL_ROOT ?>/posts" class="btn btn-light">
<i class="fa fa-backward" aria-hidden="true"></i> Back
</a>

<br>

<h1><?php echo $data['post']->title ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    written by <?php $data['user']->name ?> on <?php echo $data['post']->created_at ?>
</div>

<p>
    <?php echo $data['post']->body ?>
</p>

<?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>
<hr>

<a href="<?php echo URL_ROOT ?>/posts/edit/<?php echo $data['post']->id ?>" class="btn btn-dark">Edit</a>

<form class="pull-right" action="<?php echo URL_ROOT ?>/posts/delete/<?php $data['post']->id ?>" method="post">
<input type="submit" value="Delete" class="btn btn-danger">
</form>

<?php endif ?>

<?php require APP_ROOT . '/views/includes/footer.php';
