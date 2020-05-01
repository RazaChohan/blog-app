<html>
<h1>Welcome to Blog Application</h1>
<?php if (isUserAuthenticated()): ?>
    <a href="/logout">Logout</a>
<?php else: ?>
    <a href="/login">Login</a>
<?php endif; ?>
<div>
    <?php if (!empty($data['blogs'])): ?>
        <?php foreach ($data['blogs'] as $blog): ?>
            <div><?php echo $blog->title ?></div>
            <div><?php echo $blog->content ?></div>
            <div><?php echo $blog->author_first_name . ' ' . $blog->author_last_name ?></div>
            <div><?php echo $blog->created ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</html>