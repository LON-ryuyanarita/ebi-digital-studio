(function ($, acf, apiFetch) {
  'use strict';

  const groupSelector = '.acf-field[data-key="field_67aea371bbfac"]';

  function initializeOgpFields($scope) {
    $scope.find(groupSelector).addBack(groupSelector).each(function () {
      const $group = $(this);
      const $urlField = $group.find('.acf-field[data-key="field_67ba1e42c1c56"]').first();

      if (!$urlField.length || $urlField.find('.ebi-ogp-fetch').length) {
        return;
      }

      const $button = $('<button>', {
        type: 'button',
        class: 'button ebi-ogp-fetch',
        text: '情報取得',
      });
      const $status = $('<span>', {
        class: 'ebi-ogp-fetch-status',
        css: { marginLeft: '8px' },
      });

      $urlField.find('.acf-input').append($('<p>').append($button, $status));

      $button.on('click', function () {
        const url = $urlField.find('input[type="url"]').val();
        const $title = $group.find('.acf-field[data-key="field_ebi_ogp_title"] input').first();
        const $description = $group
          .find('.acf-field[data-key="field_ebi_ogp_description"] textarea')
          .first();
        const $image = $group.find('.acf-field[data-key="field_67ba1e50c1c57"]').first();
        const imageField = acf.getField($image);
        const shouldFetchTitle = !$.trim($title.val());
        const shouldFetchDescription = !$.trim($description.val());
        const shouldFetchImage = !imageField.val();

        if (!url) {
          $status.text('URLを入力してください。');
          return;
        }

        if (!shouldFetchTitle && !shouldFetchDescription && !shouldFetchImage) {
          $status.text('タイトル・ディスクリプション・画像は入力済みです。');
          return;
        }

        $button.prop('disabled', true).text('取得中...');
        $status.text('');

        apiFetch({
          path: '/ebi/v1/ogp',
          method: 'POST',
          data: {
            url: url,
            fetch_image: shouldFetchImage,
            post_id: parseInt($('#post_ID').val(), 10) || 0,
          },
        })
          .then(function (data) {
            let updatedCount = 0;

            if (shouldFetchTitle && !$.trim($title.val()) && data.title) {
              $title.val(data.title).trigger('change');
              updatedCount++;
            }
            if (shouldFetchDescription && !$.trim($description.val()) && data.description) {
              $description.val(data.description).trigger('change');
              updatedCount++;
            }
            if (shouldFetchImage && !imageField.val() && data.image) {
              imageField.render(data.image);
              updatedCount++;
            }

            if (data.image_error) {
              $status.text(
                '空欄のテキストを反映しました。画像: ' +
                  data.image_error +
                  ' 投稿を更新すると保存されます。'
              );
            } else if (updatedCount) {
              $status.text('空欄の項目だけ取得しました。投稿を更新すると保存されます。');
            } else {
              $status.text('取得できる情報がありませんでした。入力済みの項目は保持しています。');
            }
          })
          .catch(function () {
            $status.text('取得できませんでした。URLを確認するか手動で入力してください。');
          })
          .finally(function () {
            $button.prop('disabled', false).text('情報取得');
          });
      });
    });
  }

  $(function () {
    initializeOgpFields($(document));
  });

  if (acf && typeof acf.addAction === 'function') {
    acf.addAction('append', initializeOgpFields);
  }
})(jQuery, window.acf, window.wp.apiFetch);
