<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
</head>
<body>
    <form action="<?= BASE_URL ?>/url/shorten" method="POST">
        <input type="url" name="url" placeholder="Enter your URL" required>
        <button type="submit">Shorten</button>
    </form>

    <?php if (isset($data['error'])): ?>
        <p style="color: red;"><?= $data['error'] ?></p>
    <?php endif; ?>

    <?php if (isset($data['shortCode'])): ?>
        <p>Your short URL is: <a href="<?= BASE_URL ?>/url/redirect/<?= $data['shortCode'] ?>"><?= BASE_URL ?>/url/redirect/<?= $data['shortCode'] ?></a></p>
    <?php endif; ?>
</body>
</html>
