<?php
/**
 * Title: Default Footer
 * Slug: twentytwentythree/footer-default
 * Categories: footer
 * Block Types: core/template-part/footer
 */
?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
	<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--40)">
		<!-- wp:site-title {"level":0} /-->
		<!-- wp:paragraph {"align":"right"} -->
		<p class="has-text-align-right">
		<?php
		printf(
			/* Translators: WordPress link. */
			esc_html__( 'Proudly powered by %s', 'twentytwentythree' ),
			'<a href="' . esc_url( __( 'https://wordpress.org', 'twentytwentythree' ) ) . '" rel="nofollow">WordPress</a>'
		)
		?>
		</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
<script>
jQuery(document).ready(function($) {
    // Обработчик события при отправке формы фильтра
    $('#filter-form').on('submit', function(e) {
        e.preventDefault();

        // Получение данных из формы фильтра
        var formData = $(this).serialize();

        // Отправка Ajax-запроса
        $.ajax({
            type: 'POST',
            url: ajaxurl, // Переменная ajaxurl автоматически определена WordPress
            data: formData + '&action=custom_real_estate_search',
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    // Отобразить результаты поиска
                    displayResults(response);
                } else {
                    // Вывести сообщение, что ничего не найдено
                    $('#results').html('Ничего не найдено.');
                }
            }
        });
    });

    // Функция для отображения результатов поиска
    function displayResults(results) {
        var output = '';
        for (var i = 0; i < results.length; i++) {
            output += '<div class="result">';
            output += '<h2>' + results[i].title + '</h2>';
            output += '<p>Район: ' + results[i].district + '</p>';
            // Добавьте другие поля, которые вы хотите отобразить
            output += '</div>';
        }
        $('#results').html(output);
    }
});

</script>
