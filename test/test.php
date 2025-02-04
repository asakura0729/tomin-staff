<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>フォーム内容をコピー</title>
</head>
<body>
  <form id="originalForm">
    <input type="text" name="test1" value="みかん">
  </form>
  <div id="sample"></div>
  <button id="copyButton">フォーム内容をコピー</button>

  <script>
    // ボタンがクリックされたときにフォームの内容をコピー
    document.getElementById('copyButton').addEventListener('click', function() {
      // フォーム要素を取得
      const originalForm = document.getElementById('originalForm');

      // フォームのHTMLを取得して、div#sampleに差し込む
      document.getElementById('sample').innerHTML = originalForm.outerHTML;
    });
  </script>
</body>
</html>
