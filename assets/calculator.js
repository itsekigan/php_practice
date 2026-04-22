const calcFormula = document.querySelector('#calcFormula');
const calcResult = document.querySelector('#calcResult');
const calcKeypad = document.querySelector('#calcKeypad');

const state = {
  current: '0',
  previous: null,
  operator: null,
  justEvaluated: false
};

function updateDisplay() {
  const formula = state.previous !== null && state.operator
    ? `${state.previous} ${symbolizeOperator(state.operator)} ${state.current}`
    : state.current;

  calcFormula.textContent = formula;
  calcResult.textContent = state.current;
}

function symbolizeOperator(op) {
  if (op === '*') return '×';
  if (op === '/') return '÷';
  if (op === '-') return '−';
  return '＋';
}

function appendDigit(digit) {
  if (state.justEvaluated) {
    state.current = digit;
    state.justEvaluated = false;
    return;
  }

  if (state.current === '0') {
    state.current = digit;
    return;
  }

  state.current += digit;
}

function appendDecimal() {
  if (state.justEvaluated) {
    state.current = '0.';
    state.justEvaluated = false;
    return;
  }

  if (!state.current.includes('.')) {
    state.current += '.';
  }
}

function clearAll() {
  state.current = '0';
  state.previous = null;
  state.operator = null;
  state.justEvaluated = false;
}

function backspace() {
  if (state.justEvaluated) {
    clearAll();
    return;
  }

  if (state.current.length <= 1) {
    state.current = '0';
    return;
  }

  state.current = state.current.slice(0, -1);
}

function calculate(a, b, operator) {
  if (operator === '+') return a + b;
  if (operator === '-') return a - b;
  if (operator === '*') return a * b;
  if (operator === '/') {
    if (b === 0) return null;
    return a / b;
  }

  return b;
}

function commitOperation() {
  if (state.previous === null || state.operator === null) return;

  const left = Number(state.previous);
  const right = Number(state.current);
  const result = calculate(left, right, state.operator);

  if (result === null) {
    state.current = '0で割ることはできません';
    state.previous = null;
    state.operator = null;
    state.justEvaluated = true;
    return;
  }

  state.current = String(Number(result.toFixed(10)));
  state.previous = null;
  state.operator = null;
  state.justEvaluated = true;
}

function selectOperator(nextOperator) {
  if (state.current === '0で割ることはできません') {
    clearAll();
  }

  if (state.previous !== null && state.operator !== null && !state.justEvaluated) {
    commitOperation();
  }

  state.previous = state.current;
  state.current = '0';
  state.operator = nextOperator;
  state.justEvaluated = false;
}

function percent() {
  if (state.current === '0で割ることはできません') {
    clearAll();
    return;
  }

  const value = Number(state.current) / 100;
  state.current = String(Number(value.toFixed(10)));
}

function handleKeypadClick(event) {
  const button = event.target.closest('button[data-action]');
  if (!button) return;

  const { action, value } = button.dataset;

  if (state.current === '0で割ることはできません' && action !== 'clear') {
    clearAll();
  }

  if (action === 'digit') appendDigit(value);
  if (action === 'decimal') appendDecimal();
  if (action === 'clear') clearAll();
  if (action === 'back') backspace();
  if (action === 'percent') percent();
  if (action === 'operator') selectOperator(value);
  if (action === 'equals') commitOperation();

  updateDisplay();
}

calcKeypad.addEventListener('click', handleKeypadClick);
updateDisplay();
