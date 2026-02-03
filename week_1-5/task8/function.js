    display = document.getElementById("display");

function a(input) {
    display.value += input;
}

    function appendNumber(input) {
        display.value += input; 
    
    }

    function clearDisplay(op) {
        display.value = ""
    }

    function calculate() {
        try {
            display.value = eval(display.value);
        }
        catch(error) {
            display.value = "Error";
        }
    }
