<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?=$data['title']??false?>
    </title>
    <meta name="description"
        content="<?=$data['description']??false?>">
    <?=styles($data['styles']??false)?>
    <?=scripts($data['scripts']??false)?>
</head>

<body>
    <?=content($data);?>
</body>
<html>