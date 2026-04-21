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
    <p>四則演算ができるシンプルな電卓です（DB接続なし）。</p>
</header>

<main>
    <section class="card">
        <h2>計算フォーム</h2>
        <div class="calculator-grid">
            <div>
                <label for="valueA">値A</label>
                <input id="valueA" type="number" value="0">
            </div>
            <div>
                <label for="valueB">値B</label>
                <input id="valueB" type="number" value="0">
            </div>
        </div>

        <label for="operator">演算子</label>
        <select id="operator">
            <option value="+">足し算 (+)</option>
            <option value="-">引き算 (-)</option>
            <option value="*">掛け算 (*)</option>
            <option value="/">割り算 (/)</option>
        </select>

        <div class="actions">
            <button type="button" id="calcButton">計算する</button>
            <button type="button" id="resetButton" class="secondary">リセット</button>
        </div>

        <h3>結果</h3>
        <pre id="calcOutput">ここに計算結果が表示されます。</pre>
    </section>

    <section class="card">
        <button type="button" onclick="window.location.href='../index.php'">トップに戻る</button>
    </section>
</main>

<script>
const valueA = document.querySelector('#valueA');
const valueB = document.querySelector('#valueB');
const operator = document.querySelector('#operator');
const calcButton = document.querySelector('#calcButton');
const resetButton = document.querySelector('#resetButton');
const calcOutput = document.querySelector('#calcOutput');

function compute(a, b, op) {
    if (op === '+') return a + b;
    if (op === '-') return a - b;
    if (op === '*') return a * b;
    if (op === '/') {
        if (b === 0) return '0で割ることはできません。';
        return a / b;
    }
    return '不明な演算子です。';
}

calcButton.addEventListener('click', () => {
    const a = Number(valueA.value);
    const b = Number(valueB.value);
    const op = operator.value;

    if (Number.isNaN(a) || Number.isNaN(b)) {
        calcOutput.textContent = '数値を入力してください。';
        return;
    }

    const result = compute(a, b, op);
    calcOutput.textContent = `${a} ${op} ${b} = ${result}`;
});

resetButton.addEventListener('click', () => {
    valueA.value = '0';
    valueB.value = '0';
    operator.value = '+';
    calcOutput.textContent = 'ここに計算結果が表示されます。';
});
</script>
</body>
</html>
