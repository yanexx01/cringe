<main>
    <div class="gallery-page">
        <h2>Фотоальбом</h2>
        
        <div id="galleryContainer" class="gallery-grid">
            <?php if (!empty($photos)): ?>
                <?php foreach ($photos as $photo): ?>
                    <div class="photo-item">
                        <img 
                            src="<?= htmlspecialchars($photo['src']) ?>" 
                            alt="<?= htmlspecialchars($photo['title']) ?>" 
                            data-index="<?= $photo['index'] ?>"
                        >
                        <div class="photo-caption">
                            <?= htmlspecialchars($photo['title']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Фотографий пока нет.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Модальное окно (структура такая же, как была, она скрыта по умолчанию) -->
    <div id="photoModal" class="photo-modal" style="display:none;">
        <!-- Контент модального окна будет заполняться или управляться через JS -->
        <!-- Для простоты оставим структуру, которую твой JS ожидает, 
            но лучше проверить, совместима ли она с твоим photos.js -->
    </div>
</main>
