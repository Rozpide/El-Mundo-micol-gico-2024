<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora - El Mundo Micológico</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 30px;
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .calculator {
            background: #f5f5f5;
            border-radius: 15px;
            padding: 20px;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.1);
        }

        .display {
            background: #2d3748;
            color: #fff;
            font-size: 32px;
            padding: 20px;
            border-radius: 10px;
            text-align: right;
            margin-bottom: 20px;
            min-height: 60px;
            word-wrap: break-word;
            overflow-x: auto;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.3);
        }

        .display::-webkit-scrollbar {
            height: 6px;
        }

        .display::-webkit-scrollbar-thumb {
            background: #4a5568;
            border-radius: 3px;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        button {
            padding: 20px;
            font-size: 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }

        button:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-number {
            background: #fff;
            color: #2d3748;
        }

        .btn-number:hover {
            background: #e2e8f0;
        }

        .btn-operator {
            background: #667eea;
            color: white;
        }

        .btn-operator:hover {
            background: #5568d3;
        }

        .btn-clear {
            background: #f56565;
            color: white;
        }

        .btn-clear:hover {
            background: #e53e3e;
        }

        .btn-equals {
            background: #48bb78;
            color: white;
            grid-column: span 2;
        }

        .btn-equals:hover {
            background: #38a169;
        }

        .btn-zero {
            grid-column: span 2;
        }

        .history {
            margin-top: 30px;
            padding: 20px;
            background: #f7fafc;
            border-radius: 10px;
            max-height: 300px;
            overflow-y: auto;
        }

        .history h3 {
            color: #2d3748;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .history-item {
            background: white;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .history-operation {
            color: #4a5568;
            font-size: 14px;
        }

        .history-result {
            color: #667eea;
            font-weight: bold;
            font-size: 16px;
        }

        .history-empty {
            text-align: center;
            color: #a0aec0;
            padding: 20px;
            font-style: italic;
        }

        .btn-clear-history {
            background: #ed8936;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            margin-top: 10px;
            width: 100%;
        }

        .btn-clear-history:hover {
            background: #dd6b20;
        }

        .mode-toggle {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .mode-btn {
            flex: 1;
            padding: 10px;
            font-size: 14px;
            background: #e2e8f0;
            color: #2d3748;
        }

        .mode-btn.active {
            background: #667eea;
            color: white;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: white;
            font-size: 14px;
        }

        .footer a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧮 Calculadora Avanzada</h1>
        
        <div class="mode-toggle">
            <button class="mode-btn active" onclick="setMode('js')" id="jsMode">JavaScript</button>
            <button class="mode-btn" onclick="setMode('php')" id="phpMode">PHP</button>
        </div>

        <div class="calculator">
            <div class="display" id="display">0</div>
            
            <div class="buttons">
                <button class="btn-clear" onclick="clearDisplay()">C</button>
                <button class="btn-clear" onclick="deleteLast()">←</button>
                <button class="btn-operator" onclick="appendOperator('%')">%</button>
                <button class="btn-operator" onclick="appendOperator('/')">÷</button>
                
                <button class="btn-number" onclick="appendNumber('7')">7</button>
                <button class="btn-number" onclick="appendNumber('8')">8</button>
                <button class="btn-number" onclick="appendNumber('9')">9</button>
                <button class="btn-operator" onclick="appendOperator('*')">×</button>
                
                <button class="btn-number" onclick="appendNumber('4')">4</button>
                <button class="btn-number" onclick="appendNumber('5')">5</button>
                <button class="btn-number" onclick="appendNumber('6')">6</button>
                <button class="btn-operator" onclick="appendOperator('-')">−</button>
                
                <button class="btn-number" onclick="appendNumber('1')">1</button>
                <button class="btn-number" onclick="appendNumber('2')">2</button>
                <button class="btn-number" onclick="appendNumber('3')">3</button>
                <button class="btn-operator" onclick="appendOperator('+')">+</button>
                
                <button class="btn-number btn-zero" onclick="appendNumber('0')">0</button>
                <button class="btn-number" onclick="appendNumber('.')">.</button>
                <button class="btn-equals" onclick="calculate()">=</button>
            </div>
        </div>

        <div class="history">
            <h3>📜 Historial</h3>
            <div id="historyList">
                <div class="history-empty">No hay operaciones aún</div>
            </div>
            <button class="btn-clear-history" onclick="clearHistory()">Limpiar Historial</button>
        </div>

        <div class="footer">
            <a href="index.php">← Volver al sitio principal</a>
        </div>
    </div>

    <script>
        let currentMode = 'js';
        let displayValue = '0';
        let history = [];

        function setMode(mode) {
            currentMode = mode;
            document.getElementById('jsMode').classList.toggle('active', mode === 'js');
            document.getElementById('phpMode').classList.toggle('active', mode === 'php');
        }

        function updateDisplay() {
            document.getElementById('display').textContent = displayValue;
        }

        function appendNumber(num) {
            if (displayValue === '0' || displayValue === 'Error') {
                displayValue = num;
            } else {
                displayValue += num;
            }
            updateDisplay();
        }

        function appendOperator(operator) {
            const lastChar = displayValue.slice(-1);
            if (['+', '-', '*', '/', '%'].includes(lastChar)) {
                displayValue = displayValue.slice(0, -1) + operator;
            } else {
                displayValue += operator;
            }
            updateDisplay();
        }

        function clearDisplay() {
            displayValue = '0';
            updateDisplay();
        }

        function deleteLast() {
            if (displayValue.length > 1) {
                displayValue = displayValue.slice(0, -1);
            } else {
                displayValue = '0';
            }
            updateDisplay();
        }

        function calculate() {
            if (currentMode === 'js') {
                calculateJS();
            } else {
                calculatePHP();
            }
        }

        function calculateJS() {
            try {
                const operation = displayValue;
                // Reemplazar símbolos visuales por operadores
                let expression = operation.replace(/×/g, '*').replace(/÷/g, '/').replace(/−/g, '-');
                
                // Validar que no haya operadores al final
                if (['+', '-', '*', '/', '%'].includes(expression.slice(-1))) {
                    throw new Error('Operación incompleta');
                }

                const result = eval(expression);
                
                // Redondear a 8 decimales para evitar errores de punto flotante
                const roundedResult = Math.round(result * 100000000) / 100000000;
                
                addToHistory(operation, roundedResult, 'JavaScript');
                displayValue = roundedResult.toString();
                updateDisplay();
            } catch (error) {
                displayValue = 'Error';
                updateDisplay();
                setTimeout(() => {
                    displayValue = '0';
                    updateDisplay();
                }, 1500);
            }
        }

        function calculatePHP() {
            const operation = displayValue;
            
            fetch('calculadora_process.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'operation=' + encodeURIComponent(operation)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    addToHistory(operation, data.result, 'PHP');
                    displayValue = data.result.toString();
                } else {
                    displayValue = 'Error';
                    setTimeout(() => {
                        displayValue = '0';
                        updateDisplay();
                    }, 1500);
                }
                updateDisplay();
            })
            .catch(error => {
                console.error('Error:', error);
                displayValue = 'Error';
                updateDisplay();
            });
        }

        function addToHistory(operation, result, mode) {
            history.unshift({
                operation: operation,
                result: result,
                mode: mode,
                time: new Date().toLocaleTimeString()
            });
            
            // Mantener solo las últimas 10 operaciones
            if (history.length > 10) {
                history = history.slice(0, 10);
            }
            
            updateHistoryDisplay();
        }

        function updateHistoryDisplay() {
            const historyList = document.getElementById('historyList');
            
            if (history.length === 0) {
                historyList.innerHTML = '<div class="history-empty">No hay operaciones aún</div>';
                return;
            }
            
            historyList.innerHTML = history.map((item, index) => `
                <div class="history-item">
                    <div>
                        <div class="history-operation">${item.operation} <small>(${item.mode})</small></div>
                        <small style="color: #a0aec0;">${item.time}</small>
                    </div>
                    <div class="history-result">= ${item.result}</div>
                </div>
            `).join('');
        }

        function clearHistory() {
            history = [];
            updateHistoryDisplay();
        }

        // Soporte para teclado
        document.addEventListener('keydown', (event) => {
            const key = event.key;
            
            if (key >= '0' && key <= '9') {
                appendNumber(key);
            } else if (key === '.') {
                appendNumber('.');
            } else if (key === '+' || key === '-' || key === '*' || key === '/') {
                appendOperator(key);
            } else if (key === 'Enter' || key === '=') {
                event.preventDefault();
                calculate();
            } else if (key === 'Escape' || key === 'c' || key === 'C') {
                clearDisplay();
            } else if (key === 'Backspace') {
                event.preventDefault();
                deleteLast();
            } else if (key === '%') {
                appendOperator('%');
            }
        });
    </script>
</body>
</html>
