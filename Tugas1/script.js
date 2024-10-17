
let display = document.getElementById('display');


function clearDisplay() {
    display.value = '0';
}


function appendNumber(number) {
    if (display.value === 'Error') {
        display.value = number;
    } else {
        if (display.value === '0') {
            display.value = number;
        } else {
            display.value += number;
        }
    }
}


function appendOperator(operator) {
    let currentValue = display.value.trim();
    if (['+', '-', '*', '/', '%', '^'].includes(currentValue.slice(-1))) {
        display.value = currentValue.slice(0, -1) + operator + ' ';
    } else if (operator === '.') {
        let parts = currentValue.split(/[\+\-\*\/\%\^ ]+/);
        let lastPart = parts[parts.length - 1];

        if (!lastPart.includes('.')) {
            display.value += '.';
        }
    } else {
       
        display.value += ' ' + operator + ' ';
    }
}


function calculate() {
    try {
        
        let expression = display.value.replace(/x/g, '*').replace(/\^/g, '**');
        
        if (['+', '-', '*', '/', '%', '^'].includes(expression.trim().slice(-1))) {
           
            return;
        }
        
        let result = eval(expression);
        
        let roundedResult = Math.round(result * 100) / 100;
        
        display.value = parseFloat(roundedResult);
    } catch (error) {
        display.value = 'Error';
    }
}
