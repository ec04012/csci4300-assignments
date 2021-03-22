var fah = prompt("Enter Fahrenheit temperature");
fah = parseFloat(fah);
var cel = ((fah - 32) * 5) / 9;
alert("Fahrenheit temperature is " + fah + "\n\nCelsius temperature is " + cel);