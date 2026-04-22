const featureSamples = {
  "code-gen": {
    prompt: `PHPでTODO管理画面を作るサンプルコードを作成してください。\n条件: DBは使わず配列で管理。JSで完了状態の切替、CSSでカード表示。`,
    output: `# コード生成結果（要約）\n\n- index.php: タスク一覧の表示とフォーム\n- app.js: 追加・完了切替・削除イベント\n- style.css: 見やすいカードUI\n\n\
<?php\n$tasks = ['仕様整理', '画面確認'];\n?>\n<ul>\n  <?php foreach ($tasks as $task): ?>\n    <li><?= htmlspecialchars($task, ENT_QUOTES, 'UTF-8') ?></li>\n  <?php endforeach; ?>\n</ul>`
  },
  analysis: {
    prompt: `このPHPコードの責務を分析して、改善ポイントを3つ挙げてください。\n特に可読性と拡張性を重視。`,
    output: `# 既存コード解析（要約）\n\n1. 入力処理・表示処理・検証が同一関数に混在\n2. 変数名の粒度が不揃いで意図が読み取りづらい\n3. エラー時の分岐が重複し保守性が低下\n\n提案:\n- 処理を "入力検証" "業務ロジック" "描画" に分割\n- 命名規約を統一\n- 早期returnで分岐のネストを浅くする`
  },
  bugfix: {
    prompt: `JavaScriptで「Cannot read properties of null」エラーが出ます。\n再現: 画面表示直後にボタンイベントを登録。修正案と差分を示してください。`,
    output: `# バグ修正提案\n\n原因:\n- DOM生成前に querySelector を実行し null を取得。\n\n修正案:\n- DOMContentLoaded 後にイベント登録。\n\n差分例:\n\
document.addEventListener('DOMContentLoaded', () => {\n  const runBtn = document.querySelector('#runDemo');\n  if (runBtn) runBtn.addEventListener('click', runDemo);\n});`
  },
  refactor: {
    prompt: `次のJSをリファクタリングしてください。\n要件: 重複処理の関数化、命名改善、副作用を減らす。`,
    output: `# リファクタリング提案\n\n- 重複していた "メッセージ整形" を formatMessage() に抽出\n- processData() を純粋関数化しテストしやすく改善\n- 一時変数の意味を明確化（tmp -> normalizedUserName）\n\n結果:\n- 可読性向上\n- 単体テスト追加が容易\n- 将来の機能追加コストを低減`
  },
  "test-data": {
    prompt: `会員登録フォームのテストデータを作ってください。\n項目: name,email,password,age\n正常系5件、異常系5件、境界値4件。`,
    output: `# テストデータ案（抜粋）\n\n正常系:\n- {name: "Abe Taro", email: "abe@example.com", password: "Abc12345", age: 20}\n\n異常系:\n- emailが形式不正\n- passwordが8文字未満\n\n境界値:\n- age = 0, 1, 120, 121\n\n運用ポイント:\n- 期待結果(OK/NG)をセットで保持\n- CSV/JSONの両方で出力可能にする`
  }
};

const featureSelect = document.querySelector('#featureSelect');
const promptInput = document.querySelector('#promptInput');
const outputArea = document.querySelector('#outputArea');
const runDemoButton = document.querySelector('#runDemo');
const loadSampleButton = document.querySelector('#loadSample');
const chooseButtons = document.querySelectorAll('.choose-feature');
const openToolsModalButton = document.querySelector('#openToolsModal');
const closeToolsModalButton = document.querySelector('#closeToolsModal');
const toolsModal = document.querySelector('#toolsModal');
const toolButtons = document.querySelectorAll('.tool-link');

function buildFeatureOptions() {
  window.CODEX_DEMO_FEATURES.forEach((feature) => {
    const option = document.createElement('option');
    option.value = feature.id;
    option.textContent = feature.title;
    featureSelect.appendChild(option);
  });
}

function loadSample() {
  const selected = featureSelect.value;
  const sample = featureSamples[selected];
  if (!sample) return;
  promptInput.value = sample.prompt;
  outputArea.textContent = '「デモ実行」を押すと、ここに出力イメージを表示します。';
}

function runDemo() {
  const selected = featureSelect.value;
  const sample = featureSamples[selected];
  if (!sample) {
    outputArea.textContent = 'サンプルが見つかりません。';
    return;
  }

  const userPrompt = promptInput.value.trim();
  outputArea.textContent = `入力プロンプト:\n${userPrompt || '（未入力）'}\n\n${sample.output}`;
}

function wireFeatureCards() {
  chooseButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const parent = button.closest('[data-feature-id]');
      if (!parent) return;
      const featureId = parent.getAttribute('data-feature-id');
      featureSelect.value = featureId;
      loadSample();
      window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    });
  });
}

function openModal() {
  if (!toolsModal) return;
  toolsModal.classList.add('is-open');
  toolsModal.setAttribute('aria-hidden', 'false');
}

function closeModal() {
  if (!toolsModal) return;
  toolsModal.classList.remove('is-open');
  toolsModal.setAttribute('aria-hidden', 'true');
}

function wireToolsModal() {
  if (openToolsModalButton) {
    openToolsModalButton.addEventListener('click', openModal);
  }

  if (closeToolsModalButton) {
    closeToolsModalButton.addEventListener('click', closeModal);
  }

  if (toolsModal) {
    toolsModal.addEventListener('click', (event) => {
      if (event.target === toolsModal) {
        closeModal();
      }
    });
  }

  toolButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const enabled = button.dataset.enabled === 'true';
      const path = button.dataset.path;

      if (!enabled || !path) {
        alert('このツールは準備中です。');
        return;
      }

      window.location.href = path;
    });
  });
}

buildFeatureOptions();
loadSample();
wireFeatureCards();
wireToolsModal();

runDemoButton.addEventListener('click', runDemo);
loadSampleButton.addEventListener('click', loadSample);
