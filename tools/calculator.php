<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codex作 電卓</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<header>
    <h1>Codex作 電卓</h1>
    <p>四則演算対応の電卓です（DB接続なし）。</p>
</header>

<main>
    <section class="card calculator-shell">
        <h2>電卓</h2>
        <div class="calc-display-wrap">
            <p id="calcFormula" class="calc-formula">0</p>
            <p id="calcResult" class="calc-result">0</p>
        </div>

        <div class="calc-keypad" id="calcKeypad">
            <button type="button" data-action="clear" class="secondary">AC</button>
            <button type="button" data-action="back" class="secondary">⌫</button>
            <button type="button" data-action="percent" class="secondary">%</button>
            <button type="button" data-action="operator" data-value="/">÷</button>

            <button type="button" data-action="digit" data-value="7">7</button>
            <button type="button" data-action="digit" data-value="8">8</button>
            <button type="button" data-action="digit" data-value="9">9</button>
            <button type="button" data-action="operator" data-value="*">×</button>

            <button type="button" data-action="digit" data-value="4">4</button>
            <button type="button" data-action="digit" data-value="5">5</button>
            <button type="button" data-action="digit" data-value="6">6</button>
            <button type="button" data-action="operator" data-value="-">−</button>

            <button type="button" data-action="digit" data-value="1">1</button>
            <button type="button" data-action="digit" data-value="2">2</button>
            <button type="button" data-action="digit" data-value="3">3</button>
            <button type="button" data-action="operator" data-value="+">＋</button>

            <button type="button" data-action="digit" data-value="0" class="span-2">0</button>
            <button type="button" data-action="decimal">.</button>
            <button type="button" data-action="equals" class="equals">=</button>
        </div>

        <div class="actions">
            <button type="button" onclick="window.location.href='../index.php'">トップに戻る</button>
        </div>
    </section>
</main>

<script src="../assets/calculator.js"></script>
</body>
</html>
