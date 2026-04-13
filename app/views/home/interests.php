<!-- views/home/interests.php -->
<main class="interests-page">
<?php foreach ($categories as $key => $title): ?>
<?php
    $item = $interests[$key];
    $layout = $item['layout'] ?? 'content-first';
    $imageSrc = $item['image'] ?? '';
    
    // Объединяем данные: берем description ИЛИ items для вывода текстом
    $textData = $item['description'] ?? ($item['items'] ?? []);
    
    // Определяем порядок блоков
    $showImageFirst = ($layout === 'image-first'); 
    // Примечание: в вашей модели нет 'image-first', там 'image-wide' и 'text-narrow'.
    // Логика ниже оставлена как у вас, но проверьте CSS классы.
    $isImageWide = (strpos($layout, 'image-wide') !== false);
?>

<section class="block <?= $isImageWide ? 'image-wide' : 'text-wide' ?> <?= strpos($layout, 'last') !== false ? 'last' : '' ?>" id="<?= htmlspecialchars($key) ?>">
    
    <?php if ($isImageWide): ?>
        <!-- Картинка первая (слева) -->
        <div class="image">
            <img src="<?= htmlspecialchars($imageSrc) ?>" alt="<?= htmlspecialchars($title) ?>">
        </div>
        <div class="content">
            <h3><?= htmlspecialchars($title) ?></h3>
            
            <!-- Исправленный вывод текста -->
            <?php if (!empty($textData)): ?>
                <?php foreach ($textData as $line): ?>
                    <p><?= htmlspecialchars($line) ?></p>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Если нужны отдельные списки (ul), они генерируются JS ниже -->
            <?php if (!empty($item['items'])): ?>
                <div id="<?= htmlspecialchars($key) ?>-list" class="list-container"></div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <!-- Контент первый (слева) -->
        <div class="content">
            <h3><?= htmlspecialchars($title) ?></h3>
            
            <!-- Исправленный вывод текста -->
            <?php if (!empty($textData)): ?>
                <?php foreach ($textData as $line): ?>
                    <p><?= htmlspecialchars($line) ?></p>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($item['items'])): ?>
                <div id="<?= htmlspecialchars($key) ?>-list" class="list-container"></div>
            <?php endif; ?>
        </div>
        <div class="image">
            <img src="<?= htmlspecialchars($imageSrc) ?>" alt="<?= htmlspecialchars($title) ?>">
        </div>
    <?php endif; ?>
</section>
<?php endforeach; ?>
</main>

<a href="#top" id="backToTop" title="Наверх">↑</a>

<script>
// Передаем данные из PHP в JS
const interestsDataFromPhp = <?php echo json_encode($interests); ?>;

$(function() {
    $('.list-container').each(function() {
        const $container = $(this);
        const key = $container.attr('id').replace('-list', '');
        const items = interestsDataFromPhp[key]?.items || [];
        
        if (items.length > 0) {
            const $ul = $('<ul>');
            items.forEach(text => {
                $ul.append($('<li>').text(text));
            });
            $container.append($ul);
        }
    });
});
</script>