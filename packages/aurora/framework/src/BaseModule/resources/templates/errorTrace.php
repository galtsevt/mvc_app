<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="bg-neutral-900">
<div class="max-w-7xl mx-auto">
    <h1 class="mx-5 my-4 font-bold text-4xl text-neutral-200"><?= $e->getMessage() ?></h1>
    <div class="bg-neutral-800 rounded-lg m-2 text-white p-3">
        <div class="">
            File: <?= $e->getFile() ?> (Line: <?= $e->getLine() ?>)
        </div>
        <?php
        $start = $e->getLine() - 2;
        $end = $e->getLine() + 2;
        $code = file($e->getFile());
        $snippet = array_slice($code, $start, $end - $start + 1);
        ?>
        <div class="m-2">
            <?php foreach($snippet as $index => $lineContent): ?>
                <?php $lineNumber = $start + $index + 1; ?>
            <div class="<?= $lineNumber == $e->getLine() ? 'bg-red-700 hover:bg-red-800':'bg-red-500 hover:bg-red-600'?>">
                <?= $lineNumber . str_replace(' ', '&nbsp;', htmlspecialchars($lineContent)) ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php foreach(array_reverse($e->getTrace()) as $line): ?>
    <div class="bg-neutral-800 rounded-lg m-2 text-neutral-300 p-3">
        <div class="">
            File: <?= $line['file'] ?> (Line: <?= $line['line'] ?>)
        </div>
        <?php
        $start = $line['line'] - 2;
        $end = $line['line'] + 2;
        $code = file($line['file']);
        $snippet = array_slice($code, $start, $end - $start + 1);
        ?>
        <div class="m-2">
            <?php foreach($snippet as $index => $lineContent): ?>
                <?php $lineNumber = $start + $index + 1; ?>
                <div class="<?= $lineNumber == $line['line'] ? 'bg-red-700 hover:bg-red-800':'bg-red-500 hover:bg-red-600'?>">
                    <?= $lineNumber . str_replace(' ', '&nbsp;', htmlspecialchars($lineContent)) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>

</div>
</body>
</html>