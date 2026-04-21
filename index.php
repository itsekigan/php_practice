<?php
$features = [
    [
        'id' => 'code-gen',
        'title' => 'コード生成',
        'goal' => '要件を自然言語で伝え、PHP/JS/CSS のひな形コードを素早く作成する。',
        'inputs' => ['機能要件', '利用言語', '制約（DBなし・ライブラリ制限など）'],
    ],
    [
        'id' => 'analysis',
        'title' => '既存コードの解析',
        'goal' => '既存ファイルの処理フロー、依存関係、改善ポイントを可視化する。',
        'inputs' => ['対象コード', '知りたい観点（構造/性能/保守性）', '出力形式（箇条書き/図解）'],
    ],
    [
        'id' => 'bugfix',
        'title' => 'バグ修正',
        'goal' => '再現手順とエラー情報から修正案と差分を提案する。',
        'inputs' => ['エラーメッセージ', '再現手順', '該当ソース'],
    ],
    [
        'id' => 'refactor',
        'title' => 'リファクタリング',
        'goal' => '可読性・再利用性を上げるための構造改善を行う。',
        'inputs' => ['現状コード', '改善したい指標', '非機能要件'],
    ],
    [
        'id' => 'test-data',
        'title' => 'テストデータ作成',
        'goal' => '正常系/異常系/境界値を網羅したテストデータを生成する。',
        'inputs' => ['データ項目', 'バリデーション条件', '必要件数'],
    ],
];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codex 学習デモシステム</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
    <h1>Codex 学習デモシステム（PHP / JS / CSS）</h1>
    <p>生成AIツール初心者チーム向けに、Codexでできることを体験的に説明できるサンプルです。<strong>DB接続なし</strong>で動作します。</p>
</header>

<main>
    <section class="card">
        <h2>使い方（3ステップ）</h2>
        <ol>
            <li>下の機能一覧から学びたいテーマを選択</li>
            <li>入力例を参考にプロンプトを編集</li>
            <li>「デモ実行」で想定される出力例を確認</li>
        </ol>
    </section>

    <section class="card">
        <h2>学習機能一覧</h2>
        <div class="feature-grid">
            <?php foreach ($features as $feature): ?>
                <article class="feature-item" data-feature-id="<?= htmlspecialchars($feature['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <h3><?= htmlspecialchars($feature['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($feature['goal'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h4>入力のポイント</h4>
                    <ul>
                        <?php foreach ($feature['inputs'] as $input): ?>
                            <li><?= htmlspecialchars($input, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button class="choose-feature" type="button">この機能でデモする</button>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="card">
        <h2>インタラクティブデモ</h2>
        <label for="featureSelect">機能</label>
        <select id="featureSelect"></select>

        <label for="promptInput">説明用プロンプト</label>
        <textarea id="promptInput" rows="6"></textarea>

        <div class="actions">
            <button id="runDemo" type="button">デモ実行</button>
            <button id="loadSample" type="button" class="secondary">サンプル再読込</button>
        </div>

        <h3>出力イメージ</h3>
        <pre id="outputArea">ここに出力が表示されます。</pre>
    </section>
</main>

<footer>
    <small>このシステムは教育目的のローカルデモです。外部API・DBには接続しません。</small>
</footer>

<script>
    window.CODEX_DEMO_FEATURES = <?= json_encode($features, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>
<script src="assets/app.js"></script>
</body>
</html>
